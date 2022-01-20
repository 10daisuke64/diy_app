<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>diy app</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <?php include($path . "/common/seo.php"); ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/diy_app/css/style.min.css">
</head>

<body>
  <!-- header -->
  <header class="header">
    <div class="header-wrapper">
      <h1 class="header__logo">
        <a href="/diy_app/">DIY app</a>
      </h1>
      <nav class="header__nav">
        <ul class="g-nav">
          <?php if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] != session_id()) : ?>
            <li class="g-nav__item">
              <a href="/diy_app/login/">ログイン</a>
            </li>
            <li class="g-nav__item">
              <a href="/diy_app/register/">新規登録</a>
            </li>
          <?php else : ?>
            <li class="g-nav__item">
              <a href="/diy_app/login/mypage.php">マイページ</a>
            </li>
            <li class="g-nav__item">
              <a href="/diy_app/login/logout.php">ログアウト</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>
  <!-- //header -->
