import express from "express";
const Router=express.Router();
import {loadMoreProduct,redirectLogin,changePswd,cardItems,addProductToCart,plusMinusProduct,deleteProduct,userDetails} from "../services/UserService.js";
import {emptyProduct,renderChangePswd,renderCart,cartResponse,redirectLogout} from "../Controllers/UserController.js";
import {singleProduct} from "../services/mutualService.js";
// import {render404} from "../Controllers/MutualController.js";

Router.post("/getdetails",loadMoreProduct,emptyProduct);

Router.post("/single_product",singleProduct);

Router.route("/change_password").get(redirectLogin,renderChangePswd)
.post(changePswd,renderChangePswd);


Router.route("/cart").get(redirectLogin,renderCart)
.post(cardItems);

Router.post("/user_detail",redirectLogin,userDetails)

Router.route("/addToCart").get(cartResponse)
.post(addProductToCart,cartResponse)

Router.route("/plus_minus_product").get(cartResponse)
.post(plusMinusProduct,cartResponse)

Router.post("/delete",deleteProduct)

Router.route("/logout").post(redirectLogout)
.get(redirectLogout);

// Router.get("*",render404);
export {Router as UsersRoute};