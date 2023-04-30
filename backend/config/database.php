<?php 
    class Database {
        private $host = "89.117.56.9";
        private $database_name = "projekt";
        private $username = "projektbaza";
        private $password = "ViJbqNT0cFFHAkSoN8tm";
        public $conn;
        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>