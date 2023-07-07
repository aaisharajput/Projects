import sendEmail from "./mailService.js";
import { read_file } from "./UserDB.js";

//done

export const redirectLogin=(req,res,next)=>{
    if(req.session.islogin)
        next();
    else{
        res.redirect("/login");
    }
}

export const loadMoreProduct=(req,res,next)=>{
    let indx=req.body.counter;
    let sql=`select * from product_details limit ${indx-5}, ${indx}`;
    read_file(res,sql,(err,details)=>{
        if(err) res.json({msg:0,err:"error occured!! "+err});
        else{
            if(details.length<5){
                next();
                return;
            }else
                res.json(details);
        } 
    })
}

export const addProductToCart=(req,res,next)=>{
    if(!req.session.islogin){
        res.json({"redirect":"/login"});
    }else{
        const p_id=req.body.id;
        const token=req.session.user.user_id;
        const cart_id=Date.now();
        let sql=`Select * from cart_details where user_id=${token} and product_id=${p_id}`;
        read_file(res,sql,(err,result)=>{
            if(err) res.json({str:"Error Occured!! "+err});
            else{
                if(result.length==0){
                    sql=`insert into cart_details values(${cart_id},${token},${p_id},1)`;
                    read_file(res,sql,(err,result)=>{
                        if(err)res.json({str:"Error Occured!! "+err});
                        else{
                            next();
                            return;
                        }
                        
                    })
                }else{
                    sql=`update cart_details set quantity=quantity+1 where user_id=${token} and product_id=${p_id}`;
                    read_file(res,sql,(err,result)=>{
                        if(err)res.json({str:"Error Occured!! "+err});
                        else{
                            next();
                            return;
                        }
                    })
                }
            }
        })
    }
}

//done
export const plusMinusProduct=(req,res,next)=>{
    if(!req.session.islogin){
        res.json({"redirect":"/login"});
    }else{
        const p_id=req.body.id;
        const op=req.body.op;
        const token=req.session.user.user_id;
        let sql;
            if(op==1)
                sql=`update cart_details set quantity=quantity+1 where user_id=${token} and product_id=${p_id}`;
            else
                sql=`update cart_details set quantity=quantity-1 where user_id=${token} and product_id=${p_id}`;    
        read_file(res,sql,(err,result)=>{
            if(err) res.json({str:"Error Occured!! "+err});
            else{
                next();
                return;
            }
        })
    }
}


//done
export const cardItems=(req,res)=>{
    const token=req.session.user.user_id;
    let p=[];
    let sql=`select * from cart_details where user_id=${token}`;
    read_file(res,sql,(err,cartData)=>{
      if(err) res.json({err:"Error Occured!! "+err});
      else{
        if(cartData.length==0){
            res.json({err:''});
        }else{
            cartData.forEach((k,indx)=>{
                
               let p_id= k.product_id;
               sql=`select * from product_details where id=${p_id}`;
               read_file(res,sql,(err,productData)=>{
                if(err) res.json({err:"Error Occured!! "+err});
                else{
                    let detail=productData[0];
                    if(productData.length==0){
                        p.push({id:null,prev_id:p_id});
                    }else{
                        detail.quantity=k.quantity;
                        p.push(detail);
                    }
    
                    if(cartData.length-1==indx)
                        return res.json(p);
                }
               
               })
            })
        }
      }  
    });
}

//done
export const userDetails=(req,res)=>{
    const user=req.session.user.user;
    const email=req.session.user.email;
    res.json({"user":user,"email":email});
}

export const deleteProduct=(req,res)=>{
    const token=req.session.user.user_id;
    const p_id=req.body.id;
    let sql=`delete from cart_details where user_id=${token} and product_id=${p_id}`;
    read_file(res,sql,(err,result)=>{
        if(err)res.json(0);
        else
            res.json({"dmsg":"deleted"});
    })
}

//done pswd change
export const changePswd=(req,res,next)=>{
    
    pswd_chng_mail(req,res,()=>{
     const token=req.session.user.user_id;
     const pswd=req.body.pwd;
     let sql=`update user_pswd set pwd='${pswd}' where user_id=${token}`;
        read_file(res,sql,(err,data)=>{
            if(err)res.render("change_pswd",{change_msg:"Error Occured!! "+err,email:"",route:''});
            else{
                next();
                return;
            }
            
        })
    });
}

//done
export const pswd_chng_mail=(req,res,callback)=>{
    sendEmail.pswdChangedMail(req.session.user.email,(err)=>{
        if(err){
            res.render("change_pswd",{change_msg:err,email:"",route:''});
        }else{
            callback();
        }
        
    });
}