<?php
session_start();
require_once "../classes/Member.php";


    if(isset($_POST["btndoc"])){
    // echo "<pre>";
    //     print_r($_POST);
    //     print_r($_FILES);
    //     print_r($_SESSION);
    // echo "</pre>";
    // exit();

        if (!isset($_SESSION["member_id"])) {
            $_SESSION["errormsg"] = "Session expired. Please log in again.";
            header("location: ../upload.php");
            exit();
        }
        
        $file_type = $_POST["file_type"];

        // echo "<pre>";
        // print_r($_FILES["id_document"]);
        // echo "</pre>";

        $filename = $_FILES["id_document"]["name"];
        $filetext =$_FILES["id_document"]["type"];
        $filetmpname =$_FILES["id_document"]["tmp_name"];
        $fileerror =$_FILES["id_document"]["error"];
        $filesize =$_FILES["id_document"]["size"];


//problem1: file error
        if($fileerror != 0){
            $_SESSION["errormsg"] = "Please select a document ";
            header("location:../upload.php");
            exit();
        }
//File more than 2mb
        if($filesize >2097152){
            $_SESSION["errormsg"] = "You cannot upload more than 2mb";
            header("location:../upload.php");
            exit(); 
        }
//  Problem 3: Invalid file type
    $allowed = ["jpg", "jpeg", "png", "pdf"];
    $user_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if (!in_array($user_ext, $allowed)) {
        $_SESSION["errormsg"] = "Please upload a file of type: JPG, PNG, JPEG, or PDF.";
        header("location: ../upload.php");
        exit();
    }

// unique filename to prevent overwriting
    $new_filename = uniqid("ID_", true) . "." . $user_ext;
    $upload_dir = "../documents/";
    $upload_path = $upload_dir . $new_filename;

    if (!move_uploaded_file($filetmpname, $upload_path)) {
        $_SESSION["errormsg"] = "File upload failed. Try again.";
        header("location: ../upload.php");
        exit();
    }

    $member = new Member();
    $result = $member->upload_document($upload_path);

        if ($result) {
            $_SESSION["feedback"] = "Document uploaded successfully!";
            $_SESSION["uploaded_file"] = $new_filename;
            header("location: ../membership.php");
            exit();
        } else {
            unlink($upload_path); 
            $_SESSION["errormsg"] = "Database error: Could not save file.";
            header("location: ../upload.php");
            exit();
        }

        }else {
            $_SESSION["errormsg"]= "Kindly complete the form ";
            header("location:../registration.php");
            exit();
        }
?>