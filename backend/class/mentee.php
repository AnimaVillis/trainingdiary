<?php
    class Mentee{

        private $conn;

        private $db_table = "users";

        public $id;
        public $name;
        public $email;
        public $password;
        public $user_level;
        public $first_login;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getMentees(){
            $sqlQuery = "SELECT id, name, email, password, user_level, first_login FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createMentee(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        password = :password, 
                        user_level = :user_level, 
                        first_login = :first_login,
                        account_activation = :account_activation";
        
            $stmt = $this->conn->prepare($sqlQuery);
        

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=password_hash(htmlspecialchars(strip_tags($this->password)), PASSWORD_DEFAULT);
            $this->user_level=0;
            $this->first_login=0;
            $this->account_activation=0;
        

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":user_level", $this->user_level);
            $stmt->bindParam(":first_login", $this->first_login);
            $stmt->bindParam(":account_activation", $this->account_activation);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function firstloginMentee(){
            $sqlQuery = "INSERT INTO
                        users_info
                    SET
                        users_id = :users_id, 
                        initial_weight = :initial_weight, 
                        current_weight = :current_weight, 
                        target_weight = :target_weight, 
                        growth = :growth,
                        age = :age,
                        activity_factor = :activity_factor,
                        sex = :sex";
        
            $stmt = $this->conn->prepare($sqlQuery);
        

            $this->users_id=$this->users_id;
            $this->initial_weight=$this->initial_weight;
            $this->current_weight=$this->current_weight;
            $this->target_weight=$this->target_weight;
            $this->growth=$this->growth;
            $this->age=$this->age;
            $this->activity_factor=$this->activity_factor;
            $this->sex=$this->sex;
        

            $stmt->bindParam(":users_id", $this->users_id);
            $stmt->bindParam(":initial_weight", $this->initial_weight);
            $stmt->bindParam(":current_weight", $this->current_weight);
            $stmt->bindParam(":target_weight", $this->target_weight);
            $stmt->bindParam(":growth", $this->growth);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":activity_factor", $this->activity_factor);
            $stmt->bindParam(":sex", $this->sex);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleMentee(){
            $sqlQuery = "SELECT id, name, email, user_level, first_login FROM ". $this->db_table ." WHERE id = ? LIMIT 1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $dataRow['id'];
            $this->name = $dataRow['name'];
            $this->email = $dataRow['email'];
            $this->user_level = $dataRow['user_level'];
            $this->first_login = $dataRow['first_login'];
        }        

        public function recoveryMentee(){
            $sqlQuery = "SELECT name, email FROM ". $this->db_table ." WHERE name = :name AND email = :email LIMIT 1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->execute();
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            

            if($dataRow['name'] == $this->name AND $dataRow['email'] == $this->email) {
                if($stmt->execute()){
                    return true;
                } else {
                    return false;
                }
            }
        }

        function deleteMentee(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>