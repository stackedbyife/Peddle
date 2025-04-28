<?php
session_start();
require_once "../classes/Member.php";
$id = $_SESSION["member_id"];

    if(isset($_POST["btnedit"])){
        $firstname = $_POST["first_name"];
        $lastname = $_POST["last_name"];
        $phone = $_POST["phone"];
        $membership = $_POST["membership"];

        $member = new Member();
        $edit = $member -> edit_member($firstname,$lastname,$phone,$membership,$id);
        if($edit){
            $_SESSION["editfeedback"]= "Your account has been updated successfully";
            header("location:../dashboard.php");
        }else{
            $_SESSION["editerrormsg"] = "Error your account was not updated";
            header("location:../edit_profile.php");
        }

    }else{

        $_SESSION["errormsg"]= "Error";
        header("location:../login.php");
        exit();
        
    }

?>