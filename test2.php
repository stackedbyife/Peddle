<?php
session_start();
require_once "member_guard.php";
require_once "classes/Member.php";
require_once "classes/Rental.php";

$id = $_SESSION["member_id"];
$member = new Member();
$details = $member->get_member($id);

$rental = new Rental();
$activeRide = $rental->getActiveRide($id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Active Ride</title>
</head>
<body>

<div class="container big_box">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 mt-5">
            <div class="card shadow-sm p-4 rounded-4 border-0 mb-4" style="background: linear-gradient(135deg, #6290C8, #9D5C63); color: white;">
                <h5 class="fw-semibold mb-2">Active Ride</h5>

                <?php if ($activeRide): ?>
                    <p>From <strong><?php echo $activeRide["start_station_id"]; ?></strong> to <strong><?php echo $activeRide["end_station_id"] ?: "Not Set"; ?></strong></p>
                    <p>Bicycle ID: <strong><?php echo $activeRide["bicycle_id"]; ?></strong></p>
                    <p>Started at: <strong><?php echo date("h:i A", strtotime($activeRide["start_time"])); ?></strong></p>
                    <p>Status: <strong><?php echo ucfirst($activeRide["ride_status"]); ?></strong></p>

                    <!-- End Ride Button -->
                    <button class="btn btn-warning" onclick="endRide(<?php echo $activeRide['rental_id']; ?>)">End Ride</button>
                    <!-- Cancel Ride Button -->
                    <button class="btn btn-danger" onclick="cancelRide(<?php echo $activeRide['rental_id']; ?>)">Cancel Ride</button>
                <?php else: ?>
                    <p>No active ride found. Start a new ride below:</p>
                    <form id="startRideForm">
                        <select name="bicycle_id">
                            <option value="1">Bicycle 1</option>
                            <option value="2">Bicycle 2</option>
                        </select>
                        <select name="start_station_id">
                            <option value="1">Ikeja</option>
                            <option value="2">Lekki</option>
                        </select>
                        <button type="button" class="btn btn-success" onclick="startRide()">Start Ride</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
function startRide() {
    $.post("rental_process.php", $("#startRideForm").serialize() + "&action=start", function(response) {
        alert(response);
        location.reload();
    });
}

function endRide(rental_id) {
    $.post("rental_process.php", { rental_id: rental_id, end_station_id: 2, action: "end" }, function(response) {
        alert(response);
        location.reload();
    });
}

function cancelRide(rental_id) {
    $.post("rental_process.php", { rental_id: rental_id, action: "cancel" }, function(response) {
        alert(response);
        location.reload();
    });
}
</script>

</body>
</html>