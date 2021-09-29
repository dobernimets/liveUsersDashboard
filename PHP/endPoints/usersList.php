<?php

    require_once "../userModule.php";


    header("Content-Type:application/json; charset=utf-8");

    $body = trim(file_get_contents("php://input"));
 
    
    $userModule = new UserModule;
    $usersList = $userModule -> getUserList();


    
    $status = json_encode(Array('success' => $usersList));
    echo $status;
    
    
?>