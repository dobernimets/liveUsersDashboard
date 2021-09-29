<?php 

    require_once "PHP/Components.php";
    require_once "PHP/userModule.php";
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/fe7c245d79.js">
    <title>Document</title>
</head>
<body>
    <?php

        $Componenets = new Components;

        $userModule = new UserModule;
        $userIsConnect = $userModule -> checkUserConnection();
    
        if($userIsConnect){
            $Componenets-> userListComponent();
        }else{
            $Componenets-> loginComponent();
        }

                
    ?>
    
    <script src="https://kit.fontawesome.com/fe7c245d79.js" crossorigin="anonymous"></script>
</body>
</html>