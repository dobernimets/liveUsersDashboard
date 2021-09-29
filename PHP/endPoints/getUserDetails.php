<?php

    require_once "../userModule.php";


    header("Content-Type:application/json; charset=utf-8");

    $body = trim(file_get_contents("php://input"));
    $request = json_decode($body, true);
 
    
    $userModule = new UserModule;
    $userDetails = $userModule -> getUserDetalis($request["id"]);
    $answer = json_encode($userDetails);
    echo $answer;
?>
