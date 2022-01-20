<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include $path . "/common/functions.php";
check_session_id("diyer/login");
?>

<!-- header -->
<?php include $path . "/common/header.php"; ?>
<!-- //header -->

<main>
  <section class="section">
    <div class="wrapper">
      <h1>質問投稿フォーム</h1>
      <div class="question-form">
        <form action="./post.php" method="POST">
          <dl>
            <dt>タイトル</dt>
            <dd>
              <input type="text" name="title">
            </dd>
          </dl>
          <dl>
            <dt>質問内容</dt>
            <dd>
              <textarea name="body" rows="10"></textarea>
            </dd>
          </dl>
          <button class="c-submit" type="submit">投稿する</button>
        </form>
      </div>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
