<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include($path . "/common/functions.php");
?>

<!-- header -->
<?php include($path . "/common/header.php"); ?>
<!-- //header -->

<main>
  <section class="section">
    <div class="wrapper">
      <h1>トップページ</h1>
      <?php
      if ($_SESSION["is_diyer"] === 1) {
        echo "<p>あなたはDIYerです</p>";
      } elseif ($_SESSION["is_mentor"] === 1) {
        echo "<p>あなたはメンターです</p>";
      } elseif ($_SESSION["is_admin"] === 1) {
        echo "<p>あなたは管理者です</p>";
      } else {
      }
      ?>
    </div>
  </section>
</main>

<!-- footer -->
<?php include($path . "/common/footer.php"); ?>
<!-- //footer -->
