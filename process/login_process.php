<?php

require_once "../classes/Utility.php";
require_once "../classes/Member.php";
$member = new Member();

    if(isset($_POST["btn_login"])){

        $email = $_POST["email"];
        $password = $_POST["password"];

        $log = $member -> login_user($email,$password);
        if($log){
            header("location:../index.php");
            exit;
        }else{
            $_SESSION["errormsg"]= "Invalid credentials";
            header("location: ../login.php");
            exit;
        }


    }else{

        $_SESSION["errormsg"]= "Kindly login";
        header("location:../login.php");
        exit();
        
    }

?>