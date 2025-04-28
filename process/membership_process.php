<?php

session_start();
require_once "../classes/Member.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["selected_plan"])) {
    
    $plan = $_POST["selected_plan"];
    $member = new Member();

    $result = $member -> membership_plan($plan);
    // echo "<pre>";
    //     print_r($result);
    // echo "</pre>";
    if ($result) {
        $_SESSION["feedback"] = "Membership plan selected successfully!";
        header("location: ../avatar.php"); 
        exit();
    }else{
        $_SESSION["errormsg"] = "Error updating membership plan.";
        header("location: ../membership.php");
        exit();
    }

}else {
    $_SESSION["errormsg"]= "Kindly complete the form ";
    header("location:../registration.php");
    exit();
}

?>