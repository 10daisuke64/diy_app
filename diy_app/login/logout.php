<?php
session_start();
$path = $_SERVER['DOCUMENT_ROOT'] . "/diy_app";
include $path . "/common/functions.php";

delete_session();
header('Location:/diy_app/');
exit();
