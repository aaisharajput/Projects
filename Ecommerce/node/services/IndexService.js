import { read_file } from "./UserDB.js";
import sendEmail from "./mailService.js";
import jwt from 'jsonwebtoken';
const secretKey="secretKey";
function generateToken(user) {
    const userDetails={username:user.username,email:user.email,login:user.login};
  const token = jwt.sign(userDetails,secretKey, process.env.JWT_SECRET_KEY, {
     expiresIn: "2h", // expires in 2 hours
  });

  userDetails.token=token;
  return userDetails;
}
// req.headers["x-access-token"]
export const auth=(req,res)=>{
    const token = req.body.token;
    if (!token) {
        return res.status(403).send("A token is required for authentication");
      }

      try {
        const decoded = jwt.verify(token, process.env.JWT_SECRET_KEY);
        req.user = decoded;
      } catch (err) {
        return res.status(401).send("Invalid Token");
      }

      return next();
}

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
   const login=req.body.login;
    if(login)next();
    else{
        res.status(401).json({token:'',login:false});
    }
    // if(req.session.islogin)
    //     next();
    // else if(req.session.isloginAdmin){
    //         res.redirect("/admin")
    // }else{
    //     res.render("index",{login:false});
    // }
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
            if(err) res.status(401).json("Error Occured!! "+err);
            else{
                if(result.length==0){
                    
                    let user=req.body.user,pswd=req.body.pwd;
        
                    sql=`insert into user_pswd(user_id,user,email,pwd,verified) values(9,'${user}','${email}','${pswd}',0)`;
                    
                    read_file(res,sql,(err,result)=>{
                        if(err)res.status(401).json("Error Occured!! "+err);
                        else{

                            const userDetails={username:user,email:email,login:false};
                            const token=generateToken(userDetails);
                            req.user=token;
                            send_mail(req,res,token,next);
                        }
                            
                    })
                }
                else{
                    res.status(401).json({message:"Account already exist!!"});               
                }
            }
            
        });
    }
    
    //done sendmail
    export const log_in=(req,res,next)=>{
     
        let email=req.body.username;
        let pswd=req.body.password;
        let sql=`select * from user_pswd where email='${email}'`;
        read_file(res,sql,(err,result)=>{
            if(err)res.json({message:"Error Occured!! "+err});
            else{
                if(result.length==0){
                    // res.json({message:"Email is not registered, signup first"});
                    res.status(400).json({token:'',login:false});
                }else if(result[0].verified){
                    if(result[0].pwd!=pswd){
                        res.json({message:"incorrect password!!"});
                    }else{
                        if(result[0].user_id==1685421868905){
                            req.session.isloginAdmin=true;
                            req.session.user=result[0];
                            res.json("/admin");
                        }else{
                            req.session.user=result[0];
                            const userDetails={username:result[0].user,email:result[0].email,login:true};
                            const token=generateToken(userDetails);
                            req.user=token;
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
        sendEmail.sendMail(req.body.email,token.token,(err)=>{
            if(err){
                // res.render("signup",{message:"Something went wrong. Verification process stopped."}); 
                res.json({message:"Something went wrong. Verification process stopped.",login:false}); 
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
