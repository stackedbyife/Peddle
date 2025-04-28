<?php

// session_start();

if(!isset($_SESSION["member_id"])){
    $_SESSION["errormsg"] = "Kindly sign in to see this page ";
    header("location:login.php");
    exit();
}

?>