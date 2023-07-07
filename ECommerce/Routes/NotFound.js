import express from "express";
const Router=express.Router();

Router.get("/",(req,res)=>{res.render("page_not_found");})

export {Router as NotFound};