<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include $path . "/common/functions.php";
// セッションの有無をチェック
check_session_id("login");
// ユーザー属性のチェック
check_diyer();

// -----------------------------
//  POST 受け取り
// -----------------------------
if (
  !isset($_POST['title']) || $_POST['title'] == '' ||
  !isset($_POST['body']) || $_POST['body'] == ''
) {
  exit('paramError');
}
$title = $_POST["title"];
$body = $_POST["body"];
$category = $_POST['category'];
$user_id = $_SESSION['user_id'];
// var_dump($title);
// var_dump($body);
// var_dump($category);
// var_dump($user_id);
// exit();

// -----------------------------
//  投稿処理
// -----------------------------
$pdo = connect_to_db();
$sql = 'INSERT INTO questions_table(id, user_id, title, body, is_published, is_deleted, created_at, updated_at) VALUES(NULL, :user_id, :title, :body, 1, 0, now(), now());';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':body', $body, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

// -----------------------------
//  カテゴリーの登録処理
// -----------------------------
// 直前にINSERTされた questionのidを取得
$question_id = $pdo->lastInsertId();

$sql = 'INSERT INTO question_category(id, question_id, category_id) VALUES';
// SQL文に追記（複数行の値の挿入）
$sql_array = [];
for ($i = 0; $i < count($category); $i++) {
  $sql_array[] = "
    (NULL, :question_id, :category_id_{$i})
  ";
}
$sql .= implode(',', $sql_array);

$stmt = $pdo->prepare($sql);

// バインド処理
$stmt->bindValue(':question_id', $question_id, PDO::PARAM_STR);
for ($i = 0; $i < count($category); $i++) {
  $stmt->bindValue(":category_id_{$i}", $category[$i], PDO::PARAM_STR);
}

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

header("Location:/diy_app/diyer/question");
exit();
