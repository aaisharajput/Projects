import React, { useEffect, useState } from "react";
// import {Routes,Route,useNavigate} from 'react-router-dom';
import Home from "../../component/home";
import { fetchProduct } from "../../../api/endpoints";

export default function index() {
	const [productDetails, setproductDetails] = React.useState([]);
	const [count, setCount] = React.useState(6);

	useEffect(function () {
		onMorePress();
	}, [setCount]);

	async function onMorePress() {
		const newProducts = await fetchProduct(count);
		if (newProducts) {
			setproductDetails([...productDetails, ...newProducts]);
			setCount(count + 6);
		}
	}
console.log(count)
	console.log("received ",productDetails);

	return <Home onClick={onMorePress} products={productDetails} />;
}
