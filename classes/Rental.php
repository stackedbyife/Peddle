<?php

require_once "Db.php";

class Rental extends Db {
    private $dbcon;

    public function __construct() {
        $this->dbcon = $this->connect();
    }

    public function hasActiveRide($member_id) {
        try {
            $sql = "SELECT rental_id, bicycle_id, start_time, station_name, ride_status 
                    FROM rental 
                    LEFT JOIN station ON start_station_id = station_id 
                    WHERE member_id = ? AND ride_status IN ('pending', 'active')";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$member_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error checking active ride: " . $e->getMessage());
            return false;
        }
    }

    public function startRide($member_id, $bicycle_id, $start_station_id) {
        try {
            $check = $this->dbcon->prepare("SELECT * FROM bicycle WHERE bicycle_id = ? AND bicycle_status = 'available'");
            $check->execute([$bicycle_id]);

            if ($check->rowCount() == 0) {
                return "Selected bicycle is not available.";
            }

            $stmt = $this->dbcon->prepare("INSERT INTO rental (member_id, bicycle_id, start_station_id, start_time, ride_status) 
                                          VALUES (?, ?, ?, NOW(), 'pending')");
            $stmt->execute([$member_id, $bicycle_id, $start_station_id]);

            return "Ride started successfully!";
        } catch (PDOException $e) {
            return "Database Error: " . $e->getMessage();
        }
    }

    public function approveRide($rental_id) {
        try {
            $stmt = $this->dbcon->prepare("SELECT bicycle_id FROM rental WHERE rental_id = ? AND ride_status = 'pending'");
            $stmt->execute([$rental_id]);
            $bicycle_id = $stmt->fetchColumn();

            if (!$bicycle_id) {
                return "Ride not found or already approved.";
            }

            $updateRental = $this->dbcon->prepare("UPDATE rental SET ride_status = 'active' WHERE rental_id = ?");
            $updateRental->execute([$rental_id]);

            $updateBike = $this->dbcon->prepare("UPDATE bicycle SET bicycle_status = 'in_use' WHERE bicycle_id = ?");
            $updateBike->execute([$bicycle_id]);

            return "Ride approved successfully!";
        } catch (PDOException $e) {
            return "Error approving ride: " . $e->getMessage();
        }
    }

    public function endRide($rental_id, $end_station_id) {
        try {
            $checkRide = "SELECT bicycle_id FROM rental WHERE rental_id = ? AND ride_status = 'active'";
            $stmt = $this->dbcon->prepare($checkRide);
            $stmt->execute([$rental_id]);
            $bicycle_id = $stmt->fetchColumn();

            if (!$bicycle_id) {
                return "No active ride found with this ID.";
            }

            $sql = "UPDATE rental SET end_station_id = ?, ride_status = 'completed' WHERE rental_id = ?";
            $stmt = $this->dbcon->prepare($sql);

            if ($stmt->execute([$end_station_id, $rental_id])) {
                $updateBicycle = "UPDATE bicycle SET bicycle_status = 'available' WHERE bicycle_id = ?";
                $stmt = $this->dbcon->prepare($updateBicycle);
                $stmt->execute([$bicycle_id]);

                return "Ride completed successfully!";
            }
            return "Failed to complete ride.";
        } catch (PDOException $e) {
            error_log("Error ending ride: " . $e->getMessage());
            return "An error occurred.";
        }
    }

    public function cancelRide($rental_id) {
        try {
            $stmt = $this->dbcon->prepare("SELECT bicycle_id FROM rental WHERE rental_id = ? AND ride_status = 'active'");
            $stmt->execute([$rental_id]);
            $bicycle_id = $stmt->fetchColumn();

            if (!$bicycle_id) {
                return "No active ride found with this ID.";
            }

            $sql = "UPDATE rental SET ride_status = 'canceled' WHERE rental_id = ?";
            $stmt = $this->dbcon->prepare($sql);

            if ($stmt->execute([$rental_id])) {
                $updateBicycle = "UPDATE bicycle SET bicycle_status = 'available' WHERE bicycle_id = ?";
                $stmt = $this->dbcon->prepare($updateBicycle);
                $stmt->execute([$bicycle_id]);

                return "Ride canceled successfully!";
            }
            return "Failed to cancel ride.";
        } catch (PDOException $e) {
            error_log("Error canceling ride: " . $e->getMessage());
            return "An error occurred.";
            
        }
    }

    public function getAvailableBicycles() {
        try {
            $sql = "SELECT * FROM bicycle WHERE bicycle_status = 'available'";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching bicycles: " . $e->getMessage());
            return [];
        }
    }

    public function getAllStations() {
        try {
            $sql = "SELECT * FROM station";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching stations: " . $e->getMessage());
            return [];
        }
    }

    public function fetch_lga($stateid){
        try {
            $sql = "SELECT * FROM lga WHERE state_id=?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$stateid]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getStationsByLga($lga_id) {
        try {
            $sql = "SELECT * FROM station WHERE lga_id = ?";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$lga_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    
    public function getAvailableBicyclesByStation($station_id) {
        try {
            $sql = "SELECT * FROM bicycle WHERE station_id = ? AND bicycle_status = 'available'";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute([$station_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function getRentalHistory($member_id){
        try {
                $sql = "SELECT * FROM rental r  JOIN station s ON r.start_station_id= s.station_id WHERE member_id=?; ";
                $stmt = $this -> dbcon -> prepare($sql);
                $stmt -> execute([$member_id]);
                return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function get_lga($station_id){
        try{
            $sql = "SELECT lga.lga_name FROM station JOIN lga ON station.lga_id = lga.lga_id WHERE station_id=?;";
            $stmt = $this ->dbcon -> prepare($sql);
            $stmt-> execute([$station_id]);
            $name =$stmt -> fetch(PDO::FETCH_ASSOC);
            return $name;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}

// $rental = new Rental();
// echo "<pre>";
//     print_r($rental->get_lga(6));
// echo "</pre>";
?>

