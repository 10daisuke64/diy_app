<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include $path . "/common/functions.php";
check_session_id("login");

// -----------------------------
//  POST 受け取り
// -----------------------------
if (
  !isset($_POST['title']) || $_POST['title'] == '' ||
  !isset($_POST['body']) || $_POST['body'] == '' ||
  !isset($_POST['is_published']) || $_POST['is_published'] == ''
) {
  exit('paramError');
}
$q_id = $_POST["q_id"];
$title = $_POST["title"];
$body = $_POST["body"];

// 公開状態
$is_published_value = $_POST["is_published"];
if ($is_published_value == "delete") {
  $is_deleted = 1;
  $is_published = 0;
} elseif ($is_published_value == "published") {
  $is_deleted = 0;
  $is_published = 1;
} else {
  $is_deleted = 0;
  $is_published = 0;
}

// var_dump($title);
// var_dump($body);
// var_dump($is_deleted);
// var_dump($is_published);
// exit();

$pdo = connect_to_db();

$sql = "UPDATE questions_table SET title=:title, body=:body, is_published=:is_published, is_deleted=:is_deleted, updated_at=now() WHERE id=:q_id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':body', $body, PDO::PARAM_STR);
$stmt->bindValue(':is_published', $is_published, PDO::PARAM_INT);
$stmt->bindValue(':is_deleted', $is_deleted, PDO::PARAM_INT);
$stmt->bindValue(':q_id', $q_id, PDO::PARAM_INT);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// 削除された場合ダッシュボードへ
// それ以外の更新は再度edit.phpへ
if ($is_deleted === 1) {
  header("Location:/diy_app/diyer/dashboard");
  exit();
} else {
  header("Location:/diy_app/diyer/question/edit.php?q_id={$q_id}");
  exit();
}
