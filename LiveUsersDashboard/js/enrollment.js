class Enrollment{
constructor(){
    this.sessionKey = "";
}
    async login(){
      
        const { userIP, userAgent } = userDetails;
        
        const userName = document.querySelector("#userName").value;
        const email = document.querySelector("#email").value;
     

        const request = {  

            url:"PHP/endPoints/login.php",
            method:"POST",
            data:{ userName, email, userIP, userAgent },
                            
        }
        
        return await fetchTemplate(request);
    } 

    async logout(){
       
        const request = {  

            url:"PHP/endPoints/logout.php",
            method:"POST",
            data:{},
                            
        }
        
        return await fetchTemplate(request);
    }

    async updateConnectionUser(){
         
        const request = {  

            url:"PHP/endPoints/updateStatConn.php",
            method:"POST",
            data:{sessionKey:this.sessionKey},
                            
        }
        
        setInterval(()=>{
            fetchTemplate(request);
        }, 3000)
    }
}



