<?php

    require_once "../userModule.php";


    header("Content-Type:application/json; charset=utf-8");

    $body = trim(file_get_contents("php://input"));
 
    
    $userModule = new UserModule;
    $logout = $userModule -> logout();
    $result = $logout == false ? json_encode(Array('success' => "You are offline")) 
    : json_encode(Array('error' => "System error Try again"));
    echo $result;
?>
