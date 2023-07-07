export const emptyProduct=(req,res)=>{
    res.json({msg:0,err:"No more Products!!"});
}

export const renderChangePswd=(req,res)=>{
    if(req.method == 'POST'){
        res.render("change_pswd",{change_msg:"Password Successfully Changed.",email:"",route:''});
    }else{
        res.render("change_pswd",{change_msg:"",email:"",route:''});
    }
}

export const renderCart=(req,res)=>{
    res.render("cart",{login:true,user:req.session.user.user});
}

export const cartResponse=(req,res)=>{
    if(req.method == 'POST'){
        res.json({str:"Added"});
    }else{
        res.json({"redirect":"/home"});
    }
}

export const redirectLogout=(req,res)=>{
    if(req.method == 'POST'){
        req.session.destroy();
        res.redirect("/");
    }else{
        res.redirect("/home");
    }
}
