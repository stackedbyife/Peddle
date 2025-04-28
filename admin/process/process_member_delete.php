<?php

require_once "../classes/Admin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userid"])) {
    $userid = intval($_POST["userid"]); 

    $admin = new Admin();
    $result = $admin->delete_user($userid); 

    if ($result) {
        echo json_encode(["status" => "success", "message" => "User deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete User"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}

?>