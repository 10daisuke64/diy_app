<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include($path . "/common/functions.php");

$pdo = connect_to_db();

// -----------------------------
//  質問リストの取得
// -----------------------------
// $sql = 'SELECT * FROM questions_table WHERE is_deleted=0 AND is_published=1 ORDER BY created_at DESC LIMIT 3';
$sql = 'SELECT questions_table.id AS id, questions_table.user_id AS user_id, questions_table.title AS title, questions_table.body AS body, questions_table.is_published AS is_published, questions_table.is_deleted AS is_deleted, questions_table.created_at AS created_at, GROUP_CONCAT(categories_table.name SEPARATOR ",") AS category FROM questions_table LEFT OUTER JOIN question_category ON questions_table.id = question_category.question_id
LEFT OUTER JOIN categories_table ON categories_table.id = question_category.category_id WHERE questions_table.is_published=1 AND questions_table.is_deleted=0 GROUP BY questions_table.id ORDER BY questions_table.created_at DESC LIMIT 3';

$stmt = $pdo->prepare($sql);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// -----------------------------
//  出力
// -----------------------------
$output_question = "";
if (!$result) {
  $output_question .= "<p>質問はありませんでした</p>";
} else {
  $output_question .= "<ul class='d-dash-qlist'>";
  foreach ($result as $record) { // データ表示

    // 日付フォーマットの変換
    $created_date = datetime_to_ymd($record["created_at"]);
    // カテゴリー
    $category_list = output_category($record["category"]);

    $output_question .= "
    <li>
      <a href='/diy_app/question/single.php?q_id={$record["id"]}'>
        <time>{$created_date}</time>
        {$category_list}
        <h2>{$record["title"]}</h2>
      </a>
    </li>
  ";
  }
  $output_question .= "</ul>";
}
?>

<!-- header -->
<?php include($path . "/common/header.php"); ?>
<!-- //header -->

<div class="hero">
  <img src="/diy_app/img/hero.png" width="200" height="200" alt="hero">
</div>

<main>
  <section class="section">
    <div class="wrapper">
      <h1>トップページ</h1>
      <p>このサイトはDIYでわからないことを聞ける、DIYerとメンターのマッチングサイトです。</p>
      <p><a href="/diy_app/diyer/register/">DIYerに登録する</a></p>
      <p><a href="/diy_app/mentor/register/">メンターに登録する</a></p>
      <section class="section">
        <h2>みんなの質問</h2>
        <?= $output_question; ?>
        <a href="/diy_app/question/">質問をもっとみる</a>
      </section>
    </div>
  </section>
</main>

<!-- footer -->
<?php include($path . "/common/footer.php"); ?>
<!-- //footer -->
