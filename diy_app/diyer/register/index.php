<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include $path . "/common/functions.php";
?>

<!-- header -->
<?php include $path . "/common/header.php"; ?>
<!-- //header -->

<main>
  <section class="section">
    <div class="wrapper">
      <h1>DIYer用 新規登録フォーム</h1>
      <div class="login-form">
        <form action="./register.php" method="POST">
          <dl>
            <dt>お名前</dt>
            <dd>
              <input type="text" name="name">
            </dd>
          </dl>
          <dl>
            <dt>メールアドレス</dt>
            <dd>
              <input type="email" name="email">
            </dd>
          </dl>
          <dl>
            <dt>パスワード</dt>
            <dd>
              <input type="password" name="password">
            </dd>
          </dl>
          <button class="c-submit" type="submit">登録</button>
        </form>
      </div>
      <a href="/diy_app/diyer/login/">ログイン</a>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
