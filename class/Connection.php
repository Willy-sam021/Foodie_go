<?php
    require_once "Config.php";
    class Connection{
        private $conn;
        private $dbname=DB_NAME;
        private $dbuser=DB_USER;
        private $dbpass=DB_PASS;
        private $dbhost=DB_HOST;

        public function connect(){
            try{
                $dsl="mysql:host=$this->dbhost;dbname=$this->dbname";
                $option=[PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION];
                $this->conn= new PDO($dsl,$this->dbuser,$this->dbpass,$option);
                return $this->conn;
            }catch(PDOException $e){
                echo $e->getMessage();
                echo $e->getLine();

            }
        }

    }

    // $rat= new Connection;
    // $line= $rat->connect();
    // echo '<pre>';
    // print_r($line);
    // echo '</pre>';

?>