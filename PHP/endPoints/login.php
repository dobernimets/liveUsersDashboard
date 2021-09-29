<?php

    require_once "../userModule.php";


    header("Content-Type:application/json; charset=utf-8");

    $body = trim(file_get_contents("php://input"));
    $request = json_decode($body, true);

    $userName = $request['userName'];
    $email = $request['email'];
    $userAgent = $request['userAgent'];
    $userIP = $request['userIP'];
  
    $userModule = new UserModule;
    $isValidEmail = $userModule -> validEmail($email);
    $isValidName = $userModule -> validName($userName);

    if(!$isValidName){
        $answer = json_encode(Array('err' => "Please enter a valid name!"));
        echo $answer;
        return;
    }
    if(!$isValidEmail){
        $answer = json_encode(Array('err' => "Please enter a valid email!"));
        echo $answer;
        return;
    }

    $userExist = $userModule -> userExist($userName, $email);
    
    if($userExist=="err"){
        $answer = json_encode(Array('err' => "name or email already exist"));
        echo $answer;
        return;
    }
    else if($userExist){ 

        $userModule -> login($userExist->sessionKey, $userExist->userName);
        $answer = json_encode(Array('success' => $userExist));
        echo $answer;
        return;
        
    }else{
        $createUser = $userModule -> createUser($userName, $email, $userAgent, $userIP);

        if($createUser){
            $_SESSION['userName'] = $createUser;  
            $answer = json_encode(Array('success' =>  "You're logged in"));
            echo $answer;
            return;
        }
    }
    
?>
