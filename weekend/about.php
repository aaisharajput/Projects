<!DOCTYPE html>
<html>
<head>
	<title>About</title>
   <?php include 'links/links.php' ?>
  <link rel="stylesheet" href="css/about.css">
  <link rel="stylesheet" href="css/footer.css">

</head>
<body>
	 <div class="container-fluid nav-container">
            <?php include 'navbar.php' ?>
             <div class="lang_btn">
              <?php echo $lang['lang']; ?>: <a href="about.php?lang=en">EN | </a><a href="about.php?lang=hi">हिन्दी</a><a href="about.php?lang=ur"> | اردو</a>
              </div>
           
             <div class="row">
              <div class="col-12">
                <h1 class="title"><?php echo $lang['about_us']; ?></h1>
              </div>
             <div class="col-md-4">
              <img src="img/search.svg" class="search">
             </div>
             <div class="col-md-8">
              <div class="content">
             <p>
              <?php echo $lang['about_p']; ?> <br>
               <?php echo $lang['about_p1']; ?><br>
               <?php echo $lang['about_p2']; ?>
               
             </p>
             </div>
           </div>
         </div>
             


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
</body>
</html>