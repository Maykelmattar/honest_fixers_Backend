<?php
    class status{

        // Connection
        private $conn;

        // Table
        private $db_table = "status";

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
        public function getstatus($flag){
            if($flag!="dropdown"){
            $sqlQuery = "SELECT status_id as id, status_name as name,  status_status as status FROM " . $this->db_table . "";
            }else{
                $sqlQuery = "SELECT status_id as id, status_name as name,  status_status as status FROM " . $this->db_table . " where status_status = '1' ";

            }
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createstatus(){
            $this->name=htmlspecialchars(strip_tags($this->name));

            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        status_id = :id,
                        status_name ='".$this->name."', 
                        status_status = '1' ,
                        status_Ustmp = :creator";
        
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
        public function getSinglestatus(){
            $sqlQuery = "SELECT
                        status_id as id, 
                        status_name as name, 
                        status_status as status
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    status_Id = '". $this->id ."'  
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);


            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->name = $dataRow['name'];
            $this->status = $dataRow['status'];
        }        

        // UPDATE
        public function updatestatus(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    status_name = :name
                    WHERE 
                    status_Id = ".$this->id;
        
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
        function deletestatus(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE  " . $this->db_table . " set status_status = IF(status_status='1', '0', '1') WHERE status_id = '". $this->id ."'";
            $stmt = $this->conn->prepare($sqlQuery);
                
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>