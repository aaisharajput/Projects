<?php session_start();
 
     require_once('php/code.php');

    $T_Obj=new clsTraffic();
    $t_result=$T_Obj->UpdateTraffic();


   if (isset($_POST['register'])) {
      $Prp=new clsUserPrp();
      $Prp->P_f_name=$_POST['f_name'];
      $Prp->P_l_name=$_POST['l_name'];
      $Prp->P_email=$_POST['email'];
      $Prp->P_pswd=md5($_POST['pswd']);


  $FunObj=new clsUser();
 

  $email_check=$FunObj->UserExist($Prp);
    
   if ($email_check) {

        echo "<script>alert('Email already exist')</script>";
       
   }else{
         
       
           $register_result=$FunObj->Register($Prp);
         
           if ($register_result) {
               
               for($i=1;$i<=6;$i++){
                  $rand_otp .= substr("1357902468", (rand()%(strlen("1357902468"))), 1); 
               }
               
                         $to=$Prp->P_email;
                         $subject="Email verification ";
                         $headers = 'From:Explore The Unexplored';
                         $ms ="Thanks for new Registration."."\r\n"."Dear $Prp->P_f_name $Prp->P_l_name,"."\r\n";
                         $ms.="Your OTP is $rand_otp."."\r\n"."Do not share with anyone."."\r\n".'"Admin"';
                         mail($to,$subject,$ms,$headers);
                         $_SESSION['email']=$Prp->P_email;
                         $_SESSION['rand_otp']=$rand_otp;
                         header("location:verify_otp.php");
                         exit();



            }else{
               echo "<script>alert('Error: Data not inserted')</script>";
            }
   }

 }
?>

<!DOCTYPE html>
<html>
<head>
	<title>INDEX</title>
	
<?php include 'links/links.php' ?>

   <link rel="stylesheet" href="css/index.css">
   <link rel="stylesheet" href="css/review.css">
   <link rel="stylesheet" href="css/gallery.css">
   <link rel="stylesheet" href="css/feature.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/services.css">

</head>

<body>
        <div class="container-fluid nav-container">
            <?php include 'navbar.php' ?>
              <div class="lang_btn">
                <?php echo $lang['lang']; ?>: <a href="index.php?lang=en">EN | </a><a href="index.php?lang=hi">हिन्दी</a><a href="index.php?lang=ur"> | اردو</a>
              </div>
             <br>

            <div class="content">
                <button type="button" class="btn" data-toggle="modal" data-target="#myModal">
                  <?php echo $lang['enroll']; ?>
                </button><br>
              <h1><?php echo $lang['explore']; ?><br><?php echo $lang['weekend']; ?></h1>
              <p><?php echo $lang['enjoy']; ?></p>

              <div class="social-links">
                <a href=""><i class="fa fa-facebook link"></i></a>
                <a href=""><i class="fa fa-instagram link"></i></a>
                <a href=""><i class="fa fa-twitter link"></i></a>
              </div>
            </div> 

            <img src="img/off-ride.svg" class="trip_img">
            

                <div class="modal fade" id="myModal">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">
      
        
                      <div class="modal-body">
                        
                        <h4 class="modal-title"><img src="img/default.svg" class="img"><br>
                              <?php echo $lang['register']; ?>
                        <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                        <form method="post">
                           <div class="form-group">
                              <input type="text" class="form-control" name="f_name" placeholder="<?php echo $lang['f_name']; ?>" required/>
                            </div>
                           
                            <div class="form-group">
                              <input type="text" class="form-control" name="l_name" placeholder="<?php echo $lang['l_name']; ?>">
                            </div> 

                            <div class="form-group">
                              <input type="email" class="form-control" name="email" placeholder="<?php echo $lang['Enter_Email_Id']; ?>" required/>
                            </div>
                           
                            <div class="form-group">
                                <input type="password" class="form-control" name="pswd" placeholder="<?php echo $lang['enter_pswd']; ?>" id="password" name="pswd" required/>
                               
                                <div class="eye">
                                <i class="fas fa-eye" id="slash" onclick="toggle_eye()"></i>
                               </div>
                            </div>
                           
                            <button type="submit" class="btn btn-primary" name="register" id="sign-up"><?php echo $lang['sign']; ?></button>
                        </form>
                      
                      </div>
        
                    </div>
                  </div>
                
                </div>
      </div>



<section class="feature" id="feature">

<h1 class="heading"><?php echo $lang['popular']; ?></h1>
<h3 class="f-title"><?php echo $lang['see']; ?></h3>

<div class="card-container">

    <div class="card">
        <img src="img/download.jpg" alt="">
        <div class="info">
            <h3><?php echo $lang['1'];?></h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p><?php echo $lang['text_1'];?></p>
            <a href="packages.php?lang=<?php echo $set_lang; ?>"><button class="btn feature-btn"><?php echo $lang['visit']; ?></button></a>
        </div>
    </div>

    <div class="card">
        <img src="img/imgg.jpg" alt="">
        <div class="info">
            <h3><?php echo $lang['2'];?> </h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <p><?php echo $lang['text_2'];?>
            </p>
            <a href="packages.php?lang=<?php echo $set_lang; ?>"><button class="btn feature-btn"><?php echo $lang['visit']; ?></button></a>
        </div>
    </div>

    <div class="card">
        <img src="img/images.jpg" alt="">
        <div class="info">
            <h3><?php echo $lang['3'];?> </h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half"></i>
            </div>
            <p><?php echo $lang['text_3'];?></p>
            <a href="packages.php?lang=<?php echo $set_lang; ?>"><button class="btn feature-btn"><?php echo $lang['visit']; ?></button></a>
        </div>
    </div>
    <div class="row arrow">
      <a href="packages.php?lang=<?php echo $set_lang; ?>"><i class="fas fa-angle-double-right"></i></a>
    </div>
 
</div>

</section>

    <div class="container-fluid about-container">
      <div class="row">
         
         <div class="col-12">
          <h1 class="about"><?php echo $lang['about_us']; ?></h1>
         <p class="about-p"><?php echo $lang['world']; ?></p>
        </div>
         <div class="col-md-6">
           <img src="img/about-trip.jpg" class="about-img">
        </div>

       <div class="col-md-6">
         <div class="write-about">
          <h1><?php echo $lang['why']; ?></h1>
        <p><?php echo $lang['travel']; ?><br><br>
         <a href="about.php?lang=<?php echo $set_lang; ?>"> <button class="btn read"><?php echo $lang['read']; ?></button></a></p>
        </div>
      </div>
    </div>
    <div class="row ">
        <div class="col-12">
          <div class="a-p">
          <h1 class="about-t1"><?php echo $lang['promise']; ?></h1>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h1 class="title"><?php echo $lang['vision']; ?></h1>
        <p>  <?php echo $lang['dream']; ?></p>
        </div>
        <div class="col-md-6">
             <img src="img/family.jpg" class="img-title">
        </div>
      </div>
      <div class="row flex-column-reverse flex-md-row">
          <div class="col-md-6">
            <img src="img/track.jpg" class="img-title">
        </div>
        <div class="col-md-6">
       <h1 class="title"><?php echo $lang['mission']; ?></h1>
          <p> <?php echo $lang['pure']; ?></p>

        </div>
      </div>
      <div class="row">
         <div class="col-md-6">
          <h1 class="title"><?php echo $lang['approach']; ?></h1>
        <p><?php echo $lang['honesty']; ?></p>
        </div>
        <div class="col-md-6">
             <img src="img/customer.jpg" class="img-title1">
        </div>
      </div>
      <div class="row flex-column-reverse flex-md-row">
          <div class="col-md-6">
            <img src="img/secure.jpg" class="img-title">
        </div>
        <div class="col-md-6">
          <br><br>
       <h1 class="title"><?php echo $lang['comfort']; ?></h1>
          <p> <?php echo $lang['our']; ?> </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
       <h1 class="title"><?php echo $lang['secure']; ?></h1>
          <p> <?php echo $lang['data']; ?> </p>

        </div>
         <div class="col-md-6">
             <img src="img/pay.jpg" class="img-title">
        </div>
      
      </div>

    </div>



<section class="gallery" id="gallery">

<div class="box-container">
   <div class="gallery-title">
     <h2><?php echo $lang['gallery']; ?></h2>
     <h4><?php echo $lang['most']; ?></h4>
   </div>
    <div class="box">
        <div class="g-image">
            <img src="img/download.jpg" alt="">
        </div>
        <div class="g-content">
            <h3 class="g-h3">  <?php echo $lang['Katra'];?>
            </h3>
            <p class="g-p"> <?php echo $lang['text_1'];?> <br>
            <a href="gallery_list.php?lang=<?php echo $set_lang; ?>"><button class="btn g-btn"><?php echo $lang['explored']; ?></button></a></p>
        </div>
    </div>

    <div class="box">
      <div class="g-image">
            <img src="img/download.jpg" alt="">
        </div>
         <div class="g-content">
            <h3 class="g-h3"> <?php echo $lang['patnitop'];?> </h3>
            <p class="g-p"><?php echo $lang['text_3'];?><br>
            <a href="gallery_list.php?lang=<?php echo $set_lang; ?>"><button class="btn g-btn"><?php echo $lang['explored']; ?></button></a></p>
        </div>
        
       
    </div>

    <div class="box">
        <div class="g-image">
            <img src="img/images.jpg" alt="">
        </div>
        <div class="g-content">
            <h3 class="g-h3">  <?php echo $lang['srinagar'];?></h3>
            <p class="g-p"><?php echo $lang['text_2'];?><br>
            <a href="gallery_list.php?lang=<?php echo $set_lang; ?>"><button class="btn g-btn"><?php echo $lang['explored']; ?></button></a></p>
        </div>
    </div>

    <div class="box">
        <div class="g-image">
            <img src="img/imgg.jpg" alt="">
        </div>
         <div class="g-content">
            <h3 class="g-h3"> <?php echo $lang['mansar'];?></h3>
            <p class="g-p"><?php echo $lang['text_4'];?><br>
            <a href="gallery_list.php?lang=<?php echo $set_lang; ?>"><button class="btn g-btn"><?php echo $lang['explored']; ?></button></a></p>
        </div>
        
       
    </div>

    <div class="box">
        <div class="g-image">
            <img src="img/water.jpg" alt="">
        </div>
        <div class="g-content">
            <h3 class="g-h3"><?php echo $lang['bhaderwah'];?></h3>
            <p class="g-p"><?php echo $lang['text_5'];?><br>
            <a href="gallery_list.php?lang=<?php echo $set_lang; ?>"><button class="btn g-btn"><?php echo $lang['explored']; ?></button></a></p>
        </div>
    </div>

</div>

</section>

<section id="review" class="review">

<h1 class="r-heading"><?php echo $lang['review']; ?></h1>


<div class="r-box-container">

    <div class="r-box">
        <div class="r-image">
            <img src="img/download.jpg" alt="">
        </div>
        <div class="r-content">
            <h3><?php echo $lang['monu'];?></h3>
            <p><?php echo $lang['text_6'];?></p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
        </div>
    </div>

    <div class="r-box">
        <div class="r-image">
            <img src="img/images.jpg" alt="">
        </div>
        <div class="r-content">
            <h3><?php echo $lang['sapna'];?></h3>
            <p><?php echo $lang['text_7'];?> </p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="far fa-star"></i>
            </div>
        </div>
    </div>

    <div class="r-box">
        <div class="r-image">
            <img src="img/imgg.jpg" alt="">
        </div>
        <div class="r-content">
            <h3><?php echo $lang['momo'];?></h3>
            <p><?php echo $lang['text_8'];?></p>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <i class="far fa-star"></i>
            </div>
        </div>
    </div>

</div>

</section>


<section class="services" id="services">

    <h1 class="ser-heading">
   <?php if($set_lang=='en'){ ?>    
        <span><?php echo $lang['S']; ?></span>
        <span><?php echo $lang['E']; ?></span>
        <span><?php echo $lang['R']; ?></span>
        <span><?php echo $lang['V']; ?></span>
        <span><?php echo $lang['I']; ?></span>
        <span><?php echo $lang['C']; ?></span>
        <span><?php echo $lang['E']; ?></span>
        <span><?php echo $lang['S']; ?></span>
       <?php  
       }elseif($set_lang=='hi'){ ?>
        <span><?php echo $lang['R']; ?></span>
        <span><?php echo $lang['V']; ?></span>
        <span><?php echo $lang['I']; ?></span>
         <?php  
       }else{?>
        <span><?php echo $lang['T']; ?></span>
        <span><?php echo $lang['R']; ?></span>
        <span><?php echo $lang['V']; ?></span>
        <span><?php echo $lang['I']; ?></span>
      <?php  }       
       
       ?>
    </h1>

    <div class="box-container">

        <div class="box">
            <i class="fas fa-hotel"></i>
            <h3><?php echo $lang['hotel']; ?></h3>
            <p><?php echo $lang['text_9'];?></p>
        </div>
        <div class="box">
            <i class="fas fa-utensils"></i>
            <h3><?php echo $lang['food']; ?></h3>
            <p><?php echo $lang['text_10'];?></p>
        </div>
        <div class="box">
            <i class="fas fa-bullhorn"></i>
            <h3><?php echo $lang['safty']; ?></h3>
            <p><?php echo $lang['text_11'];?> </p>
        </div>
        <div class="box">
            <i class="fas fa-globe-asia"></i>
            <h3><?php echo $lang['around']; ?></h3>
            <p><?php echo $lang['text_12'];?></p>
        </div>
        <div class="box">
            <i class="fas fa-bus"></i>
            <h3><?php echo $lang['fastest']; ?></h3>
            <p><?php echo $lang['text_13'];?></p>
        </div>
        <div class="box">
            <i class="fas fa-hiking"></i>
            <h3><?php echo $lang['adventure']; ?></h3>
            <p><?php echo $lang['text_14'];?></p>
        </div>

    </div>

</section>
<footer>
   <div class="container-fluid">
       <div class="row">
           <div class="col-md-6">
              <h2><?php echo $lang['about_us']; ?></h2>
              <p><?php echo $lang['about_p']; ?></p>

           <ul class="soc-links">
               <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
           </ul>
           </div>

           <div class="col-md-3">
              <h2><?php echo $lang['Quick_Links']; ?></h2>
              <ul>
                   <li><a href="index.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['home']; ?></a></li>
                  <li><a href="about.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['about']; ?></a></li>
                  <li><a href="faq.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['faq']; ?></a></li>
                  <li><a href="contact.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['contact']; ?></a></li>
                  <li><a href="login.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['login']; ?></a></li>
              </ul>
           </div>
           <div class="col-md-3">
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