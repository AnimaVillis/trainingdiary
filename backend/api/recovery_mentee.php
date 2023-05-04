<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/mentee.php';
    $database = new Database();
    $db = $database->getConnection();
    $user = new Mentee($db);
    $data = json_decode(file_get_contents("php://input"));
    if($data != null) {
        $user->name = $data->name;
        $user->email = $data->email;
        if($user->recoveryMentee()){
            http_response_code(200);
            echo json_encode(
                array("message" => "Mentee recovery mail sended.")
            );
        } else {
            http_response_code(404);
            echo json_encode(
                array("message" => "Mentee cannot be recovered.")
            );
        }
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Fill all fields.")
        );
    }
?>