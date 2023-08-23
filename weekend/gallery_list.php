<?php session_start();
 
     require_once('php/code.php');

 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  
<?php include 'links/links.php'; ?>

  <link rel="stylesheet" href="css/gallery_list.css">
  <link rel="stylesheet" href="css/footer.css">

</head>
<body>
   <div class="container-fluid nav-container">
            <?php include 'navbar.php'; ?>
               <div class="lang_btn">
                      <?php echo $lang['lang']; ?>: <a href="gallery_list.php?lang=en">EN | </a><a href="gallery_list.php?lang=hi">हिन्दी</a><a href="gallery_list.php?lang=ur"> | اردو</a>
                   </div>
             
          
                   <section class="gallery" id="gallery">
                      
                   <div class="box-container">
                      <div class="gallery-title">
                        <h2><?php echo $lang['gallery']; ?></h2>
                        <h4><?php echo $lang['most']; ?></h4>
                      </div>
            <?php 

                 $FunObj=new clsWeekendPlans();
                 $result=$FunObj->ShowWeekendPlans();
       
                $Obj=new clsTripGallery();
                         
                 $data=array();
                  $row=array();
                 foreach ($result as $data) {
                  $plan_id=$data['plan_id'];
                   
                   $sol=$Obj->Gallery($plan_id);
                  
                   ?>                   

                      <div class="box">
                           <div class="g-image">
                        <?php
                             foreach ($sol as $row){
                              $source=$row['source'];
                              break;
                             }
                            ?>  
                               <img src="img/<?php echo $source; ?>" alt="">
                           </div>
                           <div class="g-content">
                               <h3 class="g-h3"><?php echo $data['trip_name']; ?> </h3>
                     <?php
                       $R_Obj=new clsReview();
                       $average=$R_Obj->TripReviews($plan_id);
                       $count_comment=$R_Obj->CountReview($plan_id);
                       $avr_arr=array();
                       foreach ($average as $avr_arr) {
                        $aver=$avr_arr['AVG(rating)'];
                       }
                      
                  ?>
                   
                    <div class="stars">
                        <ul>
                          <?php

                               switch ($aver) {
                                 case "0":
                                   for($i=1;$i<=5;$i++){
                                  ?>
                                   <li class="star i"><i class="fa fa-star"></i></li>
                                   <?php }
                                   break;
                                 case "0.5":
                                   for($i=1;$i<=1;$i++){
                                  ?>
                                   <li class="star"><i class="fas fa-star-half-alt"></i></li>
                                   <?php }
                                      for($i=1;$i<=4;$i++){
                                   ?>
                                    <li class="star"><i class="far fa-star"></i></li>
                                   <?php }
                                   break;
                                 case "1":
                                    for($i=1;$i<=1;$i++){
                                  ?>
                                   <li class="star"><i class="fa fa-star"></i></li>
                                   <?php }
                                      for($i=1;$i<=4;$i++){
                                   ?>
                                    <li class="star"><i class="far fa-star"></i></li>
                                   <?php }
                                   break;
                                   case "1.5":
                                    for($i=1;$i<=1;$i++){
                                  ?>
                                   <li class="star"><i class="fa fa-star"></i></li>
                                   <?php } ?>
                                   <li class="star"><i class="fas fa-star-half-alt"></i></li>
                                   <?php
                                      for($i=1;$i<=3;$i++){
                                   ?>
                                    <li class="star"><i class="far fa-star"></i></li>
                                   <?php }
                                   break;
                                 case "2":
                                   for($i=1;$i<=2;$i++){
                                  ?>
                                   <li class="star"><i class="fa fa-star"></i></li>
                                   <?php }
                                      for($i=1;$i<=3;$i++){
                                   ?>
                                    <li class="star"><i class="far fa-star"></i></li>
                                   <?php }
                                   break;
                                 case "2.5":
                                   for($i=1;$i<=2;$i++){
                                  ?>
                                   <li class="star"><i class="fa fa-star"></i></li>
                                   <?php } ?>
                                   <li class="star"><i class="fas fa-star-half-alt"></i></li>
                                   <?php
                                      for($i=1;$i<=2;$i++){
                                   ?>
                                    <li class="star"><i class="far fa-star"></i></li>
                                   <?php }
                                   break;
                                   case "3":
                                   for($i=1;$i<=3;$i++){
                                  ?>
                                   <li class="star"><i class="fa fa-star"></i></li>
                                   <?php }
                                      for($i=1;$i<=2;$i++){
                                   ?>
                                    <li class="star"><i class="far fa-star"></i></li>
                                   <?php }
                                   break;
                                 case "3.5":
                                    for($i=1;$i<=3;$i++){
                                  ?>
                                   <li class="star"><i class="fa fa-star"></i></li>
                                   <?php }
                                      
                                        ?>
                                   <li class="star"><i class="fas fa-star-half-alt"></i></li>
                                   <?php
                                       
                                      for($i=1;$i<=1;$i++){
                                   ?>
                                    <li class="star"><i class="far fa-star"></i></li>
                                   <?php }
                                   break;
                                 case "4":
                                   for($i=1;$i<=4;$i++){
                                  ?>
                                   <li class="star"><i class="fa fa-star"></i></li>
                                   <?php }
                                      for($i=1;$i<=1;$i++){
                                   ?>
                                    <li class="star"><i class="far fa-star"></i></li>
                                   <?php }
                                   break;
                                 case "4.5":
                                   for($i=1;$i<=4;$i++){
                                  ?>
                                   <li class="star"><i class="fa fa-star"></i></li>
                                   <?php } ?>
                                   <li class="star"><i class="fas fa-star-half-alt"></i></li>
                                     <?php
                                   break;
                                 default:
                                   for($i=1;$i<=5;$i++){
                                  ?>
                                   <li class="star"><i class="fa fa-star"></i></li>
                                   <?php }
                               }
                               ?>
                                                   
                        </ul>
                    </div>
                               <p class="g-p">
                                <h5><?php echo $data['start_date']; ?></h5> <h6> <?php echo $lang['charge']; ?>: <?php echo $lang['rs']; ?> <?php echo $data['fee_charges']; ?><br><?php echo $lang['group']; ?>: <?php echo $data['members']; ?></h6>
                                <i class="fa fa-map-marker"></i> <?php echo $data['destination']; ?><br>

                                <button value="<?php echo $plan_id; ?>" class="btn g-btn" onclick="getplanid(this);"><?php echo $lang['see_review']; ?></button></p>
                           </div>
                       </div>
              <?php    
                  }
              ?>

                   </div>

             </section>

         
             


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
                  <li><a href="contact.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['contact']; ?></a></li>
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
    <script type="text/javascript">
        
        var icon = document.getElementById("icon");
        icon.onclick=function(){
          document.body.classList.toggle("dark-theme");
          if (document.body.classList.contains("dark-theme")) {
            icon.src = "img/sun.png";
          }else{
            icon.src = "img/moon.png";
          }
        }
        
        
         function getplanid(id)
    {
       var weekend_id=$(id).val();
       var action="trip_review";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {trip_review:action,weekend_id:weekend_id},
                      success: function(data){
                         window.location.href="trip_review.php?lang=<?php echo $set_lang; ?>"; 
                   
                         }
                });
    }
      </script>
</body>
</html>