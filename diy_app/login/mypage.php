<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include($path . "/common/functions.php");
check_session_id("login");

// echo $_SESSION["is_diyer"];
// echo $_SESSION["is_mentor"];
// exit();

if ($_SESSION["is_diyer"] === 1) {
  header('Location:/diy_app/diyer/dashboard/');
  exit();
} elseif ($_SESSION["is_mentor"] === 1) {
  header('Location:/diy_app/mentor/dashboard/');
  exit();
} elseif ($_SESSION["is_admin"] === 1) {
  echo "is_admin";
} else {
  delete_session();
  header('Location:/diy_app/login/');
  exit();
}
