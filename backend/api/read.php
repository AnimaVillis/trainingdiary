<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/mentee.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $items = new Mentee($db);
    $stmt = $items->getMentees();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){
        
        $menteeArr = array();
        $menteeArr["mentees"] = array();
        $menteeArr["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "user_level" => $user_level,
                "first_login" => $first_login,
            );
            array_push($menteeArr["mentees"], $e);
        }
        echo json_encode($menteeArr);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>