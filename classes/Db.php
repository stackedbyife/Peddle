<?php
require_once "config.php";
    class Db{
        private $connection;
        private $dbname = DB_NAME;
        private $dbhost = DB_HOST;
        private $dbuser = DB_USER;
        private $dbpass = DB_PASS;

            public function connect(){

                $dsn = "mysql:dbhost=$this->dbhost;dbname=$this->dbname";
                $settings =[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
                try{
                    $this -> connection = new PDO($dsn, $this -> dbuser, $this -> dbpass, $settings);
                    return $this -> connection;
                }catch(PDOException $e){
                    // echo $e -> getMessage();
                    return false;
                }
            }
    }

    // $db1 = new Db;
    // $conn = $db1->connect();
    // var_dump($conn);
?>