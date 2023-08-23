<?php session_start();
 
     require_once('php/code.php');
      include'select_lang.php';

    $msg="";
    if (isset($_POST['check-email'])) {
         $Prp=new clsUserPrp();
         $Prp->P_email=$_POST['email'];

         $FunObj=new clsUser();
         $email_check=$FunObj->UserExist($Prp);

          if ($email_check) {

                for($i=1;$i<=6;$i++){
                   $rand_otp .= substr("1357902468", (rand()%(strlen("1357902468"))), 1); 
                  }
               
                         $to=$Prp->P_email;
                         $subject="Recover Password";
                         $headers = 'From:Explore The Unexplored';
                         $ms="Your OTP is $rand_otp."."\r\n"."Do not share with anyone."."\r\n".'"Admin"';
                         mail($to,$subject,$ms,$headers);
                         $_SESSION['email']=$Prp->P_email;
                         $_SESSION['rand_otp']=$rand_otp;
                         header("location:otp.php?lang=$set_lang");
                         exit();
         }else{
              $msg=$lang['not'];
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
            <div class="col-12 form">
                <form method="POST" autocomplete="off">
                    <h2 class="text-center"><?php echo $lang['Forget_Pass']; ?></h2>
                    <p class="text-center"><?php echo $lang['enter']; ?></p>

                       <?php if($msg){ ?>
                       <div class="alert alert-danger text-center">
                           <?php echo $msg; ?><?php echo $msg=""; ?>
                        </div>
                        <?php }
                            ?>

                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="<?php echo $lang['Enter_Email_Id']; ?>"  required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="<?php echo $lang['con']; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>