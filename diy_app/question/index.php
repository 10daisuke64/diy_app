<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include($path . "/common/functions.php");

$pdo = connect_to_db();
// -----------------------------
//  質問リストの取得
// -----------------------------
$sql = 'SELECT * FROM questions_table WHERE is_deleted=0 AND is_published=1 ORDER BY created_at DESC';
$stmt = $pdo->prepare($sql);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// 出力
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output_question = "";
if (!$result) {
  $output_question .= "<p>質問はありませんでした</p>";
} else {
  $output_question .= "<ul class='d-dash-qlist'>";
  foreach ($result as $record) {
    $output_question .= "
    <li>
      <a href='/diy_app/question/single.php?q_id={$record["id"]}'>
        <h2>{$record["title"]}</h2>
        <time>{$record["created_at"]}</time>
      </a>
    </li>
  ";
  }
  $output_question .= "</ul>";
}
?>


<!-- header -->
<?php include $path . "/common/header.php"; ?>
<!-- //header -->

<main>
  <section class="section">
    <div class="wrapper">
      <h1>みんなの質問</h1>
      <?= $output_question; ?>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
