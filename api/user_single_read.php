<?php
    header('Access-Control-Allow-Origin: *');

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/Database.php';
    include_once '../class/users.php';
    include_once '../config/response.php';

    $Database = new Database();
    $db = $Database->getConnection();

    $item = new users($db);
    $data = json_decode(file_get_contents("php://input"));

    $item->username =  $data->username;

    $item->getSingleusers();
    if($item->firstName != null){
        // create array
        $emp_arr = array(
            "username" =>  $item->username,
            "firstName" => $item->firstName,
            "lastName" => $item->lastName,
            "role" => $item->role,
            "status" => $item->status,
        );
      
        http_response_code(200);
        echo json_encode($emp_arr);
    }
      
    else{
        echo json_encode(msg(0,422,'No record found.'));
    }
?>