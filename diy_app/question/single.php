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

$sql = 'SELECT * FROM questions_table WHERE id=:q_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':q_id', $q_id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
$result = $stmt->fetch();
?>

<!-- header -->
<?php include $path . "/common/header.php"; ?>
<!-- //header -->

<main>
  <section class="section">
    <div class="wrapper">
      <?php if (!$result) : ?>
        <p>この投稿は見つかりませんでした.</p>
      <?php elseif ($result["is_deleted"] === 1) : ?>
        <p>この投稿は削除されました.</p>
      <?php elseif ($result["is_published"] === 0) : ?>
        <p>この投稿は非公開です.</p>
      <?php else : ?>
        <h1><?= $result["title"]; ?></h1>
        <p><?= $result["body"]; ?></p>
      <?php endif; ?>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
