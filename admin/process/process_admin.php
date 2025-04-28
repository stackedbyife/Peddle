<?php
session_start();
require_once "../classes/Utility.php";
require_once "../classes/Admin.php";


        // echo "<pre>";
        //     print_r($_POST);
        // echo "<pre>";

$admin1 = new Admin();

    if(isset($_POST["btn_admin"])){


        $email = Utility::sanitize($_POST["email"]);
        $password = Utility::sanitize($_POST["password"]);

        $log = $admin1 -> login($email,$password);
        if(empty($email) || empty($password)){
            $_SESSION["adminerror"] = "Kindly complete the form";
            header("location:../admin_login.php");
            exit();
        }elseif($log){
            $_SESSION["adminonline"]= $log;
            $_SESSION["adminfeedback"] = "You are logged in";
            header("location:../admin.php");
            exit();
        }else{
            $_SESSION["adminerror"]= "Invalid credentials";
            header("location:../admin_login.php");
            exit;
        }

    }else{
        $_SESSION["adminerror"]= "Kindly complete the form ";
        header("location:../admin_login.php");
        exit();
    }

?>