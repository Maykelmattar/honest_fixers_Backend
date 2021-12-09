<?php
    class wo{

        // Connection
        private $conn;

        // Table
        private $db_table = "workorder";

        // Columns
        public $username;  	

            public $id;  	
         	public $dispatcher;	
         	public $number;
         	public  $type;
         	public  $status;
         	public  $priority;	
         	public  $store;
         	public  $storeManager;		
         	public  $storeManagerNo;		
         	public  $receivedIn;
         	public  $client;
         	public  $clientContact;		
         	public  $clientContactNo; 		
         	public  $facility;
         	public  $facilityContact;	
         	public  $facilityContactNo;	
         	public  $state;
         	public  $city;
         	public  $zip;
         	public  $location;
         	public  $ETA;			
         	public  $description;
         	public  $clientNTE;
         	public  $techVen;
         	public  $assessment;
         	public  $checkIn;
         	public  $checkOut;
         	public  $repairIn;	
         	public  $repairOut;	
         	public  $assessmentTime;
         	public  $assessmentTimeCost;	
         	public  $assessmentTimeCharge;
         	public  $parts;
         	public  $partsCost 	;
         	public  $partsCharge 	;
         	public  $material 	;	
         	public  $materialCost ;	
         	public  $materialCharge ;	
         	public  $equiment 		;
         	public  $equimentCost 	;
         	public  $equimentCharge 	;
         	public  $laborTime 		;
         	public  $laborTimeCost 	;	
         	public  $laborTimeCharge ;
         	public  $trip 	 		;
         	public  $tripCost 		;	
         	public  $tripCharge 	;
         	public  $Permit 	;
         	public  $PermitCost; 		
         	public  $PermitCharge; 	
         	public  $labTest ;
         	public  $labTestCost ;	
         	public  $labTestCharge 	;	
         	public  $proposal 		;	
         	public  $link 			;
         	public  $notes 		;
         	public  $actualCost 	;
         	public  $totalNTE 	;		
         	public  $paymentMethod ;			
         	public  $CDate 		;	
         	public  $UDate 		;
         	public  $DoneDate 	;	
         	public  $Cstmp 		;
         	public  $Ustmp 		;
         	public  $DoneStmp ;
        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getwo(){
            $sqlQuery = "SELECT *, COUNT(updatesChecked_wo) as updatesCount from workorder Left join updateschecked on Wo_Id=updatesChecked_wo and updatesChecked_disp = :username Group by Wo_Id;";
            
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(":username",$this->username);

            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function createwo(){  
            // sanitize
           $this->dispatcher=htmlspecialchars(strip_tags($this->dispatcher));	
           $this->number=htmlspecialchars(strip_tags($this->number));
           $this->type=htmlspecialchars(strip_tags($this->type));
           $this->status=htmlspecialchars(strip_tags($this->status));
           $this->priority=htmlspecialchars(strip_tags($this->priority));	
           $this->store=htmlspecialchars(strip_tags($this->store));
           $this->storeManager=htmlspecialchars(strip_tags($this->storeManager));		
           $this->storeManagerNo=htmlspecialchars(strip_tags($this->storeManagerNo));		
           $this->receivedIn=htmlspecialchars(strip_tags($this->receivedIn));
           $this->client=htmlspecialchars(strip_tags($this->client));
           $this->clientContact=htmlspecialchars(strip_tags($this->clientContact));		
           $this->clientContactNo=htmlspecialchars(strip_tags($this->clientContactNo));	
           $this->facility=htmlspecialchars(strip_tags($this->facility));
           $this->facilityContact=htmlspecialchars(strip_tags($this->facilityContact));	
           $this->facilityContactNo=htmlspecialchars(strip_tags($this->facilityContactNo));	
           $this->state=htmlspecialchars(strip_tags($this->state));
           $this->city=htmlspecialchars(strip_tags($this->city));
           $this->zip=htmlspecialchars(strip_tags($this->zip));
           $this->location=htmlspecialchars(strip_tags($this->location));
           $this->ETA=htmlspecialchars(strip_tags($this->ETA));			
           $this->description=htmlspecialchars(strip_tags($this->description));
           $this->clientNTE=htmlspecialchars(strip_tags($this->clientNTE));
           $this->techVen=htmlspecialchars(strip_tags($this->techVen));
           $this->assessment=htmlspecialchars(strip_tags($this->assessment));
           $this->checkIn=htmlspecialchars(strip_tags($this->checkIn));
           $this->checkOut=htmlspecialchars(strip_tags($this->checkOut));
           $this->repairIn=htmlspecialchars(strip_tags($this->repairIn));	
           $this->repairOut=htmlspecialchars(strip_tags($this->repairOut));	
           $this->assessmentTime=htmlspecialchars(strip_tags($this->assessmentTime));
           $this->assessmentTimeCost=htmlspecialchars(strip_tags($this->assessmentTimeCost));	
           $this->assessmentTimeCharge=htmlspecialchars(strip_tags($this->assessmentTimeCharge));
           $this->parts=htmlspecialchars(strip_tags($this->parts));
           $this->partsCost=htmlspecialchars(strip_tags($this->partsCost));
           $this->partsCharge=htmlspecialchars(strip_tags($this->partsCharge));
           $this->material=htmlspecialchars(strip_tags($this->material));
           $this->materialCost=htmlspecialchars(strip_tags($this->materialCost));	
           $this->materialCharge=htmlspecialchars(strip_tags($this->materialCharge));	
           $this->equiment=htmlspecialchars(strip_tags($this->equiment));
           $this->equimentCost=htmlspecialchars(strip_tags($this->equimentCost));
           $this->equimentCharge=htmlspecialchars(strip_tags($this->equimentCharge));
           $this->laborTime=htmlspecialchars(strip_tags($this->laborTime));
           $this->laborTimeCost=htmlspecialchars(strip_tags($this->laborTimeCost));	
           $this->laborTimeCharge=htmlspecialchars(strip_tags($this->laborTimeCharge));
           $this->trip=htmlspecialchars(strip_tags($this->trip));
           $this->tripCost=htmlspecialchars(strip_tags($this->tripCost));
           $this->tripCharge=htmlspecialchars(strip_tags($this->tripCharge));
           $this->Permit=htmlspecialchars(strip_tags($this->Permit));
           $this->PermitCost=htmlspecialchars(strip_tags($this->PermitCost)); 		
           $this->PermitCharge=htmlspecialchars(strip_tags($this->PermitCharge)); 	
           $this->labTest=htmlspecialchars(strip_tags($this->labTest));
           $this->labTestCost=htmlspecialchars(strip_tags($this->labTestCost));	
           $this->labTestCharge=htmlspecialchars(strip_tags($this->labTestCharge));	
           $this->proposal=htmlspecialchars(strip_tags($this->proposal));	
           $this->link=htmlspecialchars(strip_tags($this->link));
           $this->notes=htmlspecialchars(strip_tags($this->notes));
           $this->actualCost=htmlspecialchars(strip_tags($this->actualCost));
           $this->totalNTE=htmlspecialchars(strip_tags($this->totalNTE));		
           $this->paymentMethod=htmlspecialchars(strip_tags($this->paymentMethod));			
           $this->Cstmp=htmlspecialchars(strip_tags($this->Cstmp));
           $this->Ustmp=htmlspecialchars(strip_tags($this->Ustmp));
           $this->DoneStmp=htmlspecialchars(strip_tags($this->DoneStmp));
            

           $sqlQuery = " INSERT INTO
           ". $this->db_table ."
        SET	

Wo_dispatcher = :dispatcher ,	
Wo_number = CASE WHEN :number !='' then :number else CASE WHEN (select max(t1.Wo_number) from workorder as t1) then (select max(t2.Wo_number)+1 from workorder as t2) else 1 END END  ,
Wo_type = :type ,
Wo_status = :status ,
Wo_priority = :priority ,
Wo_store = :store ,
Wo_storeManager = :storeManager ,
Wo_storeManagerNo = :storeManagerNo ,
Wo_receivedIn = CASE WHEN :receivedIn !='' then :receivedIn else NULL END,
Wo_client = :client ,
Wo_clientContact = :clientContact ,
Wo_clientContactNo 	= :clientContactNo ,
Wo_facility = :facility ,
Wo_facilityContact = :facilityContact ,
Wo_facilityContactNo = :facilityContactNo ,
Wo_state = :state ,
Wo_city = :city ,
Wo_zip = :zip ,
Wo_location = :location ,
Wo_ETA = CASE WHEN :ETA !='' then :ETA else NULL END  ,
Wo_description = :description ,
Wo_clientNTE = :clientNTE ,
Wo_techVen = :techVen ,
Wo_assessment = :assessment ,
Wo_checkIn = CASE WHEN :checkIn !='' then :checkIn else NULL END   ,
Wo_checkOut = CASE WHEN :checkOut !='' then :checkOut else NULL END  ,
Wo_repairIn = CASE WHEN :repairIn !='' then :repairIn else NULL END ,
Wo_repairOut = CASE WHEN :repairOut !='' then :repairOut else NULL END  ,
Wo_assessmentTime = :assessmentTime ,
Wo_assessmentTimeCost = :assessmentTimeCost ,
Wo_assessmentTimeCharge = :assessmentTimeCharge ,
Wo_parts = :parts ,
Wo_partsCost = :partsCost ,
Wo_partsCharge = :partsCharge ,
Wo_material = :material ,
Wo_materialCost = :materialCost ,
Wo_materialCharge = :materialCharge ,
Wo_equiment = :equiment ,
Wo_equimentCost = :equimentCost ,
Wo_equimentCharge = :equimentCharge ,
Wo_laborTime = :laborTime ,
Wo_laborTimeCost = :laborTimeCost ,
Wo_laborTimeCharge = :laborTimeCharge ,
Wo_trip = :trip ,
Wo_tripCost = :tripCost ,
Wo_tripCharge = :tripCharge ,
Wo_Permit = :Permit ,
Wo_PermitCost = :PermitCost ,
Wo_PermitCharge = :PermitCharge ,
Wo_labTest = :labTest ,	
Wo_labTestCost = :labTestCost ,
Wo_labTestCharge = :labTestCharge ,
Wo_proposal = :proposal ,
Wo_link = :link ,
Wo_notes = :notes ,
Wo_actualCost = :actualCost ,
Wo_totalNTE = :totalNTE ,
Wo_paymentMethod = :paymentMethod ,
Wo_CDate = CURRENT_TIMESTAMP ,
Wo_UDate = CURRENT_TIMESTAMP ,
Wo_DoneDate =  CASE WHEN :DoneStmp !='' then CURRENT_TIMESTAMP else NULL END,
Wo_Cstmp = :Cstmp ,
Wo_Ustmp = :Ustmp ,
Wo_DoneStmp = :DoneStmp ;";

$stmt = $this->conn->prepare($sqlQuery);
            // bind data
            $stmt->bindParam(":dispatcher",$this->dispatcher);	
            $stmt->bindParam(":number",$this->number);
            $stmt->bindParam(":type",$this->type);
            $stmt->bindParam(":status",$this->status);
            $stmt->bindParam(":priority",$this->priority);	
            $stmt->bindParam(":store",$this->store);
            $stmt->bindParam(":storeManager",$this->storeManager);		
            $stmt->bindParam(":storeManagerNo",$this->storeManagerNo);		
            $stmt->bindParam(":receivedIn",$this->receivedIn);
            $stmt->bindParam(":client",$this->client);
            $stmt->bindParam(":clientContact",$this->clientContact);		
            $stmt->bindParam(":clientContactNo",$this->clientContactNo);	
            $stmt->bindParam(":facility",$this->facility);
            $stmt->bindParam(":facilityContact",$this->facilityContact);	
            $stmt->bindParam(":facilityContactNo",$this->facilityContactNo);	
            $stmt->bindParam(":state",$this->state);
            $stmt->bindParam(":city",$this->city);
            $stmt->bindParam(":zip",$this->zip);
            $stmt->bindParam(":location",$this->location);
            $stmt->bindParam(":ETA",$this->ETA);			
            $stmt->bindParam(":description",$this->description);
            $stmt->bindParam(":clientNTE",$this->clientNTE);
            $stmt->bindParam(":techVen",$this->techVen);
            $stmt->bindParam(":assessment",$this->assessment);
            $stmt->bindParam(":checkIn",$this->checkIn);
            $stmt->bindParam(":checkOut",$this->checkOut);
            $stmt->bindParam(":repairIn",$this->repairIn);	
            $stmt->bindParam(":repairOut",$this->repairOut);	
            $stmt->bindParam(":assessmentTime",$this->assessmentTime);
            $stmt->bindParam(":assessmentTimeCost",$this->assessmentTimeCost);	
            $stmt->bindParam(":assessmentTimeCharge",$this->assessmentTimeCharge);
            $stmt->bindParam(":parts",$this->parts);
            $stmt->bindParam(":partsCost",$this->partsCost);
            $stmt->bindParam(":partsCharge",$this->partsCharge);
            $stmt->bindParam(":material",$this->material);
            $stmt->bindParam(":materialCost",$this->materialCost);	
            $stmt->bindParam(":materialCharge",$this->materialCharge);	
            $stmt->bindParam(":equiment",$this->equiment);
            $stmt->bindParam(":equimentCost",$this->equimentCost);
            $stmt->bindParam(":equimentCharge",$this->equimentCharge);
            $stmt->bindParam(":laborTime",$this->laborTime);
            $stmt->bindParam(":laborTimeCost",$this->laborTimeCost);	
            $stmt->bindParam(":laborTimeCharge",$this->laborTimeCharge);
            $stmt->bindParam(":trip",$this->trip);
            $stmt->bindParam(":tripCost",$this->tripCost);
            $stmt->bindParam(":tripCharge",$this->tripCharge);
            $stmt->bindParam(":Permit",$this->Permit);
            $stmt->bindParam(":PermitCost",$this->PermitCost); 		
            $stmt->bindParam(":PermitCharge",$this->PermitCharge); 	
            $stmt->bindParam(":labTest",$this->labTest);
            $stmt->bindParam(":labTestCost",$this->labTestCost);	
            $stmt->bindParam(":labTestCharge",$this->labTestCharge);	
            $stmt->bindParam(":proposal",$this->proposal);	
            $stmt->bindParam(":link",$this->link);
            $stmt->bindParam(":notes",$this->notes);
            $stmt->bindParam(":actualCost",$this->actualCost);
            $stmt->bindParam(":totalNTE",$this->totalNTE);		
            $stmt->bindParam(":paymentMethod",$this->paymentMethod);			
            $stmt->bindParam(":Cstmp",$this->Cstmp);
            $stmt->bindParam(":Ustmp",$this->Ustmp);
            $stmt->bindParam(":DoneStmp",$this->DoneStmp);

            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function getSinglewo(){
            $sqlQuery = "SELECT
                     *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    wo_Id = '". $this->id ."'  
                    LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);


            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $dataRow['name'];
            $this->status = $dataRow['status'];
        }   
        
        public function checkWoAvailability(){
            $sqlQuery = "SELECT
                     *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    Wo_number = :number
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(":number",$this->number);

            $stmt->execute();
            $itemCount = $stmt->rowCount();
            
           if($itemCount > 0){
               return true;
           }else{
               return false;
           }
        }   

        // UPDATE
        public function updatewo(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    Wo_dispatcher = :dispatcher ,	
                    Wo_number = :number ,
                    Wo_type = :type ,
                    Wo_status = :status ,
                    Wo_priority = :priority ,
                    Wo_store = :store ,
                    Wo_storeManager = :storeManager ,
                    Wo_storeManagerNo = :storeManagerNo ,
                    Wo_receivedIn = CASE WHEN :receivedIn !='' then :receivedIn else NULL END,
                    Wo_client = :client ,
                    Wo_clientContact = :clientContact ,
                    Wo_clientContactNo 	= :clientContactNo ,
                    Wo_facility = :facility ,
                    Wo_facilityContact = :facilityContact ,
                    Wo_facilityContactNo = :facilityContactNo ,
                    Wo_state = :state ,
                    Wo_city = :city ,
                    Wo_zip = :zip ,
                    Wo_location = :location ,
                    Wo_ETA = CASE WHEN :ETA !='' then :ETA else NULL END  ,
                    Wo_description = :description ,
                    Wo_clientNTE = :clientNTE ,
                    Wo_techVen = :techVen ,
                    Wo_assessment = :assessment ,
                    Wo_checkIn = CASE WHEN :checkIn !='' then :checkIn else NULL END   ,
                    Wo_checkOut = CASE WHEN :checkOut !='' then :checkOut else NULL END  ,
                    Wo_repairIn = CASE WHEN :repairIn !='' then :repairIn else NULL END ,
                    Wo_repairOut = CASE WHEN :repairOut !='' then :repairOut else NULL END  ,
                    Wo_assessmentTime = :assessmentTime ,
                    Wo_assessmentTimeCost = :assessmentTimeCost ,
                    Wo_assessmentTimeCharge = :assessmentTimeCharge ,
                    Wo_parts = :parts ,
                    Wo_partsCost = :partsCost ,
                    Wo_partsCharge = :partsCharge ,
                    Wo_material = :material ,
                    Wo_materialCost = :materialCost ,
                    Wo_materialCharge = :materialCharge ,
                    Wo_equiment = :equiment ,
                    Wo_equimentCost = :equimentCost ,
                    Wo_equimentCharge = :equimentCharge ,
                    Wo_laborTime = :laborTime ,
                    Wo_laborTimeCost = :laborTimeCost ,
                    Wo_laborTimeCharge = :laborTimeCharge ,
                    Wo_trip = :trip ,
                    Wo_tripCost = :tripCost ,
                    Wo_tripCharge = :tripCharge ,
                    Wo_Permit = :Permit ,
                    Wo_PermitCost = :PermitCost ,
                    Wo_PermitCharge = :PermitCharge ,
                    Wo_labTest = :labTest ,	
                    Wo_labTestCost = :labTestCost ,
                    Wo_labTestCharge = :labTestCharge ,
                    Wo_proposal = :proposal ,
                    Wo_link = :link ,
                    Wo_notes = :notes ,
                    Wo_actualCost = :actualCost ,
                    Wo_totalNTE = :totalNTE ,
                    Wo_paymentMethod = :paymentMethod ,
                    Wo_UDate = CURRENT_TIMESTAMP ,
                    Wo_Ustmp = :Ustmp ,
                    Wo_DoneDate =  CASE WHEN :DoneStmp !='' then CURRENT_TIMESTAMP else NULL END,
                    Wo_DoneStmp = :DoneStmp  
                    WHERE 
                    wo_Id = ".$this->id;
        
            $stmt = $this->conn->prepare($sqlQuery);
        

            $this->dispatcher=htmlspecialchars(strip_tags($this->dispatcher));	
            $this->number=htmlspecialchars(strip_tags($this->number));
            $this->type=htmlspecialchars(strip_tags($this->type));
            $this->status=htmlspecialchars(strip_tags($this->status));
            $this->priority=htmlspecialchars(strip_tags($this->priority));	
            $this->store=htmlspecialchars(strip_tags($this->store));
            $this->storeManager=htmlspecialchars(strip_tags($this->storeManager));		
            $this->storeManagerNo=htmlspecialchars(strip_tags($this->storeManagerNo));		
            $this->receivedIn=htmlspecialchars(strip_tags($this->receivedIn));
            $this->client=htmlspecialchars(strip_tags($this->client));
            $this->clientContact=htmlspecialchars(strip_tags($this->clientContact));		
            $this->clientContactNo=htmlspecialchars(strip_tags($this->clientContactNo));	
            $this->facility=htmlspecialchars(strip_tags($this->facility));
            $this->facilityContact=htmlspecialchars(strip_tags($this->facilityContact));	
            $this->facilityContactNo=htmlspecialchars(strip_tags($this->facilityContactNo));	
            $this->state=htmlspecialchars(strip_tags($this->state));
            $this->city=htmlspecialchars(strip_tags($this->city));
            $this->zip=htmlspecialchars(strip_tags($this->zip));
            $this->location=htmlspecialchars(strip_tags($this->location));
            $this->ETA=htmlspecialchars(strip_tags($this->ETA));			
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->clientNTE=htmlspecialchars(strip_tags($this->clientNTE));
            $this->techVen=htmlspecialchars(strip_tags($this->techVen));
            $this->assessment=htmlspecialchars(strip_tags($this->assessment));
            $this->checkIn=htmlspecialchars(strip_tags($this->checkIn));
            $this->checkOut=htmlspecialchars(strip_tags($this->checkOut));
            $this->repairIn=htmlspecialchars(strip_tags($this->repairIn));	
            $this->repairOut=htmlspecialchars(strip_tags($this->repairOut));	
            $this->assessmentTime=htmlspecialchars(strip_tags($this->assessmentTime));
            $this->assessmentTimeCost=htmlspecialchars(strip_tags($this->assessmentTimeCost));	
            $this->assessmentTimeCharge=htmlspecialchars(strip_tags($this->assessmentTimeCharge));
            $this->parts=htmlspecialchars(strip_tags($this->parts));
            $this->partsCost=htmlspecialchars(strip_tags($this->partsCost));
            $this->partsCharge=htmlspecialchars(strip_tags($this->partsCharge));
            $this->material=htmlspecialchars(strip_tags($this->material));
            $this->materialCost=htmlspecialchars(strip_tags($this->materialCost));	
            $this->materialCharge=htmlspecialchars(strip_tags($this->materialCharge));	
            $this->equiment=htmlspecialchars(strip_tags($this->equiment));
            $this->equimentCost=htmlspecialchars(strip_tags($this->equimentCost));
            $this->equimentCharge=htmlspecialchars(strip_tags($this->equimentCharge));
            $this->laborTime=htmlspecialchars(strip_tags($this->laborTime));
            $this->laborTimeCost=htmlspecialchars(strip_tags($this->laborTimeCost));	
            $this->laborTimeCharge=htmlspecialchars(strip_tags($this->laborTimeCharge));
            $this->trip=htmlspecialchars(strip_tags($this->trip));
            $this->tripCost=htmlspecialchars(strip_tags($this->tripCost));
            $this->tripCharge=htmlspecialchars(strip_tags($this->tripCharge));
            $this->Permit=htmlspecialchars(strip_tags($this->Permit));
            $this->PermitCost=htmlspecialchars(strip_tags($this->PermitCost)); 		
            $this->PermitCharge=htmlspecialchars(strip_tags($this->PermitCharge)); 	
            $this->labTest=htmlspecialchars(strip_tags($this->labTest));
            $this->labTestCost=htmlspecialchars(strip_tags($this->labTestCost));	
            $this->labTestCharge=htmlspecialchars(strip_tags($this->labTestCharge));	
            $this->proposal=htmlspecialchars(strip_tags($this->proposal));	
            $this->link=htmlspecialchars(strip_tags($this->link));
            $this->notes=htmlspecialchars(strip_tags($this->notes));
            $this->actualCost=htmlspecialchars(strip_tags($this->actualCost));
            $this->totalNTE=htmlspecialchars(strip_tags($this->totalNTE));		
            $this->paymentMethod=htmlspecialchars(strip_tags($this->paymentMethod));			
            $this->Ustmp=htmlspecialchars(strip_tags($this->Ustmp));
            $this->DoneStmp=htmlspecialchars(strip_tags($this->DoneStmp));
             
 
 
 
             // bind data
             $stmt->bindParam(":dispatcher",$this->dispatcher);	
             $stmt->bindParam(":number",$this->number);
             $stmt->bindParam(":type",$this->type);
             $stmt->bindParam(":status",$this->status);
             $stmt->bindParam(":priority",$this->priority);	
             $stmt->bindParam(":store",$this->store);
             $stmt->bindParam(":storeManager",$this->storeManager);		
             $stmt->bindParam(":storeManagerNo",$this->storeManagerNo);		
             $stmt->bindParam(":receivedIn",$this->receivedIn);
             $stmt->bindParam(":client",$this->client);
             $stmt->bindParam(":clientContact",$this->clientContact);		
             $stmt->bindParam(":clientContactNo",$this->clientContactNo);	
             $stmt->bindParam(":facility",$this->facility);
             $stmt->bindParam(":facilityContact",$this->facilityContact);	
             $stmt->bindParam(":facilityContactNo",$this->facilityContactNo);	
             $stmt->bindParam(":state",$this->state);
             $stmt->bindParam(":city",$this->city);
             $stmt->bindParam(":zip",$this->zip);
             $stmt->bindParam(":location",$this->location);
             $stmt->bindParam(":ETA",$this->ETA);			
             $stmt->bindParam(":description",$this->description);
             $stmt->bindParam(":clientNTE",$this->clientNTE);
             $stmt->bindParam(":techVen",$this->techVen);
             $stmt->bindParam(":assessment",$this->assessment);
             $stmt->bindParam(":checkIn",$this->checkIn);
             $stmt->bindParam(":checkOut",$this->checkOut);
             $stmt->bindParam(":repairIn",$this->repairIn);	
             $stmt->bindParam(":repairOut",$this->repairOut);	
             $stmt->bindParam(":assessmentTime",$this->assessmentTime);
             $stmt->bindParam(":assessmentTimeCost",$this->assessmentTimeCost);	
             $stmt->bindParam(":assessmentTimeCharge",$this->assessmentTimeCharge);
             $stmt->bindParam(":parts",$this->parts);
             $stmt->bindParam(":partsCost",$this->partsCost);
             $stmt->bindParam(":partsCharge",$this->partsCharge);
             $stmt->bindParam(":material",$this->material);
             $stmt->bindParam(":materialCost",$this->materialCost);	
             $stmt->bindParam(":materialCharge",$this->materialCharge);	
             $stmt->bindParam(":equiment",$this->equiment);
             $stmt->bindParam(":equimentCost",$this->equimentCost);
             $stmt->bindParam(":equimentCharge",$this->equimentCharge);
             $stmt->bindParam(":laborTime",$this->laborTime);
             $stmt->bindParam(":laborTimeCost",$this->laborTimeCost);	
             $stmt->bindParam(":laborTimeCharge",$this->laborTimeCharge);
             $stmt->bindParam(":trip",$this->trip);
             $stmt->bindParam(":tripCost",$this->tripCost);
             $stmt->bindParam(":tripCharge",$this->tripCharge);
             $stmt->bindParam(":Permit",$this->Permit);
             $stmt->bindParam(":PermitCost",$this->PermitCost); 		
             $stmt->bindParam(":PermitCharge",$this->PermitCharge); 	
             $stmt->bindParam(":labTest",$this->labTest);
             $stmt->bindParam(":labTestCost",$this->labTestCost);	
             $stmt->bindParam(":labTestCharge",$this->labTestCharge);	
             $stmt->bindParam(":proposal",$this->proposal);	
             $stmt->bindParam(":link",$this->link);
             $stmt->bindParam(":notes",$this->notes);
             $stmt->bindParam(":actualCost",$this->actualCost);
             $stmt->bindParam(":totalNTE",$this->totalNTE);		
             $stmt->bindParam(":paymentMethod",$this->paymentMethod);			
             $stmt->bindParam(":Ustmp",$this->Ustmp);
             $stmt->bindParam(":DoneStmp",$this->DoneStmp);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function updatewoStatus(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                    Wo_status = :status 
                    WHERE 
                    wo_Id = ".$this->id ."";
        
            $stmt = $this->conn->prepare($sqlQuery);
        

            $this->status=htmlspecialchars(strip_tags($this->status));
   
             $stmt->bindParam(":status",$this->status);



        
            if($stmt->execute()){
               return true;
            }
            return false;
        }
        // DELETE
        function deletewo(){
            $this->id=htmlspecialchars(strip_tags($this->id));

            $sqlQuery = "UPDATE  " . $this->db_table . " set wo_status = IF(wo_status='1', '0', '1') WHERE wo_id = '". $this->id ."'";
            $stmt = $this->conn->prepare($sqlQuery);
                
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>