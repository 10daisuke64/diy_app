<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include $path . "/common/functions.php";
// セッションの有無をチェック
check_session_id("login");
// ユーザー属性のチェック
check_mentor();
?>

<!-- header -->
<?php include $path . "/common/header.php"; ?>
<!-- //header -->

<main>
  <section class="section">
    <div class="wrapper">
      <h1>回答フォーム</h1>
      <div class="question-form">
        <form action="./post_act.php" method="POST">
          <dl>
            <dt>タイトル</dt>
            <dd>
              <input type="text" name="title">
            </dd>
          </dl>
          <dl>
            <dt>回答内容</dt>
            <dd>
              <textarea name="body" rows="10"></textarea>
            </dd>
          </dl>
          <button class="c-submit" type="submit">回答する</button>
        </form>
      </div>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
