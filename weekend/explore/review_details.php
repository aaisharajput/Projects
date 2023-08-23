<?php session_start();
 
     require_once('php/code.php');
     $weekend_id=$_SESSION['weekend_id'];

     $u_id=$_SESSION['u_id'];
     $U_Obj=new clsUser();
     $fun=$U_Obj->GetUserDetail($u_id);
     $arr=array();
     $profile_pic="";
     foreach ($fun as $arr) {
        $a_name=$arr['f_name']." ".$arr['l_name'];
        $profile_pic=$arr['profile_pic'];
     }

 ?>

<!DOCTYPE html>
<html>
<head>
  <title></title>

  <?php include'links/links.php'; ?>

    <link rel="stylesheet" href="css/review_details.css">



</head>
<body>

     <div class="container-fluid">
      <div class="row">
            <?php include'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

               <div class="row dash_content">
                  <div class="col-12 header">
                    <div>
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['rev_w'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo  $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="review_details.php?lang=en">EN | </a><a href="review_details.php?lang=hi">हिन्दी</a><a href="review_details.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
            <a href="review_tbl.php?lang=<?php echo $set_lang; ?>"> <i class="fa fa-arrow-left"></i></a>
              <div class="form-div">
             <!-- content start -->

 
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

              <h1><?php echo $data['trip_name']; ?></h1>
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
                    <h6><?php echo $count_r; ?> Reviews</h6>
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
                   <?php 
                     
                     ?>

                    <h6><?php echo $arr_data['comment']; ?></h6>
                    <small>By <?php echo $rowarr['f_name']." ".$rowarr['l_name']; ?><span> on</span> <?php echo $arr_data['post_date']; ?></small>
                   </div>
                   <div class="edit">
                      <button class="btn btn-danger" value="<?php echo $arr_data['review_id']; ?>" onclick="delete_review(this);"><?php echo $lang['del'];?></button>
                   </div>
                </div>
                <hr class="hr">
                <?php 
                  }
                     }
                   }else{
                      echo "<center><h3>".$lang['no_review']."</h3></center><br>";
                   }
                   ?>
              
            </div>
        </div>
             
    </div>

            <!--content end-->
            </div>
                   
               </div>
               
                  <div>
                    
                  </div>
               </div>

           </div>
        </div>
     </div>
     <script src="js/main.js"></script>

      <script>
        function show(){
             document.getElementById('sidebar').classList.toggle('open');
         }


   function delete_review(id)
    {
       var review_id=$(id).val();
       var action="delete_review";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {delete_review:action,review_id:review_id},
                      success: function(data){
                         window.location.href="review_details.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }

      </script>
</body>
</html>