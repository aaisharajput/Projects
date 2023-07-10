import React from "react";
import SignIn from '../../component/login';
import {login} from '../../../api/endpoints';
import { useNavigate } from "react-router-dom";

export default function Login(){
  const navigate=useNavigate();
    const [userDetails,setUserDetails]=React.useState({
        username:"sapnadevi.1610a@gmail.com",
        password:"Sapna@123",
    })
    const [errorMsg,setErrorMsg]=React.useState('');

    const {username,password}=userDetails
    //higher order function
    function onInputChange(key){
        return function(event){
            setUserDetails({
                ...userDetails,[key]:event.target.value
            })
        }
    }
    
  async  function verify(event){
        event.preventDefault();
        if(password==""||username==""){
            setErrorMsg("Empty field is not allowed!!");
        }else if(password.trim()==""||username.trim()==""){
          setErrorMsg("Space is not allowed!!");
          }
          else if(password.length<8){
            setErrorMsg("Password should be 8 or more characters!!");
            console.log("msg: ",errorMsg);
          }else{ 
            setErrorMsg("");
           await onLoginPress();
          }
    }

    async function onLoginPress(){
       const result= await login(userDetails)
       console.log(result)
       if(result.status!==200)
        console.log("invalid")
       else{
        navigate('/');
       }
        //  props.onLogin();
        // AuthApi(userDetails)
    }

    return(
      <>
         <SignIn msg={errorMsg} value={username} pswd={password} onChange={onInputChange("username")} onChangePswd={onInputChange("password")} onClick={verify}/>   
      </>
    )
}

