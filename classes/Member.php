<?php

require_once "Db.php";

    class Member extends Db{
        private $connection;

            public function __construct(){
                $this -> dbcon = $this -> connect();
            }
         
            public function register_new_user($firstname, $lastname, $email, $number, $password){

                try{
                    $hashed = password_hash($password, PASSWORD_DEFAULT);
                    $sql = " INSERT INTO members SET first_name=?,last_name=?,email=?,phone_number=?,password=?";
                    $stmt = $this-> dbcon ->prepare($sql);
                    $stmt -> execute([$firstname, $lastname, $email, $number, $hashed]);
                    $data = $this -> dbcon -> lastInsertId();
                    $_SESSION["member_id"] = $data;
                    return $data;
                
                }catch(PDOException $e){
                    // echo $e -> getMessage();
                    return false;
                }
            }

            public function upload_document($document_path){
                try{
                    $member_id = $_SESSION["member_id"];
                    $sql = "UPDATE members SET verification_document=? WHERE member_id=?";
                    $stmt = $this -> dbcon -> prepare($sql);
                    $stmt -> execute([$document_path,$member_id]);
                    return true;
                }catch(PDOException $e){
                    // echo $e -> getMessage();
                    return false;
                }
            }

            public function membership_plan($membership_plan){
                try{
                    $member_id = $_SESSION["member_id"];
                    $sql = "UPDATE members SET membership_type=? WHERE member_id=?";
                    $stmt = $this -> dbcon -> prepare($sql);
                    $stmt -> execute([$membership_plan, $member_id]);
                    return true;
                }catch(PDOException $e){
                    // echo $e -> getMessage();
                    return false;
                }
            }

            public function avatar($avatar){
                try{
                    $member_id = $_SESSION["member_id"];
                    $sql = "UPDATE members SET member_avatar=? WHERE member_id=?";
                    $stmt = $this -> dbcon -> prepare($sql);
                    $stmt -> execute([$avatar,$member_id]);
                    return true;
                }catch(PDOException $e){
                    // echo $e -> getMessage();
                    return false;
                }
            }

            public function login_user($email,$password){
                try{
                    $sql = "SELECT * FROM members WHERE email=?";
                    $stmt = $this -> dbcon -> prepare($sql);
                    $stmt -> execute([$email]);
                    $data = $stmt -> fetch(PDO::FETCH_ASSOC);
                    if($data){
                        $stored_hash = $data["password"];
                        $check = password_verify($password, $stored_hash);
                        if($check){
                            session_start();
                            $_SESSION["member_id"]= $data["member_id"];
                            return true;
                        }else{
                            $_SESSION["errormsg"]= "Invalid Password";
                            return false;
                        }
                    }else{
                        $_SESSION["errormsg"]= "Invalid Email";
                        return false;
                    }
                }catch(PDOException $e){
                    // echo $e -> getMessage();    
                    return false;
                }
            }

            public function email_exist( $email ){
                $sql = "SELECT * FROM members WHERE email=?";
                $stmt = $this -> dbcon -> prepare($sql);
                $stmt -> execute([$email]);
                $data = $stmt -> fetch();
                if ($data){
                    return true;
                }else{
                    return false;
                }
            }

            public function get_member($id){
                try{
                    $member_id = $_SESSION["member_id"];
                    $sql = "SELECT * FROM members WHERE member_id=?";
                    $stmt = $this-> dbcon -> prepare($sql);
                    $stmt -> execute([$member_id]);
                    $id = $stmt -> fetch(PDO::FETCH_ASSOC);
                    return $id;
                }catch(Excetion $e){
                    // echo $e -> getMessage();
                    return false;
                }
            }

            // public function get_table_member(){
            //     try{
            //         $sql = "SELECT * FROM members  ";
            //         $stmt = $this -> dbcon -> prepare($sql);
            //         $stmt -> execute();
            //         $fetch = $stmt -> fetchAll(PDO::FETCH_ASSOC);
            //         return $fetch;
            //     }catch(PDOException $e){
            //         echo $e -> getMessage();
            //         return false;
            //     }
            // }

            public function logout(){
                    session_unset();
                    session_destroy();
            }

            public function mark_as_paid($member_id) {
                $sql = "UPDATE members SET has_paid = 1 WHERE member_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$member_id]);
                return true;
            }

            public function edit_member($fname,$lname,$phone,$type,$id){
                try{
                        $sql = "UPDATE members SET first_name=?, last_name=?, phone_number=?, membership_type=? WHERE member_id=?";
                        $stmt = $this -> dbcon -> prepare($sql);
                        $response = $stmt -> execute([$fname,$lname,$phone,$type,$id]);
                        return $response;
                }catch(PDOException $e){
                    echo $e -> getMessage();
                    return false;
                }
            }
            
}
    

?>
 