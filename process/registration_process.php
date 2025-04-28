<?php
session_start();
require_once "../classes/Utility.php";
require_once "../classes/Member.php";

$member = new Member();
if(isset($_POST["reg_btn"])){
    echo "<pre>";
        print_r($_POST);
    echo "<pre>";
   

    $first_name = Utility::sanitize($_POST["first_name"]);
    $last_name = Utility::sanitize($_POST["last_name"]);
    $email = Utility::sanitize($_POST["email"]);
    $country_code = Utility::sanitize($_POST["country_code"]);
    $phone_number = Utility::sanitize($_POST["phone_number"]);
    $password1 = Utility::sanitize($_POST["password"]);
    $password2 = Utility::sanitize($_POST["confirm_password"]);

    if(empty($first_name) || empty($last_name) || empty($email) || empty($phone_number) || empty($password1)){
        $_SESSION["errormsg"] = "Kindly complete the form";
        header("location:../registration.php");
        exit();
    }
    elseif($password1 != $password2){
        $_SESSION["errormsg"] = "Your passwords don't match";
        header("location:../registration.php");
        exit();
    }elseif($member-> email_exist($email) === true){
        $_SESSION["errormsg"] = "Email already exist";
        header("location:../registration.php");
        exit();
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION["errormsg"] = "Ensure you have a valide email";
        header("location:../registration.php");
        exit();
    }
    else{
        $created = $member-> register_new_user($first_name, $last_name, $email, $phone_number, $password1);
        if($created){
            // $_SESSION["feedback"] = "Pedal power unlocked!  <br> Your account is good to go!";
            header("location:../upload.php");
            exit();
        }else{
            $_SESSION["errormsg"] = "Registration Failed/ try again";
            header("location:../registration.php");
            exit();
        }
    }
    
    


}else{
    $_SESSION["errormsg"]= "Kindly complete the form ";
    header("location:../registration.php");
    exit();

}

?>