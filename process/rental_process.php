<?php
session_start();
require_once "../classes/Rental.php";
require_once "../classes/Db.php";

if (!isset($_SESSION['member_id'])) {
    header("Location: login.php");
    exit();
}

$member_id = $_SESSION['member_id'];


$rental = new Rental();


$availableBicycles = $rental->getAvailableBicycles();


$stations = $rental->getAllStations();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bicycle_id = $_POST['bicycle_id'];
    $start_station_id = $_POST['start_station_id'];
  

    $result = $rental->startRide($member_id, $bicycle_id, $start_station_id);

    if ($result === "Ride started successfully!") {
        $_SESSION['ride_start_message'] = 'Your ride has started successfully!';
        header("Location: ../dashboard_rides.php");
        exit();
    } else {
        echo "<p>$result</p>";
    }
}

?>