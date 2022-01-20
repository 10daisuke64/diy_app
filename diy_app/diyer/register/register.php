<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include $path . "/common/functions.php";

// -----------------------------
//  POST 受け取り
// -----------------------------
if (
  !isset($_POST['name']) || $_POST['name'] == '' ||
  !isset($_POST['email']) || $_POST['email'] == '' ||
  !isset($_POST['password']) || $_POST['password'] == ''
) {
  exit('paramError');
}

$name = $_POST["name"];
$email = $_POST["email"];
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
// var_dump($name);
// var_dump($email);
// var_dump($password);
// exit();

// -----------------------------
//  メールアドレス登録済みチェック
// -----------------------------
$pdo = connect_to_db();

$sql = 'SELECT COUNT(*) FROM users_table WHERE email=:email';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

if ($stmt->fetchColumn() > 0) {
  header("Location:/diy_app/diyer/register/already_exist.php");
  exit();
}

// -----------------------------
//  登録処理
// -----------------------------
$sql = 'INSERT INTO users_table(id, name, email, password, is_admin, is_diyer, is_mentor, is_deleted, created_at, updated_at) VALUES(NULL, :name, :email, :password, 0, 1, 0, 0, now(), now())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);

try {
  $status = $stmt->execute();
} catch (PDOException $e) {
  echo json_encode(["sql error" => "{$e->getMessage()}"]);
  exit();
}

$val = $stmt->fetch();
$_SESSION = array();
$_SESSION['session_id'] = session_id();
$_SESSION['user_id'] = $val['id'];
$_SESSION['is_admin'] = $val['is_admin'];
$_SESSION['is_diyer'] = $val['is_diyer'];
$_SESSION['is_mentor'] = $val['is_mentor'];
header("Location:/diy_app/diyer/dashboard/");
exit();

// header("Location:/diy_app/diyer/login");
// exit();
