<?php
    class types{

        // Connection
        private $conn;

        // Table
        private $db_table = "types";

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
        public function gettypes($flag){
            if($flag!="dropdown"){
            $sqlQuery = "SELECT types_id as id, types_name as name,  types_status as status FROM " . $this->db_table . "";
            }
            else{
                $sqlQuery = "SELECT types_id as id, types_name as name,  types_status as status FROM " . $this->db_table . " WHERE types_status ='1' ";
            }
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createtypes(){
            $this->name=htmlspecialchars(strip_tags($this->name));

            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        types_name ='".$this->name."', 
                        types_status = '1' ,
                        types_Ustmp = :creator";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize
            $this->creator=htmlspecialchars(strip_tags($this->creator));

            // bind data
            $stmt->bindParam(":creator", $this->creator);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSingletypes(){
            $sqlQuery = "SELECT
                        types_id as id, 
                        types_name as name, 
                        types_status as status
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    types_Id = '". $this->id ."'  
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);


            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->name = $dataRow['name'];
            $this->status = $dataRow['status'];
        }        

        // UPDATE
        public function updatetypes(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    types_name = :name
                    WHERE 
                    types_Id = ".$this->id;
        
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
        function deletetypes(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE  " . $this->db_table . " set types_status = IF(types_status='1', '0', '1') WHERE types_id = '". $this->id ."'";
            $stmt = $this->conn->prepare($sqlQuery);
                
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>