<?php
    class users{

        // Connection
        private $conn;

        // Table
        private $db_table = "users";

        // Columns
        public $username;
        public $firstName;
        public $lastName;
        public $password;
        public $role;
        public $status;
        public $creator;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getUsers($flag){
            if($flag!="dropdown"){
            $sqlQuery = "SELECT Users_username as username, Users_firstName as firstName, Users_lastName as lastName, Users_type as role, Users_status as status FROM " . $this->db_table . "";
              }
                else{
                $sqlQuery = "SELECT Users_username as username, Users_firstName as firstName, Users_lastName as lastName, Users_type as role, Users_status as status FROM " . $this->db_table . "  Where Users_type = '2' And Users_status='1' ";
            }
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createUsers(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        Users_username = :username,
                        Users_firstName = :firstName, 
                        Users_lastName = :lastName, 
                        Users_password = :password, 
                        Users_type = :role, 
                        Users_status = '1' ,
                        Users_Cstmp = :creator";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->firstName=htmlspecialchars(strip_tags($this->firstName));
            $this->lastName=htmlspecialchars(strip_tags($this->lastName));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->role=htmlspecialchars(strip_tags($this->role));
            $this->creator=htmlspecialchars(strip_tags($this->creator));

            // bind data
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":firstName", $this->firstName);
            $stmt->bindParam(":lastName", $this->lastName);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":role", $this->role);
            $stmt->bindParam(":creator", $this->creator);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingleUsers(){
            $sqlQuery = "SELECT
                        Users_username as username, 
                        Users_firstName as firstName, 
                        Users_lastName as lastName, 
                        Users_type as role, 
                        Users_status as status
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    Users_username = '". $this->username ."'
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);


            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->firstName = $dataRow['firstName'];
            $this->lastName = $dataRow['lastName'];
            $this->role = $dataRow['role'];
            $this->status = $dataRow['status'];
        }        
        public function checkUsers(){
            $sqlQuery = "SELECT
         *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    Users_username = '". $this->username ."'
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);

if($stmt->execute()){
    return true;
}else{
    return false;
}

        }      
        // UPDATE
        public function updateUsers(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    Users_firstName = :firstName, 
                    Users_lastName = :lastName, ";
                    if ($this->password <> "" ){
                        $sqlQuery.="Users_password = :password, ";
                    }
                    $sqlQuery.= " Users_type = :role 
                    WHERE 
                    Users_username = :username";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->firstName=htmlspecialchars(strip_tags($this->firstName));
            $this->lastName=htmlspecialchars(strip_tags($this->lastName));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->role=htmlspecialchars(strip_tags($this->role));
            $this->username=htmlspecialchars(strip_tags($this->username));
        
            // bind data
            $stmt->bindParam(":firstName", $this->firstName);
            $stmt->bindParam(":lastName", $this->lastName);
            if ($this->password <> "" ){
            $stmt->bindParam(":password", $this->password);
            }
            $stmt->bindParam(":role", $this->role);
            $stmt->bindParam(":username", $this->username);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteUsers(){
            $this->username=htmlspecialchars(strip_tags($this->username));

            $sqlQuery = "UPDATE  " . $this->db_table . " set Users_status = IF(Users_status='1', '0', '1') WHERE Users_username = '". $this->username ."'";
            $stmt = $this->conn->prepare($sqlQuery);
                
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>