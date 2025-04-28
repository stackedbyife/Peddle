<?php
session_start();
require_once "classes/Admin.php";


$admin = new Admin();
$admin -> logout();
header("location:admin_login.php");
exit();

?>