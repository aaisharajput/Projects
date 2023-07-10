import express from "express";
import session from "express-session";
import cors from 'cors';

import {UsersRoute} from "./Routes/UsersRoute.js";
import {IndexRoutes} from "./Routes/IndexRoutes.js";
// import {AdminRoutes} from "./Routes/AdminRoutes.js";
// import {NotFound} from "./Routes/NotFound.js";
const app = express();
const port = 3000;
app.use(express.static('./img'));
app.use(express.static('./'));
app.use(express.static('./codes'));

app.use(cors());
app.use(express.json());
app.set('view engine','ejs');
app.use(express.urlencoded({extended:true}));
app.use(session({secret:"code Quotient",resave:false,saveUninitialized:true}));


app.get("/",(req,res)=>{
    // res.send("Welcome!!");
    if(!req.session.isLoggedin){
        res.status(401).send("Unauthorized");
        return;
    }
})


app.post("/logout",(req,res)=>{
    // if(req.body.username=="Sapna@gmail.com" && req.body.password=="0lelplR"){
       
        res.status(200).json({token:'',login:false});
    
})

app.use('/',IndexRoutes);
app.use('/user',UsersRoute);
// app.use('/admin',AdminRoutes);
// app.use('/not_found',NotFound);

app.listen(port,()=>{console.log("port no.: ",port);});

