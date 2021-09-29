class Users{
     getListUsers(){
        const request = {  

            url:"PHP/endPoints/usersList.php",
            method:"GET",
                        
        }
        
        this.updateDomUsersList(request)();
        setInterval(this.updateDomUsersList(request), 3000 );
    }

     updateDomUsersList(request){
        return async function () {
            let html = "";
            const listUsers =  await fetchTemplate(request);
            if(listUsers.success.length < 1 ) return;
            const offlineIcon =  `<i  class="off fas fa-toggle-off"></i>`; 
            const onlineIcon = `<i  class="on fas fa-toggle-on"></i>`;          
            
            listUsers.success.forEach(function(user){
                html += `
                <div class="user" id="${user.id}"">
                            <div class="header">
                                <div class="name">
                                <i class="fas fa-user"></i> 
                                <div class="title">user:</div>
                                <div class="text">${user.userName}</div>        
                                </div>
                                <div class="status">
                                   ${user.status == "online" ? onlineIcon :offlineIcon}
                                </div>
                            </div>
                            <div class="item">
                                <i class="fas fa-mobile-alt"></i>
                                <span class="title">IP:</span> ${user.userIP}
                            </div>
                            <div class="item">
                                <i class="far fa-clock"></i> 
                                <span class="title">entrance time:</span> ${user.entrance_time}
                            </div>
                            <div class="item">
                                <i class="far fa-clock"></i>
                                <span class="title">last update time:</span> ${user.lastSeen}
                            </div>
                            <div class="item ">
                                <i class="fas fa-signal"></i>
                                <span class="title">status:</span><span class=" ${user.status == "online"?"green":"red"}"> ${user.status} </span>
                            </div>
                    
                        </div>`;
            });
            const viewListUsers = document.querySelector(".list-users");
            viewListUsers.innerHTML=html;
            }
        
        
    }

    async getSpecificUser(userViewDom){
        
        const request = {  

            url:"PHP/endPoints/getUserDetails.php",
            method:"POST",
            data:{id:userViewDom.id},
                            
        }
        const userDetails =  await fetchTemplate(request);

        const html = `
        <div class="title">
        <i class="fas fa-user"></i>
            User details:
            <span class="text">${userDetails.userName}</span>
        </div>
        <div class="item">
            <i class="fas fa-at"></i>
            <span class="title">email: </span><span class="text">${userDetails.email}</span> 
        </div>
        <div class="item">
            <i class="far fa-clock"></i> 
            <span class="title">entrance time: </span><span class="text">${userDetails.entrance_time}</span> 
        </div>
        <div class="item">
            <i class="far fa-clock"></i>
            <span class="title">user agent: </span><span class="text">${userDetails.userAgent}</span>
        </div>
        <div class="item ">
            <i class="fas fa-eye"></i>
            <span class="title">visit count: </span><span class="text">${userDetails.visit_count}</span>
        </div>`;

        const contentUserDetails = document.querySelector(".popup-user-details .content");
        contentUserDetails.innerHTML = html;
       debugger 
    }

}