<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include $path . "/common/functions.php";

// セッションの有無をチェック
check_session_id("login");
// ユーザー属性のチェック
check_diyer();

$user_id = $_SESSION['user_id'];
$pdo = connect_to_db();

// -----------------------------
//  質問内容の取得
// -----------------------------
$sql = "SELECT questions_table.*, GROUP_CONCAT(categories_table.name SEPARATOR ',') AS category FROM questions_table LEFT OUTER JOIN question_category ON questions_table.id = question_category.question_id LEFT OUTER JOIN categories_table ON categories_table.id = question_category.category_id WHERE questions_table.user_id=:user_id AND questions_table.is_deleted=0 GROUP BY questions_table.id ORDER BY questions_table.created_at DESC";

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

    // 日付フォーマットの変換
    $created_date = datetime_to_ymd($result["created_at"]);

    // カテゴリー
    $category_list = output_category($record["category"]);

    // 非公開の場合 バッジを表示
    if ($record["is_published"] === 0) {
      $publish_condition = "<p style='color:red;'>非公開</p>";
    } else {
      $publish_condition = "<p style='visibility:hidden;'>公開</p>";
    }

    // 出力内容全体
    $output_question .= "
    <li>
      <time>{$created_date}</time>
      {$category_list}
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

<div class="hero hero--diyer">
  <img src="/diy_app/img/hero.png" width="200" height="200" alt="hero">
</div>

<main>
  <section class="section">
    <div class="wrapper">
      <h1>自分の質問一覧</h1>
      <p><a href="/diy_app/diyer/question/post.php">質問を投稿する</a></p>
      <?= $output_question; ?>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
