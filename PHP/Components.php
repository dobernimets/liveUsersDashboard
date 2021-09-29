<?php

require_once "userModule.php";
    class Components{
        
        function loginComponent(){
            ?>

    
            <article class="login-page">
                <div class="form">
                    <input id="userName" placeholder="name" type="text">
                    <input id="email" placeholder="email" type="email">
                    <div class="error" ></div>
                    <button id="login" >LOGIN</button>
                </div>      

            </article>
            <script src="js/fetchTemplate.js"></script>
            <script src="js/enrollment.js"></script>
            <script>

                const userIP =  `<?php
                    $ip = "";

                    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                        $ip = $_SERVER['HTTP_CLIENT_IP'];
                    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                    } else {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    }
                    echo $ip;
                ?>`
                const userAgent = `<?php echo $_SERVER['HTTP_USER_AGENT'] ?>`;

                userDetails = { userIP, userAgent};
                const enrollment = new Enrollment();
                const loginButton  = document.querySelector("#login");

                loginButton.addEventListener('click',async function() {    
                    
                    const result = await enrollment.login();
                    if(result.err){
                        const viewError  = document.querySelector(".error");
                        debugger

                        viewError.innerText = result.err;
                    }
                    else{
                        location.reload();
                    }
                    
                });
            </script>
           
    
            
            <?php
        }

        function userListComponent(){
            ?>
            <div class="full-screeen">
                
            </div>
            <header class="header-list-users">
                <button id="logout" class="logout-btn">
                    logout
                </button>
                <div class="text">
                    welcome
                  <?php 
                        echo $_SESSION['userName'];
                   ?>!
                </div>
                
            </header>    

              <article class="list-users">
                
              </article>  
              <div class="popup-user-details">
                  <div class="close">
                    <i id="close" class="fas fa-times"></i>
                  </div>
                  <div class="content">
                  
                  </div>
                  

              </div>
              
              
            <script src="js/fetchTemplate.js"></script>
            <script src="js/users.js"></script>
            <script src="js/enrollment.js"></script>
            <script>
                
                const enrollment = new Enrollment();
                const users = new Users();
                const fullScreeen = document.querySelector(".full-screeen");
                const  popupUserDetails = document.querySelector(".popup-user-details");

                enrollment.sessionKey = `<?php
         
                    $userModule = new UserModule;   
                    echo $userModule::$sessionKey;

                 ?>`  
                enrollment.updateConnectionUser();
                const logoutButton  = document.querySelector("#logout");

                logoutButton.addEventListener('click',async function() {    
                    
                    await enrollment.logout();
                    location.reload();
                    
                });

                const listUsers  = document.querySelector(".list-users");

                listUsers.addEventListener('click', function(event) { 

                    const isClikcUser = event.target.closest(".user");
                      
                    if(isClikcUser){ 
                        users.getSpecificUser(isClikcUser);
                        fullScreeen.style.display = "block";
                        popupUserDetails.style.display = "block";
                    } 
                    
                });
                const closeUserDetals = document.querySelector("#close");
                closeUserDetals.addEventListener('click', function() {    
                    
                    fullScreeen.style.display = "none";
                    popupUserDetails.style.display = "none"
                    
                    
                });

                users.getListUsers()

            </script>
            <?php
        }

    }

?>

