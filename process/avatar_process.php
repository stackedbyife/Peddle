<?php
session_start();
require_once "../classes/Member.php";
// echo "<pre>";
// print_r("$_POST");
// echo  "</pre>";

if(isset($_POST["btnavatar"])){
    $avatar = $_POST["selected_avatar"];

    $member =new Member();
    $result= $member -> avatar($avatar);
    // echo "<pre>";
    //     print_r($result);
    // echo "</pre>";

    if ($result) {
        $_SESSION["feedback"] = "Pedal power unlocked!  <br> Your account is good to go!";
        header("location: ../login.php"); 
        exit();
    }else{
        $_SESSION["errormsg"] = "ENo avatar selected.";
        header("location: ../avatar.php");
        exit();
    }


}else {
    $_SESSION["errormsg"]= "Kindly complete the form ";
    header("location:../registration.php");
    exit();
}


?>