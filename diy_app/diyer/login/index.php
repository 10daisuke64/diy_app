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
      <h1>DIYer用 ログインフォーム</h1>
      <div class="login-form">
        <form action="./login.php" method="POST">
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
          <button class="c-submit" type="submit">ログイン</button>
        </form>
      </div>
      <a href="/diy_app/diyer/register/">新規登録</a>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
