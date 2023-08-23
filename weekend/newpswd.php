<?php session_start();
 
     require_once('php/code.php');
     include'select_lang.php';
    
    $u_id= $_SESSION['u_id'];
    $msg="";
   
    if (isset($_POST['change-password'])) {
          $n_pswd=$_POST['password'];
    $c_pswd=$_POST['cpassword'];
        if ($n_pswd==$c_pswd) {
           
          $Prp=new clsUserPrp();
          $Prp->P_pswd=md5($n_pswd);

          $FunObj=new clsUser();

         $change=$FunObj->ChangePswd($Prp,$u_id);
         if ($change) {
             header("Location:forget_login.php?lang=$set_lang");
         }else{
            $msg=$lang['pswd_not_change'];
         }
       }else{
             $msg=$lang['confirm_not_match'];
       }
    } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include'links/links.php'; ?>
    <link rel="stylesheet" href="css/forget-pswd.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 form">
                <form method="POST" autocomplete="off">
                    <h2 class="text-center"><?php echo $lang['new_pswd']; ?></h2>
                      
                  <?php if($msg){ ?>
                       <div class="alert alert-danger text-center">
                           <?php echo $msg; ?><?php echo $msg=""; ?>
                        </div>
                        <?php }
                            ?>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="<?php echo $lang['create_pswd']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="<?php echo $lang['confirm_pswd']; ?>" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="<?php echo $lang['change']; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>