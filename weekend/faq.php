<!DOCTYPE html>
<html>
<head>
  <title></title>
  
<?php include 'links/links.php'; ?>

  <link rel="stylesheet" href="css/faq.css">
  <link rel="stylesheet" href="css/footer.css">

</head>
<body>
   <div class="container-fluid nav-container">
              <?php include 'navbar.php' ?>
         <div class="lang_btn">
                      <?php echo $lang['lang']; ?>: <a href="faq.php?lang=en">EN | </a><a href="faq.php?lang=hi">हिन्दी</a><a href="faq.php?lang=ur"> | اردو</a>
                   </div>

                   <br>
                   <div class="title"><h1><?php echo $lang['faq']; ?></h1></div>
                   
                     <div id="accordion">
                          <div class="card">
                            <div class="card-header">
                              <a class="card-link" data-toggle="collapse" href="#collapseOne">
                               <?php echo $lang['q1']; ?>
                              </a>
                            </div>
                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                              <div class="card-body">
                                <?php echo $lang['ans1']; ?>
                              </div>
                            </div>
                          </div><br>
                          <div class="card">
                            <div class="card-header">
                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                              <?php echo $lang['q2']; ?>
                            </a>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                              <div class="card-body">
                                <?php echo $lang['ans2']; ?>
                              </div>
                            </div>
                          </div><br>
                          <div class="card">
                            <div class="card-header">
                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                                <?php echo $lang['q3']; ?>
                              </a>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                              <div class="card-body">
                                <?php echo $lang['ans3']; ?>
                                
                              </div>
                            </div>
                          </div><br>
                          <div class="card">
                            <div class="card-header">
                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                                <?php echo $lang['q4']; ?>
                              </a>
                            </div>
                            <div id="collapseFour" class="collapse" data-parent="#accordion">
                              <div class="card-body">
                                <?php echo $lang['ans4']; ?>
                              </div>
                            </div>
                          </div><br>
                          <div class="card">
                            <div class="card-header">
                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                                <?php echo $lang['q5']; ?>
                              </a>
                            </div>
                            <div id="collapseFive" class="collapse" data-parent="#accordion">
                              <div class="card-body">
                                <?php echo $lang['ans5']; ?>
                              </div>
                            </div>
                          </div><br>
                          <div class="card">
                            <div class="card-header">
                              <a class="collapsed card-link" data-toggle="collapse" href="#collapseSix">
                                <?php echo $lang['q6']; ?>
                              </a>
                            </div>
                            <div id="collapseSix" class="collapse" data-parent="#accordion">
                              <div class="card-body">
                                <?php echo $lang['ans6']; ?>
                              </div>
                            </div>
                          </div><br>
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