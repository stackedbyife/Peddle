<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "Db.php";

    class Payment extends Db{
        private $dbcon;

        public function __construct() {
            $this->dbcon = $this->connect();
        }

        public function fetch_membership($plan_id){
            try{
                    $sql = "SELECT * FROM membership_plan WHERE membership_plan_id=?";
                    $stmt = $this -> dbcon -> prepare($sql);
                    $stmt -> execute([$plan_id]);
                    $response = $stmt -> fetch(PDO::FETCH_ASSOC);
                    return $response;
            }catch(PDOException $e){
                echo $e -> getMessage();
                return false;
            }
        }

       
    public function update_payment_status($transactionReference, $amountPaid, $status,$subscription_id) {
            try{
                $id = $_SESSION["member_id"];
                $pay_method = "Paystack";
                $sql = "INSERT INTO payment (transaction_reference, member_id, amount_paid, payment_status,transaction_date,payment_method,subscription_id) VALUES (?, ?, ?, ?, NOW(),?,?)";
                $stmt = $this->dbcon->prepare($sql);
                $response= $stmt-> execute([$transactionReference, $id, $amountPaid, $status,$pay_method,$subscription_id]);
                return $response;
        }catch(PDOException $e){
            echo $e -> getMessage();
            return false;
        }
    }

    public function start_subscription($member_id, $type_id){
            try{
                $sql = "INSERT INTO subscription SET member_id=?, membership_type_id=?";
                $stmt = $this -> dbcon -> prepare($sql);
                $response = $stmt -> execute([$member_id, $type_id]);
                $sub_id = $this -> dbcon -> lastInsertId();
                $_SESSION["sub_id"] = $sub_id;
                return $response;
        }catch(PDOException $e){
            echo $e -> getMessage();
            return false;
        }
    }

    public function fetch_subscription(){
            try{
                    $sub_id = $_SESSION["sub_id"];
                    $sql = "SELECT * FROM subscription WHERE subscription_id=$sub_id";
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
    // $payment = new Payment();
    // print_r($payment -> fetch_subscription());
    // echo $payment->start_subscription(2,2) ;

?>

