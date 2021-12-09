<?php
    class clients{

        // Connection
        private $conn;

        // Table
        private $db_table = "clients";

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
        public function getclients($flag){
            if($flag!="dropdown"){
            $sqlQuery = "SELECT clients_id as id, clients_name as name,  clients_status as status FROM " . $this->db_table . "";
            }else{
                $sqlQuery = "SELECT clients_id as id, clients_name as name,  clients_status as status FROM " . $this->db_table . " WHERE clients_status = '1' ";

            }
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createclients(){
            $this->name=htmlspecialchars(strip_tags($this->name));

            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        clients_id = :id,
                        clients_name ='".$this->name."', 
                        clients_status = '1' ,
                        clients_Ustmp = :creator";
        
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
        public function getSingleclients(){
            $sqlQuery = "SELECT
                        clients_id as id, 
                        clients_name as name, 
                        clients_status as status
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    clients_Id = '". $this->id ."'  
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);


            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->name = $dataRow['name'];
            $this->status = $dataRow['status'];
        }        

        // UPDATE
        public function updateclients(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    clients_name = :name
                    WHERE 
                    clients_Id = ".$this->id;
        
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
        function deleteclients(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE  " . $this->db_table . " set clients_status = IF(clients_status='1', '0', '1') WHERE clients_id = '". $this->id ."'";
            $stmt = $this->conn->prepare($sqlQuery);
                
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>