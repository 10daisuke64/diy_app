<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include($path . "/common/functions.php");

$pdo = connect_to_db();

// -----------------------------
//  質問内容の取得
// -----------------------------
// 質問idをGETで受け取り
$q_id = $_GET["q_id"];

// $sql = 'SELECT * FROM questions_table WHERE id=:q_id';
$sql = "SELECT questions_table.*, GROUP_CONCAT(categories_table.name SEPARATOR ',') AS category FROM questions_table LEFT OUTER JOIN question_category ON questions_table.id = question_category.question_id LEFT OUTER JOIN categories_table ON categories_table.id = question_category.category_id WHERE questions_table.id=:q_id GROUP BY questions_table.id ORDER BY questions_table.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':q_id', $q_id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$result = $stmt->fetch();
// var_dump($result);
// exit();

// -----------------------------
//  回答ボタン / 編集ボタン
// -----------------------------
$output_action = "";

if ($result["user_id"] == $_SESSION["user_id"]) {
  $output_action .= "
    <a href='/diy_app/diyer/question/edit.php?q_id={$q_id}'>自分の質問を編集する</a>
  ";
} elseif (!$_SESSION["is_diyer"] == 1) {
  $output_action .= "
    <a href='/diy_app/mentor/answer/post.php?q_id={$q_id}'>質問に回答する</a>
  ";
}

// -----------------------------
// 出力
// -----------------------------
$output = "";

// 日付フォーマットの変換
$created_date = datetime_to_ymd($result["created_at"]);
// カテゴリー
$category_list = output_category($result["category"]);

$output .= "
  <time>{$created_date}</time>
  {$category_list}
  <h2>{$result["title"]}</h2>
  <p>{$result["body"]}</p>
  {$output_action}
";
$output .= "</ul>";
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
      <h1>質問の内容</h1>
      <?php if (!$result) : ?>
        <p>この投稿は見つかりませんでした.</p>
      <?php elseif ($result["is_deleted"] === 1) : ?>
        <p>この投稿は削除されました.</p>
      <?php elseif ($result["is_published"] === 0) : ?>
        <p>この投稿は非公開です.</p>
      <?php else : ?>
        <?= $output; ?>
      <?php endif; ?>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
