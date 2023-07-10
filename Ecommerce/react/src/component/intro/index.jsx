import styles from './style.module.css'
import item1 from '../img/item1.jpg'
import item2 from '../img/item2.jpg'
import item3 from '../img/item3.jpg'
import item4 from '../img/item4.jpg'

export default function IntroProduct(){
    
    return(
        <div id="carouselControls" className={` ${styles.carousel} carousel slide`} data-ride="carousel">
        <div className="carousel-inner">
          <div className="carousel-item active">
            <img className="d-block w-100" src={item1} alt="First slide" />
          </div>
          <div className="carousel-item">
            <img className="d-block w-100" src={item2} alt="Second slide" />
          </div>
          <div className="carousel-item">
            <img className="d-block w-100" src={item3} alt="Third slide" />
          </div>
          <div className="carousel-item">
            <img className="d-block w-100" src={item4} alt="Third slide" />
          </div>
        </div>
        <a className="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
          <span className="carousel-control-prev-icon" aria-hidden="true"></span>
          <span className="sr-only">Previous</span>
        </a>
        <a className="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
          <span className="carousel-control-next-icon" aria-hidden="true"></span>
          <span className="sr-only">Next</span>
        </a>
      </div>
    )
}
