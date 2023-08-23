<?php session_start();
  error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
     require_once('php/code.php');
     include 'select_lang.php';
  $msg="";
  $msg2="";
   if (isset($_POST['submit'])) {
      $Prp=new clsContactPrp();
      $Prp->P_email=$_POST['email'];
      $Prp->P_name=$_POST['name'];
      $Prp->P_fd_text=$_POST['fd_text'];

      $FunObj=new clsContact();
      $result=$FunObj->UserContactIssue($Prp);
      if ($result) {
         $msg=$lang['mail_send'];
         header("Refresh: .6");
      } else{
               $msg2=$lang['not_send_mail'];
            }
    }

 ?>
 <!DOCTYPE html>
<html>
<head>
  <title></title>

   <?php include 'links/links.php' ?>
   

    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/footer.css">


</head>
<body>
<div class="container-fluid nav-container">
  
      <?php include 'navbar.php' ?>
            <div class="lang_btn">
              <?php echo $lang['lang']; ?>: <a href="contact.php?lang=en">EN | </a><a href="contact.php?lang=hi">हिन्दी</a><a href="contact.php?lang=ur"> | اردو</a>
           </div>
     
<section id="contact" class="contact">

<h1 class="heading"><?php echo $lang['CONTACT_US']; ?></h1>


<div class="row">

<div class="contact-info">

    <div class="box">
        <h3> <i class="fas fa-home"></i> <?php echo $lang['address']; ?>  </h3>
        <p>G.G.M SCIENCE CLG, <br>
        J&K,180006</p>
    </div>

    <div class="box">
        <h3> <i class="fas fa-envelope"></i> <?php echo $lang['mail']; ?>  </h3>
        <p>xyz@gmail.com</p>
    </div>

    <div class="box">
        <h3> <i class="fas fa-phone"></i> <?php echo $lang['phone']; ?>  </h3>
        <p>+123 4567 890</p>
    </div>

</div>

<div class="contact-form-container">
    <?php if ($msg) {
      
      ?>
      <div class="alert alert-success text-center"><?php echo $msg; ?><?php echo $msg=""; ?></div>
      <?php
    }
    ?>
     <?php if ($msg2) {
      
      ?>
      <div class="alert alert-success text-center"><?php echo $msg2; ?><?php echo $msg2=""; ?></div>
      <?php
    }
    ?>
    <form method="post">

        <h3><?php echo $lang['touch']; ?></h3>

        <div class="inputBox">
            <input type="text" name="name" placeholder="<?php echo $lang['full_name']; ?>" required>
            <input type="email" name="email" placeholder="<?php echo $lang['mail']; ?>" required>
        </div>

        <textarea name="fd_text" id="" cols="30" rows="10" placeholder="<?php echo $lang['message']; ?>" required></textarea>

        <input type="submit" name="submit" value="<?php echo $lang['message']; ?>">

    </form>

</div>

</div>
<br>
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3356.5328498831836!2d74.84980861451668!3d32.72503899394253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391e848d478cf037%3A0x1b2976851bec24fc!2sGovt.%20Gandhi%20Memorial%20Science%20College%20Jammu!5e0!3m2!1sen!2sin!4v1623658302824!5m2!1sen!2sin"  width="100%" height="300" frameborder="0" style="border:0; outline:none;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
<br>
</section>

<footer>
       <div class="row">
           <div class="col-md-6">
              <h2> <?php echo $lang['about_us']; ?></h2>
              <p> <?php echo $lang['about_p']; ?></p>

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
                  <li><a href="contact.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['contact']; ?>"</a></li>
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

</body>
</html>