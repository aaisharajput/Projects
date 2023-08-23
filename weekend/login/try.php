<?php 
  error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
                  $rand_otp=9845;
                         $to="aaisharajput16101999@gmail.com";
                       $PrpP_f_name="sapna";
                        $PrpP_l_name="devi";
                        $subject="Email verification ";
                         $headers = 'From:Explore The Unexplored';
                         $ms ="Thanks for new Registration. "."\r\n"."Dear $Prp->P_f_name $Prp->P_l_name";
                         $ms.="Your OTP is $rand_otp."."\r\n"." Do not share with anyon. <br> Admin ";
                    
                         if ( mail($to,$subject,$ms,$headers)) {
                           echo "mail send successfully.";
                         }else{
                          echo "not send";
                         }
      ?>