import express from "express";
const Router=express.Router();
import multer from "multer";
const storage=multer.diskStorage({
                    destination: function (req, file, callback) {
                        callback(null, './img/');
                    },
                    filename: function (req, file, callback) {
                        callback(null, file.originalname);
                    }
});
const upload=multer({storage:storage})

import {loadAdminProduct,deleteAdminProduct,updateAdminProduct,addAdminProduct,chkAdmin} from "../services/AdminService.js";
import {login_msg,add_msg,update_msg,logoutAdmin} from "../Controllers/AdminController.js";
import {singleProduct} from "../services/mutualService.js";
// import {render404} from "../Controllers/MutualController.js";

Router.route("/").get(chkAdmin,login_msg)
.post(loadAdminProduct);

Router.post("/single_product",singleProduct);

Router.post("/admin_product",loadAdminProduct);

Router.route("/adminlogout").post(logoutAdmin)
.get(logoutAdmin);

Router.post("/admin_delete",deleteAdminProduct);

Router.post("/admin_update_product",upload.single("img"),updateAdminProduct,update_msg);

Router.post("/new_product",upload.single("img"),addAdminProduct,add_msg)

// Router.get("*",render404);

export {Router as AdminRoutes};