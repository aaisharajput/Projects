<?php session_start();
 
     require_once('php/code.php');
     include'select_lang.php';
    $msg="";
    $email_veri="";
    $rand_otp="";
   if (isset($_POST['signup'])) {
    $_SESSION['email_veri']=$_POST['email'];
      $Prp=new clsUserPrp();
      $Prp->P_email=$_POST['email'];
      $Prp->P_pswd=md5($_POST['pswd']);
      
       $FunObj=new clsUser();

       $login=$FunObj->Login($Prp);
       if ($login) {
           $data=array();

           foreach ($login as $data) {
              $u_id=$data['u_id'];
              $status=$data['status'];
           }
           if ($status==1) {
             $_SESSION['u_id']=$u_id;
             header("Location:login/home.php?lang=$set_lang");
           }else{
              $msg= $lang['veri_email']."<form method='post'> <button type='submit' name='veri' class='btn verify' style='color:red'>".$lang['click']."</button></form>";
           }
       }else{
            $msg=$lang['invalid'];
       }

    } 


    if (isset($_POST['veri'])) {
    $email_veri=$_SESSION['email_veri'];

       for($i=1;$i<=6;$i++){
                  $rand_otp .= substr("1357902468", (rand()%(strlen("1357902468"))), 1); 
               }
               
                    $to=$email_veri;
                        $subject="Email verification ";
                         $headers = 'From:Explore The Unexplored';
                         $ms="Your OTP is $rand_otp."."\r\n"."Do not share with anyone."."\r\n".'"Admin"';
                         mail($to,$subject,$ms,$headers);
                         $_SESSION['email']=$email_veri;
                         $_SESSION['rand_otp']=$rand_otp;
                         header("location:verify_otp.php?lang=$set_lang");
                         exit();
    }
  
?>

<!DOCTYPE html>
<html>
<head>
	<title>login</title>

<?php include 'links/links.php' ?>

   <link rel="stylesheet" type="text/css" href="css/login.css">
   <link rel="stylesheet" href="css/footer.css">


</head>
<body>

	<div class="container-fluid nav-container">
		     <?php include 'navbar.php' ?>
               <div class="lang_btn">
               <?php echo $lang['lang']; ?>: <a href="login.php?lang=en">EN | </a><a href="login.php?lang=hi">हिन्दी</a><a href="login.php?lang=ur"> | اردو</a>
               </div>
       <div class="row">
       
       	<div class="col-12">
       		   <h1 class="title1"><?php echo $lang['Login_Here']; ?>
               <?php if($msg){ ?>
                       <div class="alert text-center">
                           <?php echo $msg; ?><?php echo $msg=""; ?>
                        </div>
                <?php 
                        }
                ?>
            </h1>
       	</div>
       
       	<div class="col-md-4">
       		
          <div class="img">
       		<img src="img/default.svg">
            <h1 class="title"><?php echo $lang['Welcome']; ?></h1>
        </div>
       
       	</div>
      
       	<div class="col-md-7 content">
            
       	 <form method="post" action="">
        	<div class="form-content">
       
        	  	<div class="form-group">
       		    	<label><?php echo $lang['Email_Id']; ?>:</label> 
                <div class="i">
                <i class="fas fa-user"></i>
                <input type="email" class="form-control" placeholder="<?php echo $lang['Enter_Email_Id']; ?>" name="email" required/>
       			    </div>
                <label><?php echo $lang['Password']; ?>:</label>
                <div class="i">     
                  <i class="fas fa-lock"></i>                                     
                <input type="password" class="form-control" placeholder="<?php echo $lang['enter_pswd']; ?>" id="password" name="pswd" required/>
                </div>
                <div class="eye">
                <i class="fas fa-eye" id="slash" onclick="toggle_eye()"></i>
               </div>
       			  <br>
       		  
               <button class="btn btn-primary" name="signup"><?php echo $lang['s_login']; ?></button>
       		  	<a href="forget-pswd.php?lang=<?php echo $set_lang; ?>" class="forget_pass"><?php echo $lang['Forgot_Password']; ?></a>
       		  </div>
       
          	</div>
            </form>
        	</div>
      
        </div>
   
  <br><br>
<footer>
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-6">
              <h2><?php echo $lang['about_us']; ?></h2>
              <p> <?php echo $lang['about_p']; ?></p>

           <ul class="soc-links">
               <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
           </ul>
           </div>

           <div class="col-lg-3">
              <h2><?php echo $lang['Quick_Links']; ?></h2>
              <ul>
                  <li><a href="index.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['home']; ?></a></li>
                  <li><a href="about.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['about']; ?></a></li>
                  <li><a href="faq.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['faq']; ?></a></li>
                  <li><a href="contact.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['contact']; ?>"</a></li>
                  <li><a href="login.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['login']; ?></a></li>
              </ul>
           </div>
           <div class="col-lg-3">
               <h2><?php echo $lang['Contact_Info']; ?></h2>
               
                <p class="contact-p">
                  <i class="fa fa-map-marker"></i> 
                      G.G.M SCIENCE CLG, <br>
                          J&K,180006
                </p>
                     
                  <p class="contact-p">
                   <i class="fa fa-phone"></i>
                      +123 4567 890
                      <br>+123 4567 890
                  </p>

                  <p class="contact-p">
                   <i class="fa fa-envelope"></i> 
                     xyz@gmail.com
                 </p>
                  
                

           </div>
       </div>
   </div>
</footer>
</div>

<script>
        
        var icon = document.getElementById("icon");
        icon.onclick=function(){
          document.body.classList.toggle("dark-theme");
          if (document.body.classList.contains("dark-theme")) {
            icon.src = "img/sun.png";
          }else{
            icon.src = "img/moon.png";
          }
        }
      </script>
      <script>
        
       var state=false;
        function toggle_eye()
        {
          if(state){
            document.getElementById("password").setAttribute("type","password");
            document.getElementById("slash").setAttribute("class","fas fa-eye");
            state=false;
          }
          else{
             document.getElementById("password").setAttribute("type","text");
             document.getElementById("slash").setAttribute("class","fas fa-eye-slash");
             state=true;
          }
        } 
      </script>
</body>
</html>