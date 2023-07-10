// import {Home} from '../src/container/home'

export async function home(){
    let result=localStorage.getItem('tokenDetails');
        result=JSON.parse(result);
        
        const payload={
            token:result.token,
            login:result.login,
        };

    const response =await fetch('http://localhost:3000/',{
    method:"GET",  
    headers:{
        "Content-Type":"application/json",
    },
    body:JSON.stringify(payload),  
    })

    let rsult = await response.text();

    localStorage.setItem('tokenDetails',rsult);
    rsult=JSON.parse(rsult);
    console.log("route")
    // if(rsult.login){
    //     <Home login={true}/>
    // }else{
    //     <Home login={false}/>
    // }
 
        
    // return {
    //     status:response.status,
    //     result,
    // };
} 

export async function login(data){
    // const navigate = useNavigate();
    const payload={
        username:data.username,
        password:data.password,
    };
    const response =await fetch('http://localhost:3000/login',{
    method:"POST",    
    headers:{
            "Content-Type":"application/json",
        },
        body:JSON.stringify(payload),
    })
    let result = await response.text();
    // result=JSON.parse(result);
    // console.log("login",result,result.token,result.login)
    localStorage.setItem('tokenDetails',result);
    result=JSON.parse(result);
    // if(result.login){
    //     navigate('/user/cart');
    // }
    return {
        status:response.status,
        result,
    };
} 

export async function checkAuth(){
    try{
        let result=localStorage.getItem('tokenDetails');
        result=JSON.parse(result);
        
        const payload={
            token:result.token,
            login:result.login,
        };
        console.log(payload)

        const response =await fetch('http://localhost:3000/checkAuth',{
            method:"POST", 
            headers:{
                "Content-Type":"application/json",
            },
            body:JSON.stringify(payload),
        });
        // console.log('resss ',response.status)
        return response.status;
    }catch(e){
        console.log(e);
    }
   
}

export async function signup(data){
    const payload={
        user:data.username,
        email:data.email,
        pwd:data.password
    };

    const response =await fetch('http://localhost:3000/signup',{
    method:"POST",    
    headers:{
            "Content-Type":"application/json",
        },
        body:JSON.stringify(payload),
    })
    let result = await response.text();
    localStorage.setItem('tokenDetails',result);
    result=JSON.parse(result);
    console.log("signup ",result)
    
    return {
        status:response.status,
        result,
    };
} 

export function logout(){
    localStorage.removeItem("tokenDetails");
} 

export async function fetchProduct(counter){
    const payload={
        counter:counter
    };
    const response =await fetch('http://localhost:3000/user/getdetails',{
    method:"POST",  
    headers:{
        "Content-Type":"application/json",
    },
    body:JSON.stringify(payload),  
    })
    const result = await response.json();
    // console.log("product ",result)
    //result=JSON.parse(result);
    return result;
} 

export async function fetchSingleProduct(counter){
    const payload={
        counter:counter
    };
    const response =await fetch('http://localhost:3000/user/single_product',{
    method:"POST",  
    headers:{
        "Content-Type":"application/json",
    },
    body:JSON.stringify(payload),  
    })
    let result = await response.text();
    // console.log("product ",result)
    result=JSON.parse(result);
    return result;
} 

export async function changePassword(counter){
    const payload={
        counter:counter
    };
    const response =await fetch('http://localhost:3000/user/change_password',{
    method:"POST",  
    headers:{
        "Content-Type":"application/json",
    },
    body:JSON.stringify(payload),  
    })
    let result = await response.text();
    // console.log("product ",result)
    result=JSON.parse(result);
    return {
        result,
    };
} 

export async function cartItems(counter){
    const payload={
        counter:counter
    };
    const response =await fetch('http://localhost:3000/user/cart',{
    method:"POST",  
    headers:{
        "Content-Type":"application/json",
    },
    body:JSON.stringify(payload),  
    })
    let result = await response.text();
    // console.log("product ",result)
    result=JSON.parse(result);
    return {
        result,
    };
} 

export async function userDetail(counter){
    const payload={
        counter:counter
    };
    const response =await fetch('http://localhost:3000/user/user_detail',{
    method:"POST",  
    headers:{
        "Content-Type":"application/json",
    },
    body:JSON.stringify(payload),  
    })
    let result = await response.text();
    // console.log("product ",result)
    result=JSON.parse(result);
    return {
        result,
    };
} 

export async function AddToCart(counter){
    const payload={
        counter:counter
    };
    const response =await fetch('http://localhost:3000/user/addToCart',{
    method:"POST",  
    headers:{
        "Content-Type":"application/json",
    },
    body:JSON.stringify(payload),  
    })
    let result = await response.text();
    // console.log("product ",result)
    result=JSON.parse(result);
    return {
        result,
    };
} 

export async function IncDescItems(counter){
    const payload={
        counter:counter
    };
    const response =await fetch('http://localhost:3000/user/plus_minus_product',{
    method:"POST",  
    headers:{
        "Content-Type":"application/json",
    },
    body:JSON.stringify(payload),  
    })
    let result = await response.text();
    // console.log("product ",result)
    result=JSON.parse(result);
    return {
        result,
    };
}

export async function DeleteProducts(counter){
    const payload={
        counter:counter
    };
    const response =await fetch('http://localhost:3000/user/delete',{
    method:"POST",  
    headers:{
        "Content-Type":"application/json",
    },
    body:JSON.stringify(payload),  
    })
    let result = await response.text();
    // console.log("product ",result)
    result=JSON.parse(result);
    return {
        result,
    };
}