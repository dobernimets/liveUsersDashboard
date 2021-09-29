  
<?php

require_once "../userModule.php";


header("Content-Type:application/json; charset=utf-8");

$body = trim(file_get_contents("php://input"));
$request = json_decode($body, true);

$sessionKey = $request['sessionKey'];

$userModule = new UserModule;
$userModule -> updateConnectionUser($sessionKey);


$status = json_encode(Array('userUpdate' => 'success'));
echo $status;


?>