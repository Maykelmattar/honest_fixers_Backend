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
 
    $item->number = $data->number;

    if($item->checkWoAvailability()){
        $returnData = msg(0,400,'Not Valid');

    }else{
        $returnData = msg(1,200,'Valid');

    }
    echo json_encode($returnData);

?>