import express from "express";
const Router=express.Router();

import {chkAuthenticationIndex,chkAuthenticationLogin,chkAuthenticationSignup,log_in,sign_up,verify_token,verify_email,
    changePswdforgot,forgotPswd} from "../services/IndexService.js";
import {redirectHome,renderHome,verifyNow,changePswd,renderLogin,renderChangePswd,renderForgotPswd} from "../Controllers/IndexController.js";
// import {render404} from "../Controllers/MutualController.js";

Router.get("/",redirectHome); 

Router.route("/home").get(chkAuthenticationIndex,renderHome)
.post(chkAuthenticationIndex,renderHome)

Router.route("/login").post(log_in,redirectHome)
.get(chkAuthenticationLogin,redirectHome);

Router.route("/signup").get(chkAuthenticationSignup,redirectHome)
.post(sign_up,verifyNow);

Router.get("/verifymail/:token",verify_token,redirectHome)

Router.get("/forgetmail/:email",verify_email,changePswd)

Router.route("/change_password_forgot").get(renderLogin)
.post(changePswdforgot,renderChangePswd);

Router.route("/forgot_password").get(renderForgotPswd)
.post(forgotPswd,renderForgotPswd);

// Router.get("*",render404);

export {Router as IndexRoutes};