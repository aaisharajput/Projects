import styles from './style.module.css'
import Footer from '../footer';

export default function Cart(){
    
    return(
        <div className="container-fluid">
   <div className="row pt-5 pl-5 pt-3">
      <div className="col-12 col-md-12">
         <h3><a href="/"><i className={`${styles.i} fa-sharp fa-solid fa-arrow-left text-dark`}></i></a><span className={styles.myCart}>My Cart</span></h3>
      </div>
   </div>
   <div className="row pl-5 pr-5 pb-5" id="addProducts">
      

   </div>
   <div className="row" style={{backgroundColor: '#f3edf6'}}>
      <div className="col text-center p-3 d-flex justify-content-around" >
          <h4><b>Payment Details</b></h4>
          <h5>Items: <span id="item"></span></h5>
          <h5>Total amount: Rs. <span id="amount"></span></h5>
         <button id="rzp-button1" className={`btn ${styles.pay}`}>Pay Now</button>
      </div>
  </div>
    <Footer/>
  </div>
    )
}




//    <script type="text/javascript">
//       function preback(){ window.history.forward();}
//       setTimeout("preback()",0);
//       window.onunload = function() {null};
//   </script>

<body>
  
  <script src="/cart.js"></script>
  <script src="/payment.js"></script>
</body>

