import styles from './style.module.css'

export default function VerifyMsg(){
    
    return(
        <div className={`${styles.container} container text-center`}>
        <div className="row">  
            <div className="col-12"><h1 className={styles.h1}>Verify Account</h1></div>
            <div className="col-12"><h1 className={styles.h1}>{/*<%= msg %>*/}</h1></div>
            <div className="col-12"><h2>Link is send on your email.</h2></div>
            <div className="col-12"><h2>Click to verify your account.</h2></div>  
        </div>
    </div>
    )
}
