import { read_file } from "./UserDB.js";
import sendEmail from "./mailService.js";


export const chkAuthenticationLogin=(req,res,next)=>{
    if(req.session.islogin){
        next();
        return;
    }else if(req.session.isloginAdmin){
        res.redirect("/admin")
    }else{
        res.render("login",{message:""});
    }
}            

export const chkAuthenticationIndex=(req,res,next)=>{
    if(req.session.islogin)
        next();
    else if(req.session.isloginAdmin){
            res.redirect("/admin")
    }else{
        res.render("index",{login:false});
    }
}   

export const chkAuthenticationSignup=(req,res,next)=>{
    if(req.session.islogin)
        next();
    else if(req.session.isloginAdmin){
            res.redirect("/admin")
    }else
        res.render("signup",{message:""}); 
}  


//done sendmail
export const sign_up=(req,res,next)=>{
    let email=req.body.email;
    let sql=`select * from user_pswd where email='${email}'`;
        read_file(res,sql,(err,result)=>{
            if(err) res.send("Error Occured!! "+err);
            else{
                if(result.length==0){
                    let token=Date.now();
                    
                    let user=req.body.user,pswd=req.body.pwd;
        
                    sql=`insert into user_pswd values(${token},'${user}','${email}','${pswd}',0)`;
                    
                    read_file(res,sql,(err,result)=>{
                        if(err)res.send("Error Occured!! "+err);
                        else
                            send_mail(req,res,token,next);
                    })
                }
                else{
                    res.render("signup",{message:"Account already exist!!"});               
                }
            }
            
        });
    }
    
    //done sendmail
    export const log_in=(req,res,next)=>{
     
        let email=req.body.email;
        let pswd=req.body.pwd;
        let sql=`select * from user_pswd where email='${email}'`;
        read_file(res,sql,(err,result)=>{
            if(err)res.render("login",{message:"Error Occured!! "+err});
            else{
                if(result.length==0){
                    res.render("login",{message:"Email is not registered, signup first"});
                }else if(result[0].verified){
                    if(result[0].pwd!=pswd){
                        res.render("login",{message:"incorrect password!!"});
                    }else{
                        if(result[0].user_id==1685421868905){
                            req.session.isloginAdmin=true;
                            req.session.user=result[0];
                            res.redirect("/admin");
                        }else{
                            req.session.islogin=true;
                            req.session.user=result[0];
                            next();
                            return;
                        }
                                           
                    } 
                }else{
                    send_mail(req,res,result[0].user_id,()=>{
                        res.render("verify_first",{msg:"You not verified your email."});
                    });
                }
            }
        })
    }
    
    //done common
    export const send_mail=(req,res,token,next)=>{
        sendEmail.sendMail(req.body.email,token,(err)=>{
            if(err){
                res.render("signup",{message:"Something went wrong. Verification process stopped."}); 
            }else{
                next();
                return;
            }
            
        });
    }

//done
export const verify_token=(req,res,next)=>{
    let {token} =req.params;
          token=parseInt(token);
    let sql=`select * from user_pswd where user_id=${token}`;
        read_file(res,sql,(err,result)=>{
          if(err) res.send("Error Occured!! "+err);
          else{
            if(result.length==0){
                res.send("User not found");
            }else{
                req.session.islogin=true;
                req.session.user=result[0];
                req.session.verified=true;
    
                sql=`update user_pswd set verified=1 where user_id=${token}`;
                
                read_file(res,sql,(err,result)=>{
                    if(err) res.send("Error Occured!! "+err);
                    else{
                        next();
                        return;
                    }
                })
            }
          }  
            
        });
        
    }
    

    
//done
export const verify_email=(req,res,next)=>{
    const {email} =req.params;
    let sql=`select * from user_pswd where email='${email}'`;
    read_file(res,sql,(err,details)=>{
        if(err)res.send("Error Occured!! "+err);
        else{
            if(details.length==0){
                res.send("User not found!!");
            }else{
                next();
            }
        }
    });
}

//done
export const changePswdforgot=(req,res,next)=>{
    pswd_chng_forgot(req,res,()=>{
        let email=req.body.email;
        let pswd=req.body.pwd;
        let sql=`update user_pswd set pwd='${pswd}' where email='${email}'`;
        read_file(res,sql,(err,data)=>{
            if(err)res.render("change_pswd",{change_msg:"Error Occured!! "+err,email:"",route:'1'});
            else{
                next();
                return;
            }
        })

    });
}

//done
export const pswd_chng_forgot=(req,res,callback)=>{
    sendEmail.pswdChangedMail(req.body.email,(err)=>{
        if(err){
            res.render("change_pswd",{change_msg:err,email:"",route:'1'});
        }else{
            callback();
        }
        
    });
}



//done
export const forgotPswd=(req,res,next)=>{
    let email=req.body.email;
    let sql=`select * from user_pswd where email='${email}'`;
    read_file(res,sql,(err,data)=>{
      if(err) res.render("forgot_pswd",{change_msg:"",err_msg:"Error Occured!! "+err});
      else{
        if(data.length!=0){
            sendEmail.pswdForgotMail(email,(err)=>{
                if(err){
                    res.render("forgot_pswd",{change_msg:"",err_msg:err});
                }else{
                    next();
                    return;
                }
            })
        }else{
            res.render("forgot_pswd",{change_msg:"",err_msg:"Email is not registered. Signup First."})
        }
      }  
    })
}
