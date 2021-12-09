<?php
    header('Access-Control-Allow-Origin: *');

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/Database.php';
    include_once '../class/wo.php';
    include_once '../config/response.php';

    $Database = new Database();
    $db = $Database->getConnection();




    $item = new wo($db);

    $data = json_decode(file_get_contents("php://input"));
        
            $item->dispatcher=$data->dispatcher;	
           $item->number=$data->number;
           $item->type=$data->type;
           $item->status=$data->status;
           $item->priority=$data->priority;	
           $item->store=$data->store;
           $item->storeManager=$data->storeManager;		
           $item->storeManagerNo=$data->storeManagerNo;		
           $item->receivedIn=$data->receivedIn;
           $item->client=$data->client;
           $item->clientContact=$data->clientContact;		
           $item->clientContactNo=$data->clientContactNo;	
           $item->facility=$data->facility;
           $item->facilityContact=$data->facilityContact;	
           $item->facilityContactNo=$data->facilityContactNo;	
           $item->state=$data->state;
           $item->city=$data->city;
           $item->zip=$data->zip;
           $item->location=$data->location;
           $item->ETA=$data->ETA;			
           $item->description=$data->description;
           $item->clientNTE=$data->clientNTE;
           $item->techVen=$data->techVen;
           $item->assessment=$data->assessment;
           $item->checkIn=$data->checkIn;
           $item->checkOut=$data->checkOut;
           $item->repairIn=$data->repairIn;	
           $item->repairOut=$data->repairOut;	
           $item->assessmentTime=$data->assessmentTime;
           $item->assessmentTimeCost=$data->assessmentTimeCost;	
           $item->assessmentTimeCharge=$data->assessmentTimeCharge;
           $item->parts=$data->parts;
           $item->partsCost=$data->partsCost;
           $item->partsCharge=$data->partsCharge;
           $item->material=$data->material;
           $item->materialCost=$data->materialCost;	
           $item->materialCharge=$data->materialCharge;	
           $item->equiment=$data->equiment;
           $item->equimentCost=$data->equimentCost;
           $item->equimentCharge=$data->equimentCharge;
           $item->laborTime=$data->laborTime;
           $item->laborTimeCost=$data->laborTimeCost;	
           $item->laborTimeCharge=$data->laborTimeCharge;
           $item->trip=$data->trip;
           $item->tripCost=$data->tripCost;
           $item->tripCharge=$data->tripCharge;
           $item->Permit=$data->Permit;
           $item->PermitCost=$data->PermitCost; 		
           $item->PermitCharge=$data->PermitCharge; 	
           $item->labTest=$data->labTest;
           $item->labTestCost=$data->labTestCost;	
           $item->labTestCharge=$data->labTestCharge;	
           $item->proposal=$data->proposal;	
           $item->link=$data->link;
           $item->notes=$data->notes;
           $item->actualCost=$data->actualCost;
           $item->totalNTE=$data->totalNTE;		
           $item->paymentMethod=$data->paymentMethod;			
           $item->Ustmp=$data->Ustmp;
           $item->DoneStmp=$data->DoneStmp;
           $item->id=$data->id;	

    if($item->updatewo()){
        $returnData = msg(1,200,'Wo updated successfully.');

    } else{
        $returnData = msg(0,422,'Wo could not be updated.');

}
echo json_encode($returnData);
?>