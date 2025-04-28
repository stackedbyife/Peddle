<?php
session_start();
require_once "classes/Member.php";

$member = new Member();
$member -> logout();
// print_r($_)
// die();
header("location:login.php");
exit();
?>