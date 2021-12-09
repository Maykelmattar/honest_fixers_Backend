<?php
    header('Access-Control-Allow-Origin: *');

    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
    include_once '../config/Database.php';
    include_once '../class/users.php';
    include_once '../class/clients.php';
    include_once '../class/priority.php';
    include_once '../class/status.php';
    include_once '../class/types.php';

    include_once '../config/response.php';

    $Database = new Database();
    $db = $Database->getConnection();
    $data = json_decode(file_get_contents("php://input"));



    $dispatchers = new users($db);

    $stmt = $dispatchers->getusers('dropdown');
    $itemCount = $stmt->rowCount();

    $dispatchersArr = array();

    if($itemCount > 0){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "value" => $username,
                "label" => $firstName . ' ' . $lastName,
            );

            array_push($dispatchersArr, $e);
        }
    }
    
    $client = new clients($db);

    $stmt = $client->getclients('dropdown');
    $clientitemCount = $stmt->rowCount();

    $clientArr = array();

    if($clientitemCount > 0){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "value" => $id,
                "label" => $name,
            );

            array_push($clientArr, $e);
        }
    }

    $types = new types($db);

    $stmt = $types->gettypes('dropdown');
    $typesitemCount = $stmt->rowCount();

    $typesArr = array();

    if($typesitemCount > 0){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "value" => $id,
                "label" => $name,
            );

            array_push($typesArr, $e);
        }
    }

    $status = new status($db);

    $stmt = $status->getstatus('dropdown');
    $statusitemCount = $stmt->rowCount();

    $statusArr = array();

    if($statusitemCount > 0){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "value" => $id,
                "label" => $name,
            );

            array_push($statusArr, $e);
        }
    }
    $priority = new priority($db);

    $stmt = $priority->getpriority('dropdown');
    $statusitemCount = $stmt->rowCount();

    $priorityArr = array();

    if($statusitemCount > 0){
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "value" => $id,
                "label" => $name,
            );

            array_push($priorityArr, $e);
        }
    }

 
        echo json_encode(   array_merge([
            'dispatchersList' => $dispatchersArr,
            'typesList' => $typesArr,
            'statusList' => $statusArr,
            'priorityList' => $priorityArr,
            'clientsList' => $clientArr,
    
        ]));


?>