<?php session_start();
 
     require_once('php/code.php');
      include'select_lang.php';
    $msg="";
    $Prp=new clsUserPrp();
    $Prp->P_email= $_SESSION['email'];
    $rand_otp=$_SESSION['rand_otp'];
    

    if (isset($_POST['check'])) {
        $otp=$_POST['otp'];
       if($rand_otp==$otp){

            $FunObj=new clsUser();
            $result=$FunObj->UserExist($Prp);
            if ($result) {
                $data=array();

               foreach ($result as $data) {
                  $u_id=$data['u_id'];
                 }
                $_SESSION['u_id']=$u_id;
                header("Location:newpswd.php?lang=$set_lang");
            }else{
                 $msg=$lang['not_fetch'];
            }
       }else{
              $msg=$lang['correct_otp'];
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
                <form  method="POST" autocomplete="off">
                    <h2 class="text-center"><?php echo $lang['code']; ?></h2>
                       
                      
                  <?php if($msg){ ?>
                       <div class="alert alert-danger text-center">
                           <?php echo $msg; ?><?php echo $msg=""; ?>
                        </div>
                        <?php }else{
                            ?>
                       <div class="alert alert-success text-center">
                         <?php echo $lang['send_email']; ?>
                        </div>
                        <?php } ?>
 
                    <div class="form-group">
                        <input class="form-control" type="tel" name="otp" placeholder="<?php echo $lang['enter_vc']; ?>" required>
                    </div>
                    <div class="form-group">
                       <input class="form-control button" type="submit" name="check" value="<?php echo $lang['submit']; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>