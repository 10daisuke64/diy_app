<?php
  $path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
  include($path . "/common/functions.php");
?>

<!-- header -->
<?php include($path . "/common/header.php"); ?>
<!-- //header -->

<main>
  <section class="section">
    <div class="wrapper">
      <h1>ログイン</h1>
      <div class="login-container">
        <ul>
          <li>
            <a href="/diy_app/diyer/login/">DIYerの方はこちら</a>
          </li>
          <li>
            <a href="/diy_app/mentor/login/">メンターの方はこちら</a>
          </li>
        </ul>
      </div>
    </div>
  </section>
</main>

<!-- footer -->
<?php include($path . "/common/footer.php"); ?>
<!-- //footer -->
