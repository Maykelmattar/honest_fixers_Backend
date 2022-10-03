<?php
    header('Access-Control-Allow-Origin: *');

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/Database.php';
    include_once '../class/clients.php';
    include_once '../config/response.php';

    $Database = new Database();
    $db = $Database->getConnection();




    $item = new clients($db);

    $data = json_decode(file_get_contents("php://input"));
 
    $item->id = $data->id;
    $item->name = $data->name;
    $item->creator = $data->creator;
    if($data->name){
    if($item->createclients()){
        $returnData = msg(1,200,'Client created successfully.');

    } else{
        $returnData = msg(0,422,'clients could not be created.');

}
    }
echo json_encode($returnData);
?>