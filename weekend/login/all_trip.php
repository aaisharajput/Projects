<?php session_start();
 
     require_once('../php/code.php');

 ?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
    <?php include'../links/links.php'; ?>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/my_trip.css">
</head>
<body>
    <?php include'title_bar.php'; ?>

    <div class="container-fluid">
         <section class="gallery" id="gallery">

                   <div class="box-container">
                      <div class="gallery-title">
                        <h2><?php echo $lang['txt51']; ?></h2>
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
                               <img src="../img/<?php echo $source; ?>" alt="">
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
                                <h5><?php echo $data['start_date']; ?></h5> <h6> <?php echo $lang['charge']; ?>: <?php echo $lang['rs']; ?> <?php echo $data['fee_charges']; ?><br><?php echo $lang['group']; ?> <?php echo $data['members']; ?></h6>
                                <i class="fa fa-map-marker"></i> <?php echo $data['destination']; ?><br>

                               <a href="trip_review.php?lang=<?php echo $set_lang; ?>"><button class="btn g-btn" value="<?php echo $plan_id;?>" onclick="getplanid(this);"><?php echo $lang['see_review']; ?></button></a></p>
                           </div>
                       </div>
              <?php    
                  }
              ?>

                   </div>

             </section>
    </div>
<footer>
  <h6><div class="lang_btn">
     <?php echo $lang['lang']; ?>: <a href="all_trip.php?lang=en">EN | </a><a href="all_trip.php?lang=hi">हिन्दी</a><a href="all_trip.php?lang=ur"> | اردو</a>
   </div></h6>
</footer>

  <script type="text/javascript">

   function getplanid(id)
    {
       var weekend_id=$(id).val();
       var action="trip_review";
       $.ajax({
                     type: 'POST',
                     url: '../php/session.php',
                     data: {trip_review:action,weekend_id:weekend_id},
                      success: function(data){
                         window.location.href="see_review.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }

</script>

</body>
</html>