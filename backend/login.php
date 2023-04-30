<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/config/database.php';
require __DIR__.'/class/JwtHandler.php';

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}

$database = new Database();
$db = $database->getConnection();

$user = json_decode(file_get_contents("php://input"));
$returnData = [];

if($_SERVER["REQUEST_METHOD"] != "POST"):
    $returnData = msg(0,404,'Page Not Found!');
elseif(!isset($user->email) 
    || !isset($user->password)
    || empty(trim($user->email))
    || empty(trim($user->password))
    ):

    $fields = ['fields' => ['email','password']];
    $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);

else:
    $email = trim($user->email);
    $password = trim($user->password);

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)):
        $returnData = msg(0,404,'Invalid Email Address!');

    elseif(strlen($password) < 8):
        $returnData = msg(0,422,'Your password must be at least 8 characters long!');

    else:
        try{
            
            $fetch_user_by_email = "SELECT * FROM `users` WHERE `email`=:email";
            $stmt = $db->prepare($fetch_user_by_email);
            $stmt->bindValue(':email', $email,PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount()):
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $check_password = password_verify($password, $row['password']);

                if($check_password):

                    $jwt = new JwtHandler();
                    $token = $jwt->jwtEncodeData(
                        'http://localhost/',
                        array("user_id"=> $row['id'])
                    );
                    
                    $returnData = [
                        'success' => 1,
                        'message' => 'You have successfully logged in.',
                        'token' => $token
                    ];

                else:
                    $returnData = msg(0,400,'Invalid Password!');
                endif;

            else:
                $returnData = msg(0,400,'Invalid Email Address!');
            endif;
        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }

    endif;

endif;

echo json_encode($returnData);