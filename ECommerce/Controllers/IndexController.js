
export const redirectHome=(req,res)=>{
    res.redirect("/home");
}

export const renderHome=(req,res)=>{
    res.render("index",{login:true,user:req.session.user.user});
}

export const verifyNow=(req,res)=>{
    res.render("verify_first",{msg:""});
}

export const changePswd=(req,res)=>{
    const {email} =req.params;
    res.render("change_pswd",{change_msg:"",email:email,route:'1'});
}

export const renderLogin=(req,res)=>{
    res.redirect("/login",{message:""});
}

export const renderChangePswd=(req,res)=>{
    res.render("change_pswd",{change_msg:"Password Successfully Changed.",email:"",route:'1'});
}

export const renderForgotPswd=(req,res)=>{
    if(req.method == 'POST'){
        res.render("forgot_pswd",{change_msg:"Link is send on your registered email to change the password.",err_msg:""});
    }else{
        res.render("forgot_pswd",{change_msg:"",err_msg:""});
    }
}