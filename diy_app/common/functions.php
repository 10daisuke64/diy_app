<?php

// -----------------------------
//  DB接続
// -----------------------------
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

// -----------------------------
//  SESSION関連
// -----------------------------
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

// ユーザー属性のチェック
function check_diyer()
{
  if (!$_SESSION["is_diyer"] == 1) {
    error404();
  }
}
function check_mentor()
{
  if (!$_SESSION["is_mentor"] == 1) {
    error404();
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

// -----------------------------
// 404 へのリダイレクト
// -----------------------------
function error404()
{
  http_response_code(404);
  include $_SERVER['DOCUMENT_ROOT'] . "/diy_app/404.php";
  exit();
}

// -----------------------------
//  出力に使う関数
// -----------------------------
// 日付フォーマットの変更
function datetime_to_ymd($datetime)
{
  $created_datetime = new DateTime($datetime);
  return $created_datetime->format('Y-m-d');
}

// カテゴリーの出力
function output_category($data)
{
  $category_list = "";
  if (!empty($data)) {
    $record_category = explode(",", $data);
    $category_list .= "<div class='c-category'>";
    foreach ($record_category as $val) {
      $category_list .= "
        <span>{$val}</span>
      ";
    }
    $category_list .= "</div>";
  } else {
    $category_list = "";
  }
  return $category_list;
}
