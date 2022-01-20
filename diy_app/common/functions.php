<?php

// データベース接続
function connect_to_db()
{
  $dbn = 'mysql:dbname=diy_app;charset=utf8mb4;port=3306;host=localhost';
  $user = 'root';
  $pwd = '';
  try {
    return new PDO($dbn, $user, $pwd);
  } catch (PDOException $e) {
    exit('dbError:' . $e->getMessage());
  }
}

// ログイン状態のチェック
// 引数はリダイレクト先
function check_session_id($url)
{
  if (!isset($_SESSION["session_id"]) || $_SESSION["session_id"] != session_id()) {
    header("Location:/diy_app/{$url}");
    exit();
  } else {
    session_regenerate_id(true);
    $_SESSION["session_id"] = session_id();
  }
}

// セッション破棄
function delete_session()
{
  $_SESSION = array();
  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
  }
  session_destroy();
}
