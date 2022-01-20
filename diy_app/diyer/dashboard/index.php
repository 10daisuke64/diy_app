<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include $path . "/common/functions.php";
check_session_id("login");

$user_id = $_SESSION['user_id'];
$pdo = connect_to_db();

// -----------------------------
//  質問内容の取得
// -----------------------------
$sql = 'SELECT * FROM questions_table WHERE user_id=:user_id AND is_deleted=0 ORDER BY created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}
// -----------------------------
//  質問の出力
// -----------------------------
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$output_question = "";

// 質問がなかった場合を考慮
if (!$result) {
  $output_question .= "<p>質問はありませんでした</p>";
} else {
  $output_question .= "<ul class='d-dash-qlist'>";
  foreach ($result as $record) {
    // 非公開の場合 バッジを表示
    if ($record["is_published"] === 0) {
      $publish_condition = "<p style='color:red;'>非公開</p>";
    }
    $output_question .= "
    <li>
      <h3>{$record["title"]}</h3>
      <p>{$record["body"]}</p>
      {$publish_condition}
      <a href='/diy_app/question/single.php?q_id={$record["id"]}'>投稿をみる</a>
      <a href='/diy_app/diyer/question/edit.php?q_id={$record["id"]}'>編集する</a>
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
      <h1>DIYer用マイページ</h1>
      <a href="/diy_app/diyer/question/">質問を投稿する</a>

      <section class="section">
        <h2>自分の質問一覧</h2>
        <?= $output_question; ?>
      </section>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
