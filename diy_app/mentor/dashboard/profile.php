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

<div class="hero hero--mentor">
  <img src="/diy_app/img/hero.png" width="200" height="200" alt="hero">
</div>

<main>
  <section class="section">
    <div class="wrapper">
      <h1>プロフィール設定</h1>
    </div>
  </section>
</main>

<!-- footer -->
<?php include $path . "/common/footer.php"; ?>
<!-- //footer -->
