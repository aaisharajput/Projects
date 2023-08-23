<?php session_start();
 
     require_once('php/code.php');

    $msg="";
    if (isset($_POST['check-email'])) {
         $Prp=new clsUserPrp();
         $Prp->P_email=$_POST['email'];

         $FunObj=new clsUser();
         $email_check=$FunObj->UserExist($Prp);

          if ($email_check) {
            if ($Prp->P_email=='rajputroshini684@gmail.com') {
               
                for($i=1;$i<=6;$i++){
                   $rand_otp .= substr("1357902468", (rand()%(strlen("1357902468"))), 1); 
                  }
               
                         $to=$Prp->P_email;
                         $subject="Recover Password";
                         $headers = 'From:Explore The Unexplored';
                         $ms="Your OTP is $rand_otp."."\r\n"."Do not share with anyone.";
                         mail($to,$subject,$ms,$headers);
                         $_SESSION['email']=$Prp->P_email;
                         $_SESSION['rand_otp']=$rand_otp;
                         header("location:otp.php");
                         exit();
                  }else{
                    $msg="Sorry!! Only Admin Account is Acceptable";
                  }       
         }else{
              $msg="Email not registerd";
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
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>

                       <?php if($msg){ ?>
                       <div class="alert alert-danger text-center">
                           <?php echo $msg; ?><?php echo $msg=""; ?>
                        </div>
                        <?php }
                            ?>

                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address"  required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>