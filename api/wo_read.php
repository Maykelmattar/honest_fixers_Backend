<?php
    header('Access-Control-Allow-Origin: *');

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
    include_once '../config/Database.php';
    include_once '../class/wo.php';
    include_once '../class/users.php';
    include_once '../class/status.php';
    include_once '../class/types.php';
    include_once '../class/priority.php';
    include_once '../config/response.php';

    $Database = new Database();
    $db = $Database->getConnection();
    $data = json_decode(file_get_contents("php://input"));
	try{
    $usernameExist = new users($db);

    $usernameExist->username = $data->username;

    $usernameExist->getSingleusers();
    if($usernameExist->username){

    $items = new wo($db);
    $items->username = $data->username;

    $stmt = $items->getwo();
    $itemCount = $stmt->rowCount();

	

    if($itemCount > 0){
        
        $woArr = array();
        $woArr["body"] = array();
        $woArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $Typename="";
            $itemType = new types($db);

            $itemType->id = $Wo_type ;
            $itemType->getSingletypes();
            if($itemType->name != null){
                $Typename=$itemType->name;
            }
            $statusname="";
            $itemStatus = new status($db);

            $itemStatus->id = $Wo_status ;
            $itemStatus->getSinglestatus();
            if($itemStatus->name != null){
                $statusname=$itemStatus->name;
            }
            $priorityname="";
            $itemPriority = new priority($db);

            $itemPriority->id = $Wo_priority ;
            $itemPriority->getSinglepriority();
            if($itemPriority->name != null){
                $priorityname=$itemPriority->name;
            }
            $dispatchername="";
            $itemDispatcher = new users($db);

            $itemDispatcher->username = $Wo_dispatcher ;
            $itemDispatcher->getSingleusers();
            if($itemDispatcher->firstName != null){
                $dispatchername=$itemDispatcher->firstName . " " . $itemDispatcher->lastName;
            }
            $e = array(
                "Id"=>$Wo_Id,	
                "dispatcher"=>$Wo_dispatcher,
                "dispatchername"=>$dispatchername,		
                "number"=>$Wo_number,
                "type"=>$Wo_type,
                "typename"=>$Typename,
                "status"=>$Wo_status,
                "statusname"=>$statusname,
                "priority"=>$Wo_priority,	
                "priorityname"=>$priorityname,	
                "store"=>$Wo_store,
                "storeManager"=>$Wo_storeManager,		
                "storeManagerNo"=>$Wo_storeManagerNo,		
                "receivedIn"=>$Wo_receivedIn,
                "client"=>$Wo_client,
                "clientContact"=>$Wo_clientContact,		
                "clientContactNo"=>$Wo_clientContactNo,	
                "facility"=>$Wo_facility,
                "facilityContact"=>$Wo_facilityContact,	
                "facilityContactNo"=>$Wo_facilityContactNo,	
                "state"=>$Wo_state,
                "city"=>$Wo_city,
                "zip"=>$Wo_zip,
                "location"=>$Wo_location,
                "ETA"=>$Wo_ETA,			
                "description"=>$Wo_description,
                "clientNTE"=>$Wo_clientNTE,
                "techVen"=>$Wo_techVen,
                "assessment"=>$Wo_assessment,
                "checkIn"=>$Wo_checkIn,
                "checkOut"=>$Wo_checkOut,
                "repairIn"=>$Wo_repairIn,	
                "repairOut"=>$Wo_repairOut,	
                "assessmentTime"=>$Wo_assessmentTime,
                "assessmentTimeCost"=>$Wo_assessmentTimeCost,	
                "assessmentTimeCharge"=>$Wo_assessmentTimeCharge,
                "parts"=>$Wo_parts,
                "partsCost"=>$Wo_partsCost,
                "partsCharge"=>$Wo_partsCharge,
                "material"=>$Wo_material,
                "materialCost"=>$Wo_materialCost,	
                "materialCharge"=>$Wo_materialCharge,	
                "equiment"=>$Wo_equiment,
                "equimentCost"=>$Wo_equimentCost,
                "equimentCharge"=>$Wo_equimentCharge,
                "laborTime"=>$Wo_laborTime,
                "laborTimeCost"=>$Wo_laborTimeCost,	
                "laborTimeCharge"=>$Wo_laborTimeCharge,
                "trip"=>$Wo_trip,
                "tripCost"=>$Wo_tripCost,
                "tripCharge"=>$Wo_tripCharge,
                "Permit"=>$Wo_Permit,
                "PermitCost"=>$Wo_PermitCost, 		
                "PermitCharge"=>$Wo_PermitCharge, 	
                "labTest"=>$Wo_labTest,
                "labTestCost"=>$Wo_labTestCost,	
                "labTestCharge"=>$Wo_labTestCharge,	
                "proposal"=>$Wo_proposal,	
                "link"=>$Wo_link,
                "notes"=>$Wo_notes,
                "actualCost"=>$Wo_actualCost,
                "totalNTE"=>$Wo_totalNTE,		
                "paymentMethod"=>$Wo_paymentMethod,			
                "CDate"=>$Wo_CDate,	
                "UDate"=>$Wo_UDate,
                "DoneDate"=>$Wo_DoneDate,	
                "Cstmp"=>$Wo_Cstmp,
                "Ustmp"=>$Wo_Ustmp,
                "DoneStmp"=>$Wo_DoneStmp,
                "updatesCount"=>$updatesCount,
    

            );

            array_push($woArr["body"], $e);
        }

        echo json_encode($woArr);
    }
    else{
        echo json_encode(
            msg(0,422,'No record found.')
        );
    }
}else{
    echo json_encode(msg(0,500,'You are not allowed to see the wo'));

}
} catch(PDOException $e){
            echo json_encode(msg(0,500,$e->getMessage()));
        }