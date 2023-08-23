<?php session_start();
 
     require_once('../php/code.php');
    include'../select_lang.php';
    $pswd="";
    $u_id= $_SESSION['u_id'];
    $msg="";
    $err="";
   
    if (isset($_POST['change-password'])) {
            $n_pswd=$_POST['password'];
             $c_pswd=$_POST['cpassword'];
            $o_pswd=md5($_POST['old-password']);
           $FunObj=new clsUser();

          $result=$FunObj->GetUserDetail($u_id);
          if ($result) {
               $data=array();

                foreach ($result as $data) {
                   $pswd=$data['pswd'];
                 }
            
         }else{
              $err=$lang['txt91'];
         }
  
        
   if ($pswd==$o_pswd) {
       
        if ($n_pswd==$c_pswd) {
           
          $Prp=new clsUserPrp();
          $Prp->P_pswd=md5($n_pswd);

          $FunObj=new clsUser();

         $change=$FunObj->ChangePswd($Prp,$u_id);
         if ($change) {
             $msg=$lang['txt92'];
         }else{
            $err=$lang['pswd_not_change'];
         }
       }else{
             $err= $lang['confirm_not_match'];
       }
   }else{
        $err=$lang['txt95'];
   }

 } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include'../links/links.php'; ?>
    <link rel="stylesheet" href="css/new-pswd.css">
</head>
<body>
	 <?php include'title_bar.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 form">
                <form action="" method="POST" autocomplete="off">
                    <h2 class="text-center"><?php echo $lang['txt10']; ?></h2>
                    
                         <?php if($msg){ ?>
                       <div class="alert alert-success text-center">
                           <?php echo $msg; ?><?php echo $msg=""; ?>
                        </div>
                        <?php }
                            ?>
                            <?php if($err){ ?>
                       <div class="alert alert-danger text-center">
                           <?php echo $err; ?><?php echo $err=""; ?>
                        </div>
                        <?php }
                            ?>
                      <div class="form-group">
                        <input class="form-control" type="text" name="old-password" placeholder="<?php echo $lang['txt93']; ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="<?php echo $lang['txt94']; ?>" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="<?php echo $lang['txt96']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="<?php echo $lang['change']; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer>
  <h6><div class="lang_btn">
     <?php echo $lang['lang']; ?>: <a href="new-pswd.php?lang=en">EN | </a><a href="new-pswd.php?lang=hi">हिन्दी</a><a href="new-pswd.php?lang=ur"> | اردو</a>
   </div></h6>
</footer>
</body>
</html>