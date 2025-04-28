<?php
require_once "../classes/Bicycle.php"; 
$bicycle = new Bicycle();


if (isset($_POST['btndelete1'])) {
    $bicycleId = $_POST['btndelete1'];

    $deleteStatus = $bicycle->delete_bicycle($bicycleId);

    if ($deleteStatus) {
        echo json_encode(['status' => 'success', 'message' => 'Bicycle deleted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'An error occurred while deleting the bicycle.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No bicycle ID provided.']);
}
?>