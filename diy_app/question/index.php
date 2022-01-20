<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include($path . "/common/functions.php");

$pdo = connect_to_db();

// -----------------------------
//  質問リストの取得
// -----------------------------
// カテゴリーidをGETで受け取り
$cat_param = $_GET["category"];

if (!isset($cat_param)) {
  $sql = "SELECT questions_table.*, GROUP_CONCAT(categories_table.name SEPARATOR ',') AS category FROM questions_table LEFT OUTER JOIN question_category ON questions_table.id = question_category.question_id LEFT OUTER JOIN categories_table ON categories_table.id = question_category.category_id WHERE questions_table.is_published=1 AND questions_table.is_deleted=0 GROUP BY questions_table.id ORDER BY questions_table.created_at DESC";
  $stmt = $pdo->prepare($sql);
} else {
  $sql = "SELECT result_table.* FROM question_category LEFT OUTER JOIN ( SELECT questions_table.*, GROUP_CONCAT(categories_table.name SEPARATOR ',') AS category FROM questions_table LEFT OUTER JOIN question_category ON questions_table.id = question_category.question_id LEFT OUTER JOIN categories_table ON categories_table.id = question_category.category_id GROUP BY questions_table.id ) AS result_table ON result_table.id = question_category.question_id WHERE question_category.category_id=:cat_param AND result_table.is_deleted = 0 AND result_table.is_published = 1 ORDER BY result_table.created_at DESC";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(':cat_param', $cat_param, PDO::PARAM_INT);
}

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($result);
// exit();

// -----------------------------
//  ページネーション設定
// -----------------------------
define('MAX', '5'); // 表示件数
$result_number = count($result); // トータルデータ件数
$max_page = ceil($result_number / MAX); // 小数点切り捨て

// ページ数をGET
if (!isset($_GET['page'])) {
  $now = 1;
} else {
  $now = $_GET['page'];
}

// 表示させるデータのみカット
$start_no = ($now - 1) * MAX;
$disp_data = array_slice($result, $start_no, MAX, true);

// ページネーション作成
$output_pagination = "";
$output_pagination .= "<div class='c-pagination'>";
$prev = max($now - 1, 1); // 前のページ番号
$next = min($now + 1, $max_page); // 次のページ番号

// 最初のページ以外で「前へ」を表示
if ($now != 1) {
  $output_pagination .= "<a class='prev' href='/diy_app/question/index.php?page={$prev}'>前へ</a>";
}
// ページネーションの本体
for ($i = 1; $i <= $max_page; $i++) {
  if ($i == $now) {
    $output_pagination .= "<span class='current'>{$now}</span>";
  } else {
    if (!isset($cat_param)) {
      $output_pagination .= "
        <a href='/diy_app/question/index.php?page={$i}')>{$i}</a>
      ";
    } else {
      $output_pagination .= "
        <a href='/diy_app/question/index.php?category={$cat_param}&page={$i}')>{$i}</a>
      ";
    }
  }
}
// 最後のページ以外で「次へ」を表示
if ($now < $max_page) {
  $output_pagination .= "<a class='next' href='/diy_app/question/index.php?page={$next}'>次へ</a>";
}
$output_pagination .= "</div>";

// -----------------------------
//  出力
// -----------------------------
$output = "";
if (!$result) {
  $output .= "
    <p>質問はありませんでした</p>
    <p><a href='/diy_app/question/'>みんなの質問へ戻る</p>
  ";
} else {
  $output .= "<ul class='d-dash-qlist'>";
  foreach ($disp_data as $data) { // データ表示

    // 日付フォーマットの変換
    $created_date = datetime_to_ymd($data["created_at"]);
    // カテゴリー
    $category_list = output_category($data["category"]);

    $output .= "
    <li>
      <a href='/diy_app/question/single.php?q_id={$data["id"]}'>
        <time>{$created_date}</time>
        {$category_list}
        <h2>{$data["title"]}</h2>
      </a>
    </li>
  ";
  }
  $output .= "</ul>";
}

// -----------------------------
//  カテゴリー検索
// -----------------------------
$sql = 'SELECT * FROM categories_table';
$stmt = $pdo->prepare($sql);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output_sort = "";
$output_sort .= "<ul>";
foreach ($result as $record) {
  $output_sort .= "
    <li><a href='/diy_app/question/?category={$record["id"]}'>{$record["name"]}</a></li>
  ";
}
$output_sort .= "</li>";

?>


<!-- header -->
<?php include $path . "/common/header.php"; ?>
<!-- //header -->

<div class="hero">
  <img src="/diy_app/img/hero.png" width="200" height="200" alt="hero">
</div>

<main>
  <section class="section">
    <div class="wrapper">

      <h1>みんなの質問</h1>
      <?= $output; ?>
      <div class="question-pagination">
        <?= $output_pagination; ?>
      </div>

      <section>
        <h2>カテゴリー検索</h2>
        <?= $output_sort; ?>
      </section>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
