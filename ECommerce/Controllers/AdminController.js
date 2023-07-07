
export const logoutAdmin=(req,res)=>{
    if(req.method == 'POST'){
        req.session.destroy();
        res.redirect("/login");
    }else{
        res.redirect("/admin");
    }
}

export const update_msg=(req,res)=>{
    res.json({msg:"Updated Successfully!!"})
}

export const add_msg=(req,res)=>{
    res.render("admin",{user:req.session.user.user,msg:"Added Successfully!!"});
}

export const login_msg=(req,res)=>{
    res.render("login",{message:"Only admin can access this page!!"});
}