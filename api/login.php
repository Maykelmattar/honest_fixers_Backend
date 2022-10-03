<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include_once '../config/Database.php';
include_once '../config/response.php';

$Database = new Database();
$conn = $Database->getConnection();

$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// IF REQUEST METHOD IS NOT EQUAL TO POST
if($_SERVER["REQUEST_METHOD"] != "POST"):
    $returnData = msg(0,404,'Page Not Found!');

// CHECKING EMPTY FIELDS
elseif(!isset($data->username) 
    || !isset($data->password)
    || empty(trim($data->username))
    || empty(trim($data->password))
    ):

    $fields = ['fields' => ['username','password']];
    $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else:
    $username = trim($data->username);
    $password = trim($data->password);


    
    // IF PASSWORD IS LESS THAN 8 THE SHOW THE ERROR
    if(strlen($password) < 8):
        $returnData = msg(0,422,'Your password must be at least 8 characters long!');

    // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
    else:
        try{
            
            $fetch_user_by_username = "SELECT * FROM `users` WHERE `Users_username`=:username";
            $query_stmt = $conn->prepare($fetch_user_by_username);
            $query_stmt->bindValue(':username', $username,PDO::PARAM_STR);
            $query_stmt->execute();

            // IF THE USER IS FOUNDED BY username
            if($query_stmt->rowCount()):
                $row = $query_stmt->fetch(PDO::FETCH_ASSOC);

                // VERIFYING THE PASSWORD (IS CORRECT OR NOT?)
                // IF PASSWORD IS CORRECT THEN SEND THE LOGIN TOKEN
                if ($row['Users_status'] != '1'):

                    $returnData = msg(0,422, "User Disabled");
                
                elseif($password == $row['Users_password']):

              
                    
                    $returnData = [
                        'status' => 200,
                        'success' => 1,
                        'message' => 'You have successfully logged in.',
                        'type' => $row['Users_type'],
                        'firstName' => $row['Users_firstName'],
                        'lastName' => $row['Users_lastName'],
                        'username' => $row['Users_username'],
                        'role' => $row['Users_type'],
                    ];

                // IF INVALID PASSWORD
                else:
                    $returnData = msg(0,422, "Invalid Password");
                endif;

            // IF THE USER IS NOT FOUNDED BY username THEN SHOW THE FOLLOWING ERROR
            else:
                $returnData = msg(0,422,'Invalid username Address!');
            endif;
        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }

    endif;

endif;

echo json_encode($returnData);