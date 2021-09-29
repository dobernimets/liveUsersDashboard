async function fetchTemplate(request) {
    
    let options = {};
    const { url, method } = request; 
    
    if(method != "GET"){
        options = {
            headers: {
                'Content-Type': 'application/json'
                    
            },
            body: JSON.stringify(request.data) 
        }
    }
    options.method = method;

    const response = await fetch(url, options);

    // const { url, method, data } = request;
    
    // // Default options are marked with *
    // const response = await fetch(url, {
    //     method: method, 
    //     // mode: 'cors', 
    //     // cache: 'no-cache', 
    //     // credentials: 'same-origin', 
    //     headers: {
    //         'Content-Type': 'application/json'
                
    //     },
    //     // redirect: 'follow', 
    //     // referrerPolicy: 'no-referrer', 
    //     body: JSON.stringify(data) 
    // });

    return  response.json();// parses JSON response into native JavaScript objects
}