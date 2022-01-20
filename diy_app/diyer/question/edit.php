<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include($path . "/common/functions.php");
check_session_id("login");

$user_id = $_SESSION['user_id'];
$pdo = connect_to_db();

// -----------------------------
//  質問内容の取得
// -----------------------------
// 質問idをGETで受け取り
$q_id = $_GET["q_id"];

$sql = 'SELECT * FROM questions_table WHERE id=:q_id AND user_id=:user_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':q_id', $q_id, PDO::PARAM_INT);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
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
      <h1>質問を編集</h1>
      <?php if (!$result) : ?>
        <p>この投稿は見つかりませんでした.</p>
        <a href="/diy_app/diyer/dashboard/">マイページへ戻る</a>
      <?php elseif ($result["is_deleted"] === 1) : ?>
        <p>この投稿は削除されました.</p>
      <?php else : ?>
        <div class="question-form">
          <form action="./edit_act.php" method="POST">
            <input name="q_id" value="<?= $q_id; ?>" hidden>
            <dl>
              <dt>公開状態</dt>
              <dd>
                <select name="is_published">
                  <?php if ($result["is_published"] === 1) : ?>
                    <option value="published" selected>公開</option>
                    <option value="unpublished">下書き</option>
                    <option value="delete">削除</option>
                  <?php else : ?>
                    <option value="published">公開</option>
                    <option value="unpublished" selected>下書き</option>
                    <option value="delete">削除</option>
                  <?php endif; ?>
                </select>
              </dd>
            </dl>
            <dl>
              <dt>タイトル</dt>
              <dd>
                <input type="text" name="title" value="<?= $result["title"]; ?>">
              </dd>
            </dl>
            <dl>
              <dt>質問内容</dt>
              <dd>
                <textarea name="body" rows="10"><?= $result["body"]; ?></textarea>
              </dd>
            </dl>
            <button class="c-submit" type="submit">更新</button>
          </form>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
