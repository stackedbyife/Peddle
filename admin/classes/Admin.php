<?php

require_once "Db.php";


    class Admin extends Db{
        private $connection;

            public function __construct(){
                $this -> dbcon = $this -> connect();
            }

            public function fetch_users(){
                try{
                    $sql = "SELECT * FROM members ORDER BY created_at DESC";
                    $stmt = $this -> dbcon -> prepare($sql);
                    $stmt -> execute();
                    $members = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                    return $members;
                    

                }catch(PDOException $e){
                    echo $e -> getMessage();
                    return false;
                }
            }

            public function fetch_bicycle(){
                try{
                    $sql = "SELECT 
                                    b.bicycle_id, 
                                    b.bicycle_number, 
                                    b.bicycle_status, 
                                    s.station_name, 
                                    l.lga_name, 
                                    CONCAT(IFNULL(m.first_name, ''), ' ', IFNULL(m.last_name, '')) AS renter_name,
                                    r.ride_status
                                FROM 
                                    bicycle b 
                                JOIN 
                                    station s ON b.station_id = s.station_id 
                                JOIN 
                                    lga l ON s.lga_id = l.lga_id 
                                LEFT JOIN 
                                    rental r ON b.bicycle_id = r.bicycle_id
                                LEFT JOIN 
                                    members m ON r.member_id = m.member_id;";
                    $stmt = $this -> dbcon -> prepare($sql);

                    $stmt -> execute();
                    $bicycle = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                    return $bicycle;

                }catch(PDOException $e){
                    // echo $e -> getMessage();
                    return false;
                }
            }

            // public function hash_password($password){
            //     //This is for password
            //                 $hashed = password_hash($pass, PASSWORD_DEFAULT);
            //     //End
            //                 $query = "INSERT INTO admin WHERE admin_username=?";
            //                 $stmt = $this -> dbcon -> prepare($query);
            //                 $stmt -> execute([$pass]);
            //                 $id = $this -> dbcon -> lastInsertId();
            //                 return $id;
            //             }

            public function login($username, $password){
                try{
                    $sql = "SELECT * FROM admin WHERE admin_username=?"; 
                    $stmt = $this -> dbcon -> prepare($sql);
                    $stmt -> execute([$username]);
                    $data = $stmt -> fetch(PDO::FETCH_ASSOC);
                    if($data){
                        $stored_hash = $data["admin_password"];
                        $check = password_verify($password, $stored_hash);
                        if($check){
                            return $data["admin_id"];
                        }else{
                            $_SESSION["adminerror"]= "Invalid Password";
                            return false;
                        }
                    }else{
                        $_SESSION["adminerror"]= "Invalid Email";
                        return false;
                    }
                }catch(Exceptio $e){
                    echo $e -> getMessage();
                    return false;
                }
            }   
            
            public function delete_user($id){
                try{
                    $sql = "DELETE FROM members WHERE member_id=?";
                    $stmt = $this -> dbcon -> prepare($sql);
                    $stmt -> execute([$id]);
                    $delete = $stmt -> execute ([$id]);
                    return $delete;
                }catch(PDOException $e){
                    echo $e -> getMessage();
                    return false;
                }
            }



            public function logout(){
                try{
                    unset($_SESSION["adminonline"]);
                    session_destroy();
                }catch(PDOException $e){
                    echo $e -> getMessage();
                    return false;
                }
            }

            public function count_members(){
                try{
                    $sql = "SELECT COUNT(*) AS total_members FROM members";
                    $stmt = $this -> dbcon -> prepare($sql);
                    $stmt -> execute();
                    $response = $stmt -> fetch(PDO::FETCH_ASSOC);
                    return $response;
                }catch(PDOException $e){
                    echo $e -> getMessage();
                    return false;
                }
            }

            public function count_rides(){
                try{
                    $sql = "SELECT COUNT(*) AS total_rides FROM rental";
                    $stmt = $this -> dbcon -> prepare($sql);
                    $stmt -> execute();
                    $response = $stmt -> fetch(PDO::FETCH_ASSOC);
                    return $response;
                }catch(PDOException $e){
                    echo $e -> getMessage();
                    return false;
                }
            }

    }
// $admin = new Admin();
// print_r( $admin -> count_members());
?>