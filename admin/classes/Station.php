<?php
require_once "Db.php";

class Station extends Db {
    private $connection;

    public function __construct(){
        $this->dbcon = $this->connect();
    }

    public function insert_station($name, $lg, $capacity){
        try {
            $sql = "INSERT INTO station (station_name, lga_id, capacity) VALUES (?, ?, ?)";
            $stmt = $this->dbcon->prepare($sql);
            return $stmt->execute([$name, $lg, $capacity]);
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function fetch_station(){
        try {
            $sql = "SELECT station.*, lga.lga_name FROM station 
                    JOIN lga ON station.lga_id = lga.lga_id";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function delete_station($id){
        try {
            $sql = "DELETE FROM station WHERE station_id=?";
            $stmt = $this->dbcon->prepare($sql);
            return $stmt->execute([$id]);
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
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

    public function fetch_rent(){
        try {
            $sql = "SELECT 
                            r.rental_id ,
                            CONCAT(IFNULL(m.first_name, ''), ' ', IFNULL(m.last_name, '')) AS `renter_name`,
                            b.bicycle_number ,
                            b.bicycle_status ,
                            s.station_name ,
                            l.lga_name,
                            r.ride_status,
                            b.bicycle_id
                        FROM 
                            rental r
                        JOIN 
                            members m ON r.member_id = m.member_id
                        JOIN 
                            bicycle b ON r.bicycle_id = b.bicycle_id
                        JOIN 
                            station s ON b.station_id = s.station_id
                        JOIN 
                            lga l ON s.lga_id = l.lga_id; ";
            $stmt = $this -> dbcon -> prepare($sql);
            $stmt -> execute();
            $response = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            return $response;
        } catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}