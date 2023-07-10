
export const redirectHome=(req,res)=>{
    // res.redirect("/home");
    const user=req.user;
    console.log(user);
    res.status(200).json(user);
}

export const renderHome=(req,res)=>{
    res.status(200).json({token:req.body.token,login:true});
    // res.render("index",{login:true,user:req.session.user.user});
}

export const authCheck=(req,res)=>{
    res.status(200).send("Authorized");
}

export const verifyNow=(req,res)=>{
    // res.render("verify_first",{msg:""});
    req.user.login=false;
    console.log("req user ",req.user);
    
    res.status(201).json(req.user);
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