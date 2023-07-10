import { read_file } from "./UserDB.js";

//done
export const singleProduct=(req,res)=>{
    let indx=req.body.id;
    let sql=`select * from product_details where id=${indx}`;
    read_file(res,sql,(err,details)=>{  
        res.json(details);
    })
}

