<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    //ini_set('display_errors', 1);
    include_once '../config/database.php';
    include_once '../class/mentee.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Mentee($db);
    $data = json_decode(file_get_contents("php://input"));
    if($data != null) {
        $item->users_id = $data->users_id;
        $item->initial_weight = $data->initial_weight;
        $item->current_weight = $data->current_weight;
        $item->target_weight = $data->target_weight;
        $item->growth = $data->growth;
        $item->age = $data->age;
        $item->activity_factor = $data->activity_factor;
        $item->sex = $data->sex;
        if($item->firstloginMentee()){
            http_response_code(200);
            echo json_encode(
                array("message" => "Mentee first login data updated.")
            );
        } else{
            http_response_code(200);
            echo json_encode(
                array("message" => "Mentee first login not send.")
            );
        }
    } else {
        http_response_code(200);
        echo json_encode(
            array("message" => "Fill all fields.")
        );
    }
?>