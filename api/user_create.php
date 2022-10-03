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





    $data = json_decode(file_get_contents("php://input"));
    $usernameExist = new users($db);

    $usernameExist->username = $data->username;

    
    // if($usernameExist->checkUsers()){
    //     $returnData = msg(0,402,'User already exists');
    // }else{
    $item = new users($db);
    $item->username = $data->username;
    $item->firstName = $data->firstName;
    $item->lastName = $data->lastName;
    $item->password = $data->password;
    $item->role = $data->role;
    $item->creator = $data->creator;
        if($data->username){
    if($item->createusers()){
        $returnData = msg(1,200,'User created successfully.');

    } else{
        $returnData = msg(0,422,'Users could not be created.');

    }
}
// }
echo json_encode($returnData);
?>