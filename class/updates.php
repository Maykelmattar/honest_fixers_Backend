<?php
    class updates{

        // Connection
        private $conn;

        // Table
        private $db_table = "updates";

        // Columns
        public $id;
        public $wo;
        public $dispatcher;
        public $description;
        public $status;
        public $creator;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getupdates(){
            $sqlQuery = "SELECT updates_id as id, updates_wo as wo, updates_description as description,  updates_status as status,  updates_Cstmp  as creator  FROM " . $this->db_table . " WHERE updates_wo = :wo ;";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":wo", $this->wo);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createupdates(){
            $this->description=htmlspecialchars(strip_tags($this->description));

            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        updates_wo = :wo, 
                        updates_description ='".$this->description."', 
                        updates_status = '1' ,
                        updates_Cstmp = :creator";
        
            $stmt = $this->conn->prepare($sqlQuery);

            // sanitize
            $this->creator=htmlspecialchars(strip_tags($this->creator));

            // bind data
            $stmt->bindParam(":wo", $this->wo);
            $stmt->bindParam(":creator", $this->creator);

            if($stmt->execute()){
                $sqlQuery = "INSERT INTO
               updateschecked
            SET
            updatesChecked_wo = :wo, 
            updatesChecked_disp = :dispatcher ";;

    $stmt = $this->conn->prepare($sqlQuery);

    // sanitize
    $this->creator=htmlspecialchars(strip_tags($this->creator));

    // bind data
                $stmt->bindParam(":wo", $this->wo);
                $stmt->bindParam(":dispatcher", $this->dispatcher);
                if($stmt->execute()){
               return true;
                }else{
                    return false;
                }
            }
            return false;
        }

        // READ single
        public function getSingleupdates(){
            $sqlQuery = "SELECT
                        updates_id as id, 
                        updates_wo as wo,
                        updates_description as description, 
                        updates_status as status,
                        updates_Cstmp  as creator 
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    updates_Id = '". $this->id ."'  
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);


            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->description = $dataRow['description'];
            $this->status = $dataRow['status'];
        }        

        // UPDATE
        public function updateupdates(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    updates_description = :description
                    WHERE 
                    updates_Id = ".$this->id;
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->description=htmlspecialchars(strip_tags($this->description));
        
            // bind data
            $stmt->bindParam(":description", $this->description);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function clearupdates(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "Delete  from updateschecked WHERE updatesChecked_wo = :wo AND updatesChecked_disp = :dispatcher ;";
            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":wo", $this->wo);
            $stmt->bindParam(":dispatcher", $this->creator);

                
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>