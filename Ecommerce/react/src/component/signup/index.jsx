import styles from './style.module.css'
import React from "react";

export default function Signup(props){

    const {msg,cnf,email,value,pswd,onChangeUser,onChangeEmail,onChangeCnf,onChangePswd,onClick}=props;
    return(
        <>
        
        {/* // <div className="container"> */}
            <div className="row d-flex justify-content-center pt-5 mt-5 pb-4">
                <h1 className={styles.h1}>SIGNUP FORM</h1>
            </div>
            <div className="row d-flex justify-content-center">    
                {/* <form  method="post" onSubmit={verify()} action="/signup" className="form p-5"> */}

                <form className={`${styles.form} p-5`}>
                    <div className="form-group form-inline mt-2">
                      <label htmlFor="user">Username:</label>
                      <input type="text" value={value} onChange={onChangeUser} className="form-control ml-3" placeholder="Enter username" name="user" id="user" required />
                    </div>
                    <div className="form-group form-inline pt-4">
                      <label htmlFor="pwd">Email:</label>
                      <input type="email" value={email} onChange={onChangeEmail} className="form-control ml-5" placeholder="Enter email" name="email" id="email" required />
                    </div>
                    <div className="form-group form-inline pt-4">
                      <label htmlFor="pwd">Password:</label>
                      <input type="password" value={pswd} onChange={onChangePswd} className="form-control ml-4" placeholder="Enter password" name="pwd" id="pwd" required />
                      <i className="fa-sharp fa-solid fa-eye pl-3" id="eye"></i>
                    </div>                    
                    <div className="form-group form-inline pt-4">
                        <label htmlFor="cnf">Confirm:</label>
                        <input type="password" value={cnf} onChange={onChangeCnf} className="form-control ml-4" placeholder="Enter confirm password" name="cnf" id="cnf" required />
                      </div>
                      <a className={styles.a} href="/login">Already have account? Login</a><br/>
                    <button onClick={onClick} className={`${styles.btn} btn pl-5 pr-5 mt-4`} id="create">Create Account</button>
                    <p style={{color:'rgb(25, 243, 18)'}} className="pt-3" id="wrong">{(msg!="")?msg:'' }</p>
                  </form>
            </div>
        {/* // </div> */}
        </>
    )
}
