<?php
    header('Access-Control-Allow-Origin: *');

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/Database.php';
    include_once '../class/priority.php';
    include_once '../config/response.php';

    $Database = new Database();
    $db = $Database->getConnection();
    
    $item = new priority($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    // priority values
    $item->name = $data->name;
    
    if($item->updatepriority()){
        echo json_encode(msg(1,200,'priority data updated.'));
    } else{
        echo json_encode(msg(0,422,'Data could not be updated'));
    }
?>