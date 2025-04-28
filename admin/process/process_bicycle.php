<?php
require_once "../classes/Bicycle.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bike_number = $_POST['bicycle'] ?? '';
    $station_id = $_POST['station'] ?? '';
    $status = $_POST['status'] ?? '';

    if (!$bike_number || !$station_id || !$status) {
        echo json_encode([
            'status' => 'error',
            'message' => 'All fields are required.'
        ]);
        exit;
    }

    $bike = new Bicycle();
    $result = $bike->insert_bicycle($bike_number, $station_id, $status);

    if ($result) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Bicycle added successfully.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to add bicycle.'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
}