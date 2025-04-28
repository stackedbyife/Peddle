<?php

require_once "Db.php";

    class Bicycle extends Db{
        private $connection;

        public function __construct(){
            $this -> dbcon = $this -> connect();
        } 

        public function insert_bicycle($bicycle, $station_id, $status) {
            try {
                $sql = "INSERT INTO bicycle (bicycle_number, station_id, bicycle_status) VALUES (?, ?, ?)";
                $stmt = $this->dbcon->prepare($sql);
                $response = $stmt->execute([$bicycle, $station_id, $status]);
                return $response;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function delete_bicycle($id) {
            try {
                $sql = "DELETE FROM bicycle WHERE bicycle_id=?";
                $stmt = $this->dbcon->prepare($sql);
                $delete = $stmt->execute([$id]);
    
                if ($delete) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function fetch_stations(){
            $sql = "SELECT * FROM station"; 
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function approveRental($bicycle_id) {
            try {
                $query = "UPDATE rental SET ride_status = 'active' WHERE bicycle_id = :bicycle_id AND ride_status = 'pending'";
                $stmt = $this->dbcon->prepare($query);
                $stmt->bindParam(':bicycle_id', $bicycle_id);
                if ($stmt->execute()) {
                    return ['status' => 'success', 'message' => 'Rental has been approved.'];
                } else {
                    return ['status' => 'error', 'message' => 'Failed to approve the rental.'];
                }
            } catch (PDOException $e) {
   
                error_log("Error approving rental: " . $e->getMessage());
                return ['status' => 'error', 'message' => 'Error occurred: ' . $e->getMessage()];
            }
        }
        
        public function completeRental($bicycle_id) {
            try {
                $query = "UPDATE rental SET ride_status = 'returned' WHERE bicycle_id = :bicycle_id AND ride_status = 'completed'";
                $stmt = $this->dbcon->prepare($query);
                $stmt->bindParam(':bicycle_id', $bicycle_id);
                if ($stmt->execute()) {
                    return ['status' => 'success', 'message' => 'Rental has been completed.'];
                } else {
                    return ['status' => 'error', 'message' => 'Failed to complete the rental.'];
                }
            } catch (PDOException $e) {
                error_log("Error approving rental: " . $e->getMessage());
                return ['status' => 'error', 'message' => 'Error occurred: ' . $e->getMessage()];
            }
        }


    }

    // $bicycle = new Bicycle();
    // echo "<pre>";
    // print_r( $bicycle ->fetch_stations());
    // echo "<pre>";
?>