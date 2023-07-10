import React from "react";
import SignUp from '../../component/signup';
import {signup} from '../../../api/endpoints';

export default function CreateAccount(props){
    const [userDetails,setUserDetails]=React.useState({
        email:"sna@gmail.com",
        password:"Sapna@123",
        username:"sapna",
        cnf:"Sapna@123"
    })

    const [errMsg,setErrMsg]=React.useState('');

    const {username,password,email,cnf}=userDetails
    //higher order function
    function onInputChange(key){
        return function(event){
            setUserDetails({
                ...userDetails,[key]:event.target.value
            })
        }
    }

    async function onLoginPress(){
       const result= await signup(userDetails)
       console.log(result)
       if(result.status!==200)
        console.log("invalid")
       else
         props.onLogin();
        // AuthApi(userDetails)
    }

    function verify_field(event){
      event.preventDefault();
        if(username==""||password==""||email==""||cnf==""){
            setErrMsg("Empty field is not allowed!!");
            
          }else if(username.trim()==""||password.trim()==""||email.trim()==""||cnf.trim()==""){
            setErrMsg("Spaces are not allowed!!");
            
          }
          else if(username.match(/\d/) || username.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]+/)){
            setErrMsg("username should have characters only!!");
            
          }else if(email.match(/^\d+/) || email.match(/[!#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]+/)){
            setErrMsg("Email is not valid!!");
            
          }
          else if(password.length<8){
            setErrMsg("*Password should have 8 or more characters!!");
            
          }else if(!password.match(/[!@#$%^&*()_+\-=\[\]{};':"\\|,<>\/?]+/)){
            setErrMsg("*Password should contain atleast one special symbols!!");
            
          }else if(!password.match(/\d/)){
            setErrMsg("*Password should contain atleast one number!!");
            
          }else if(!password.match(/[A-Z]/)){
            setErrMsg("*Password should contain atleast one Uppercase character!!");
            
          }else if(!password.match(/[a-z]/)){
            setErrMsg("*Password should contain atleast one Lowercase character!!");
            
          }
          else if(password!=cnf){
            setErrMsg("Confirm password doesn't match!!");
          }else{
            // create.disabled=true;
            setErrMsg("");
            
            onLoginPress();
          }
    }

    return(
      <>
         <SignUp msg={errMsg} value={username}  cnf={cnf} email={email} pswd={password} onChangeCnf={onInputChange("cnf")} onChangeEmail={onInputChange("email")} onChangeUser={onInputChange("username")} onChangePswd={onInputChange("password")} onClick={verify_field}/>   
      </>
    )
}
