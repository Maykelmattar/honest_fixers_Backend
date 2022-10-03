<?php
    header('Access-Control-Allow-Origin: *');

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
    include_once '../config/Database.php';
    include_once '../class/status.php';
    include_once '../class/users.php';
    include_once '../config/response.php';

    $Database = new Database();
    $db = $Database->getConnection();
    $data = json_decode(file_get_contents("php://input"));
    $usernameExist = new users($db);

    $usernameExist->username = $data->username;

    $usernameExist->getSingleusers();
    if($usernameExist->role != 1){
        echo json_encode(msg(0,500,'You are not allowed to see the status'));
    }else{

    $items = new status($db);

    $stmt = $items->getstatus('all');
    $itemCount = $stmt->rowCount();



    if($itemCount > 0){
        
        $statusArr = array();
        $statusArr["body"] = array();
        $statusArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name"=> $name,
                "status" => $status,

            );

            array_push($statusArr["body"], $e);
        }

        echo json_encode($statusArr);
    }
    else{
        echo json_encode(
            msg(0,422,'No record found.')
        );
    }
}
?>