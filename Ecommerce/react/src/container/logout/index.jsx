import React, { useEffect } from "react";
import { Navigate } from "react-router-dom";
import {logout} from '../../../api/endpoints';

export default function Logout(){
    // useEffect(function(){
    //     logout();
    //     <Navigate to='/login' />
    // },[])
    
    //  function onLogoutPress(){
    //    const result=  logout()
    //    console.log(result)
    //    if(result.status!==200)
    //     console.log("invalid")
    //    else{
    //     console.log("logout successfully!!")
        
    //    }
        
    // }
    logout();
    return(
        <Navigate to='/login' />
    )
}

