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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rental_id = $_POST['rental_id'];

    // Ensure the rental ID exists and is active
    $result = $rental->endRide($rental_id, $end_station_id = 1); 

    if ($result === "Ride completed successfully!") {
        header("Location: ../dashboard_rides.php");
        exit();
    } else {
        echo "<p>$result</p>";
    }
}
?>