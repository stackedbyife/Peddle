<?php
require_once "../classes/Station.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["stationid"])) {
    $stationid = intval($_POST["stationid"]); 

    $station = new Station();
    $result = $station->delete_station($stationid); 

    if ($result) {
        echo json_encode(["status" => "success", "message" => "Station deleted successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to delete Station"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}
?>