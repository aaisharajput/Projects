import styles from './style.module.css'
// import OwlCarousel from 'react-owl-carousel';
// import 'owl.carousel/dist/assets/owl.carousel.css';
// import 'owl.carousel/dist/assets/owl.theme.default.css';

export default function Items(props) {
    const { products } = props;
    return (
        <div className="row ">
            {products.map(function (item, i){
                return(
                    <div className="col-12 col-md-4 pt-5" key={item.id}>
                    <div className="card">
                    <div className="product_name">
                         <h5>{item.p_name}</h5>
                     </div>
                     <div className="img">
                         <img src={`../img/${item.img}`} className={styles.img} alt={item.p_name} />

                         <div className={`${styles.btnn} d-flex justify-content-around`}>
                             <input type="button" className="btn btn-success" value="Add To Cart" />
                             <button className={`${styles.btn} btn btn-success`} >View Details</button>
                         </div>

                     </div>
                    </div>
                 </div>
                )
            })}
            
        </div>
    )
}


// export default function Items(props) {
//     const { products } = props;
//     if (products != 0) {
//         //console.log("items",products[0].result[1].id)
//         //let product=products[0].result;
//         return (
//             <div className={`${styles.owlCarousel} container-fluid sliderss owl-carousel pt-5 pl-5`} id="sliderss">
//                 {products.map(function (item, i) {
//                     console.log(i, "map: ", item);
//                     <div className={`${styles.card} card item`}>
//                         <div className="product_name">
//                             <h5 id="item_name">{item.p_name}</h5>
//                         </div>
//                         <div className="img">
//                             <img src={item.img} className={styles.img} alt={item.p_name} />

//                             <div className={`${styles.btnn} d-flex justify-content-around`}>
//                                 <input type="button" onclick="add_item_cart({i})" className="btn btn-success" value="Add To Cart" />
//                                 <button className={`${styles.btn} btn btn-success`} onclick="more_details({i})">View Details</button>
//                             </div>

//                         </div>
//                     </div>

//                 })
//                 }
//             </div>
//         )
//     }

// }