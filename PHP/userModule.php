<?php

    require_once "dataBase.php";
   
    
    class UserModule{
     
        public static $sessionKey;

        function validEmail($email){

            $isValid = filter_var($email, FILTER_VALIDATE_EMAIL);
            return $isValid;

        } 
        function validName($userName){

            $isValid = !empty($userName);
            return $isValid;

        } 

        function userExist($userName, $email){
            date_default_timezone_set("israel");
            $date = date("Y-m-d H:i:s"); 

            $allUsers = DataBase::getAllUsers();
            if(count($allUsers) < 1) return false;

            foreach ($allUsers as $user) {
               if($user->userName == $userName && $user->email == $email){
                   
                    $user->lastSeen = $date;
                    $user->entrance_time = $date;
                    DataBase::insert($allUsers);
                    return $user;
               }
               else if($user->userName == $userName && $user->email != $email){       
                return "err";
               }
            
            }
            
            return false;
        }
        
        function createUser($userName ,$email, $userAgent, $userIP){
            date_default_timezone_set("israel");
            $date = date("Y-m-d H:i:s"); 
            session_start();

            $sessionKey = session_create_id();

            $allusers = DataBase::getAllUsers();

            $user = array("id"=>uniqid(),"userName"=>$userName, "email"=>$email, "userAgent"=>$userAgent,
                          "userIP"=>$userIP, "sessionKey"=>$sessionKey, "entrance_time"=>$date,
                          "lastSeen"=>$date,"visit_count"=>1 );

            array_push($allusers, $user);

            $createUser = DataBase::insert($allusers);

            if($createUser){
                $_SESSION['sessionKey'] = $sessionKey;       
                return $userName;
            }            
            return false;
          
        }

        function login($sessionKey, $userName){
            session_start();
            $_SESSION['sessionKey'] = $sessionKey; 
            $_SESSION['userName'] = $userName; 
            $allUsers = DataBase::getAllUsers();

            foreach ($allUsers as $user) {
                if($user->sessionKey == $sessionKey){

                    $user->visit_count += 1;
                    DataBase::insert($allUsers);
                    return ;

                }     
            }   

        }

        function checkUserConnection(){
            session_start();

            if(isset($_SESSION['sessionKey'])){
                self::$sessionKey = $_SESSION['sessionKey'];
                
                return true;
            }

            return false;
        }

        function logout(){
            session_start();
            unset($_SESSION['sessionKey']);
            
            return true;
        }

        function getUserList(){
            date_default_timezone_set("israel");
            $date = date("Y-m-d H:i:s", strtotime("- 5 sec")); 

            $allUsers = DataBase::getAllUsers();

            
            foreach ($allUsers as $user) {
                if($user->lastSeen < $date){
                    $user->status = "offline";
                }else{
                    $user->status = "online";
                    $user->lastSeen = "connect";
                }
                
               
             
            } 
            return $allUsers;

        }
        function updateConnectionUser($sessionKey){
            
            date_default_timezone_set("israel");
            $date = date("Y-m-d H:i:s"); 
            $allUsers = DataBase::getAllUsers();

            foreach ($allUsers as $user) {
                if($user->sessionKey == $sessionKey){

                    $user->lastSeen = $date;
                    DataBase::insert($allUsers);
                    return true;

                }     
            }
           
        }
        function getUserDetalis($userId){
            
            $allUsers = DataBase::getAllUsers();

            foreach ($allUsers as $user) {
                if($user->id == $userId){
                    $userDetails = array("userName"=>$user->userName,"email"=>$user->email,
                                        "userAgent"=>$user->userAgent,"visit_count"=>$user->visit_count,
                                        "entrance_time"=>$user->entrance_time);
                    return $userDetails;               

                }     
            }

        }
    }
?>

