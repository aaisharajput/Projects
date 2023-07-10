import styles from './style.module.css'
import Footer from '../footer';
import Intro from '../intro';
import Item from '../items';

export default function Home(props) {
	const { onClick, products } = props;

	return (
		<>
			<div className="container-fluid">
				<div className="row pl-5 pt-3">
					<div className="col-2 col-md-2"><p className={styles.p}>Category 1</p></div>
					<div className="col-2 col-md-2"><p className={styles.p}>Category 2</p></div>
					<div className="col-2 col-md-2"><p className={styles.p}>Category 3</p></div>
					<div className="col-2 col-md-2"><p className={styles.p}>Category 4</p></div>
					<div className="col-2 col-md-2"><p className={styles.p}>Category 5</p></div>
					<div className="col-2 col-md-2"><p className={styles.p}>Category 6</p></div>
				</div>
				<section className="item_list">
					<div className="row pt-1 pb-4">
						<Intro />
					</div>
					<div className={`row pt-5 ${styles.title}`}>
						<h3>Products You Love It.</h3>
					</div>
					<div className="row d-flex justify-content-center text-center pl-5 pb-5 pr-5" >
					<Item products={products}/>
					
					</div>

					<div className="add_items" id="add_items">
						<div className={`row ${styles.title}`}>
							<h3>More Products</h3>
						</div>
					</div>
					<div className="row  d-flex justify-content-center" id="empty" style={{ color: 'red' }}>
						<p></p>
					</div>
					<div className="row  d-flex justify-content-center p-4">
						<button className={`btn ${styles.load}`} onClick={onClick} id="load_more">Load more products</button>
					</div>
				</section>

				<Footer />
				{/* <script src="items.js"></script> */}
			</div>
		</>
	)
}

