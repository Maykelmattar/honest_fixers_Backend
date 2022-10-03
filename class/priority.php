<?php
    class priority{

        // Connection
        private $conn;

        // Table
        private $db_table = "priority";

        // Columns
        public $id;
        public $name;
        public $status;
        public $creator;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getpriority($flag){
            if($flag!="dropdown"){
            $sqlQuery = "SELECT priority_id as id, priority_name as name,  priority_status as status FROM " . $this->db_table . "";
            }else{
                $sqlQuery = "SELECT priority_id as id, priority_name as name,  priority_status as status FROM " . $this->db_table . " WHERE priority_status='1' ";

            }
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createpriority(){
            $this->name=htmlspecialchars(strip_tags($this->name));

            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        priority_id = :id,
                        priority_name ='".$this->name."', 
                        priority_status = '1' ,
                        priority_Ustmp = :creator";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->id));
            $this->creator=htmlspecialchars(strip_tags($this->creator));

            // bind data
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":creator", $this->creator);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSinglepriority(){
            $sqlQuery = "SELECT
                        priority_id as id, 
                        priority_name as name, 
                        priority_status as status
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    priority_Id = '". $this->id ."'  
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);


            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->name = $dataRow['name'];
            $this->status = $dataRow['status'];
        }        

        // UPDATE
        public function updatepriority(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    priority_name = :name
                    WHERE 
                    priority_Id = ".$this->id;
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->name=htmlspecialchars(strip_tags($this->name));
        
            // bind data
            $stmt->bindParam(":name", $this->name);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deletepriority(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE  " . $this->db_table . " set priority_status = IF(priority_status='1', '0', '1') WHERE priority_id = '". $this->id ."'";
            $stmt = $this->conn->prepare($sqlQuery);
                
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>