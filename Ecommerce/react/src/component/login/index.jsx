import styles from './style.module.css'

export default function Login(props){
    const {msg,value,onChange,onClick,pswd,onChangePswd}=props;

    // function verify(){
    // } 
    return(
        
        <div className="container">
        <div className="row d-flex justify-content-center pt-5 mt-5 pb-4">
                <h1 className={styles.h1}>LOGIN FORM</h1>
        </div>
        <div className="row d-flex justify-content-center">
        {/* <form  method="post" onSubmit={verify()} action="/login" className="form p-5 text-center"> */}
        <form className={`${styles.form} p-5 text-center`}>
            <div className="form-group form-inline pt-4">
                <label htmlFor="email">Email:</label>
                <input type="email" value={value} onChange={onChange} className="form-control ml-5" name="email" placeholder="Enter email" id="email" required />
            </div>
            <div className="form-group form-inline pt-4">
                <label htmlFor="pwd">Password:</label>
                <input type="password" value={pswd} onChange={onChangePswd} className="form-control ml-4" name="pwd" placeholder="Enter password" id="pwd" required />
                <i className={`${styles.i} fa-sharp fa-solid fa-eye pl-3`} id="eye"></i>
            </div>
                    
            <a className={styles.a} href="/signup">New Member? Singup</a><br />
            <button onClick={onClick} className={`${styles.btn} pl-5 pr-5 mt-4 w-100`} id="login_btn"> Login</button><br/><br/>
            <a className={styles.a} href="/forgot_password">Forgot Password?</a><br />
            <p style={{color:'rgb(25, 243, 18)'}} className="pt-3" id="wrong">{msg}</p>
        </form>   
        </div>
        </div>
        
    )
}
