<?php

session_start();
   if(!isset($_SESSION["adminonline"])){
    $_SESSION["adminerror"] = "Access restricted to administrators";
    header("location:admin_login.php");
    exit();
   }

?>