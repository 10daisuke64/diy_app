<?php
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include($path . "/common/functions.php");
?>

<!-- header -->
<?php include($path . "/common/header.php"); ?>
<!-- //header -->

<div class="hero">
  <img src="/diy_app/img/hero.png" width="200" height="200" alt="hero">
</div>

<main>
  <section class="section">
    <div class="wrapper">
      <h1>新規登録</h1>
      <div class="login-container">
        <ul>
          <li>
            <a href="/diy_app/diyer/register/">DIYerの方はこちら</a>
          </li>
          <li>
            <a href="/diy_app/mentor/register/">メンターの方はこちら</a>
          </li>
        </ul>
      </div>
    </div>
  </section>
</main>

<!-- footer -->
<?php include($path . "/common/footer.php"); ?>
<!-- //footer -->
