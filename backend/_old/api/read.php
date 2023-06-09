<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../config/database.php';
    include_once '../class/mentee.php';
    
    $database = new Database();
    $db = $database->getConnection();
    $users = new Mentee($db);
    $stmt = $users->getMentees();
    $userCount = $stmt->rowCount();

    echo json_encode($userCount);
    if($userCount > 0){
        
        $menteeArr = array();
        $menteeArr["mentees"] = array();
        $menteeArr["userCount"] = $userCount;
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