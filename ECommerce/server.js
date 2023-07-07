import express from "express";
import session from "express-session";

import {UsersRoute} from "./Routes/UsersRoute.js";
import {IndexRoutes} from "./Routes/IndexRoutes.js";
import {AdminRoutes} from "./Routes/AdminRoutes.js";
import {NotFound} from "./Routes/NotFound.js";
const app = express();
const port = 3000;
app.use(express.static('./img'));
app.use(express.static('./'));
app.use(express.static('./codes'));


app.use(express.json());
app.set('view engine','ejs');
app.use(express.urlencoded({extended:true}));
app.use(session({secret:"code Quotient",resave:false,saveUninitialized:true,}));

app.use('/',IndexRoutes);
app.use('/user',UsersRoute);
app.use('/admin',AdminRoutes);
app.use('/not_found',NotFound);

app.listen(port,()=>{console.log("port no.: ",port);});