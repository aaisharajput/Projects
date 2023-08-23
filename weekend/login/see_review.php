<?php session_start();
 
     require_once('../php/code.php');
     $weekend_id=$_SESSION['weekend_id'];

 ?>
 <!DOCTYPE html>
<html>
<head>
  <title></title>
    <?php include'../links/links.php'; ?>

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/see_review.css">
  
</head>
<body>
   <?php include'title_bar.php'; ?>

    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="review_title">
             
             
               <?php 

                 $FunObj=new clsWeekendPlans();
                 $result=$FunObj->UserWeekendPlans($weekend_id);
       
                $Obj=new clsTripGallery();
                         
                 $data=array();
                  $row=array();
                 foreach ($result as $data) {
                   
                   $sol=$Obj->Gallery($weekend_id);
                  
                   ?> 

              <h1> <a href="all_trip.php?lang=<?php echo $set_lang; ?>"><i class="fa fa-arrow-left"></i></a>
                <?php echo $data['trip_name']; ?></h1>
            </div>
            
            <div class="video">
              <div class="img-container">
              <img src="../img/download.jpg" id="image">
              </div>
            </div> 
       
            <div class="carousel-box">
            <div class="carousel owl-carousel items">
               <?php
                             foreach ($sol as $row){
                              $source=$row['source'];
                ?>
            <div class="item" >
               <img src="../img/<?php echo $source; ?>" onclick="img_slider('../img/<?php echo $source; ?>')">
            </div>
            <?php  
                }
                ?>
            </div>
          </div>
            <div class="video_content">
            <h6> <i class="fa fa-map-marker"></i> <?php echo $data['destination']; ?></h6>
           </div>
          </div>
            <?php    
                  }
              ?>
            <div class="col-md-5">
                <div class="rating">
                  <?php
                       $R_Obj=new clsReview();
                       $average=$R_Obj->TripReviews($weekend_id);
                       $count_comment=$R_Obj->CountReview($weekend_id);
                       $avr_arr=array();
                       foreach ($average as $avr_arr) {
                        $aver=$avr_arr['AVG(rating)'];
                       }
                       foreach ($count_comment as $avr_arr) {
                         $count_r=$avr_arr['Count(comment)'];
                       }
                  ?>
                    <h1><?php if ($aver){ echo $aver;}else{echo "0";} ?>/5.0</h1>
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
                    <h6><?php echo $count_r; ?> <?php echo $lang['txt75']; ?></h6>
                </div>
            </div>
            <div class="col-md-7">
                
                 <div class="bar_stars">
                        <ol type="1" reversed>
                          <?php 
                              for ($i=5; $i >=1; $i--) { 

                               $bar=$R_Obj->CountRate($i,$weekend_id);
                               foreach ($bar as $bar_data) {
                                if($count_r){
                                 $bar_result=($bar_data['Count(rating)']*100)/$count_r;
                                }else{
                                  $bar_result=0;
                                }
                               }
                               
                          ?>
                            <li class="star">
                              <i class="fa fa-star"></i> 
                               <div class="skill-bar">
                                <div class="progress-bar" style="width:<?php echo $bar_result;?>%">
                                  <?php echo $bar_result;?> % 
                                </div>
                               </div> 
                           </li>
                           <?php
                             }
                           ?>

                        </ol>
                    </div>
                                  
              </div>

          <div class="col-12"><hr>
               <?php 
                     
                     $r_result=$R_Obj->UserReviews($weekend_id);
                     if ($r_result) {
                        $arr_data=array();
                        foreach($r_result as $arr_data){

                          $u_id=$arr_data['u_id'];
                     $functionObj=new clsUser();
                     $fun_result=$functionObj->GetUserDetail($u_id);
                     $rowarr=array();
                     foreach ($fun_result as $rowarr) {
                ?>
                <div class="box">
                    <img src="../img/<?php echo $rowarr['profile_pic']; ?>">
                    <div class="post">
                     <div class="stars">
                        <ul>
                          <?php
                             for ($i=1; $i <=$arr_data['rating'] ; $i++) { 
                          ?>
                            <li class="star"><i class="fa fa-star"></i></li>
                          <?php } ?>
                        </ul>
                    </div>
                  

                    <h6><?php echo $arr_data['comment']; ?></h6>
                    <small>By <?php echo $rowarr['f_name']." ".$rowarr['l_name']; ?><span> on</span> <?php echo $arr_data['post_date']; ?></small>
                   </div>
                </div>
                <hr class="hr">
                <?php 
                  }
                     }
                   }else{
                      echo "<center><h3>".$lang['txt73']."</h3></center><br>";
                   }
                   ?>
              
            </div>
        </div>
    </div>
<footer>
  <h6><div class="lang_btn">
     <?php echo $lang['lang']; ?>: <a href="see_review.php?lang=en">EN | </a><a href="see_review.php?lang=hi">हिन्दी</a><a href="see_review.php?lang=ur"> | اردو</a>
   </div></h6>
</footer>
<script src="js/script.js"></script>

</body>
</html>