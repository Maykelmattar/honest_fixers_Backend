<?php
    header('Access-Control-Allow-Origin: *');

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once '../config/Database.php';
    include_once '../class/types.php';
    include_once '../config/response.php';

    $Database = new Database();
    $db = $Database->getConnection();
    
    $item = new types($db);
    
    $data = json_decode(file_get_contents("php://input"));
    
    $item->id = $data->id;
    
    if($item->deletetypes()){
        echo json_encode(msg(1,200,'Type status updated.'));
    } else{
        echo json_encode(msg(0,422,'Type could not be updated'));
    }
?>