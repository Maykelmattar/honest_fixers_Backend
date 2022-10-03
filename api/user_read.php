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

    $usernameExist->getSingleusers();
    if($usernameExist->role != 1){
        echo json_encode(msg(0,500,'You are not allowed to see the Users'));
    }else{

    $items = new users($db);

    $stmt = $items->getusers('all');
    $itemCount = $stmt->rowCount();



    if($itemCount > 0){
        
        $usersArr = array();
        $usersArr["body"] = array();
        $usersArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "username" => $username,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "role" => $role,
                "status" => $status,

            );

            array_push($usersArr["body"], $e);
        }

        echo json_encode($usersArr);
    }
    else{
        echo json_encode(
            msg(0,422,'No record found.')
        );
    }
}
?>