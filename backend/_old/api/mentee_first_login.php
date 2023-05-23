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
        $user->users_id = $data->users_id;
        $user->initial_weight = $data->initial_weight;
        $user->current_weight = $data->current_weight;
        $user->target_weight = $data->target_weight;
        $user->growth = $data->growth;
        $user->age = $data->age;
        $user->activity_factor = $data->activity_factor;
        $user->sex = $data->sex;
        if($user->firstloginMentee()){
            http_response_code(200);
            echo json_encode(
                array("message" => "Mentee first login data updated.")
            );
        } else{
            http_response_code(404);
            echo json_encode(
                array("message" => "Mentee first login not send.")
            );
        }
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "Fill all fields.")
        );
    }
?>