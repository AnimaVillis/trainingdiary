<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../config/database.php';
    include_once '../class/mentee.php';
    $database = new Database();
    $db = $database->getConnection();
    $item = new Mentee($db);
    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleMentee();
    if($item->name != null){
        // create array
        $ment_arr = array(
            "id" =>  $item->id,
            "name" => $item->name,
            "email" => $item->email,
            "user_level" => $item->user_level,
            "first_login" => $item->first_login
        );
      
        http_response_code(200);
        echo json_encode($ment_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Mentee not found.");
    }
?>