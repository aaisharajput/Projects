<?php session_start();
 
     require_once('../php/code.php');
     include'../select_lang.php';
      $u_id= $_SESSION['u_id'];
      $weekend_id=$_SESSION['weekend_id'];
   
      $B_Obj=new clsPlanPurchase();
      $l_result=$B_Obj->CheckBookingLimit($weekend_id);
        $l_arr=array();
        $book_mem="";
        if ($l_result) {
          foreach ($l_result as $l_arr) {
           $book_mem=$l_arr['sum(member_booking)'];
          }
       }
        
 $msg="";
    if (isset($_POST['booked'])) {
            $Prp=new clsPlanPurchasePrp;
            $Prp->P_u_id=$u_id;
            $Prp->P_plan_id=$weekend_id;
            $Prp->P_booking_member=$_POST['member'];
     
            $check_exist=$B_Obj->AlreadyBooked($u_id,$weekend_id);
            
            if (!$check_exist){
                $booking_details=$B_Obj->UserTripBooking($Prp);
                 $msg=$lang['txt45'];
                 header("Refresh:1");
            }
            
     }

   



     

      $check_exist=$B_Obj->AlreadyBooked($u_id,$weekend_id);
       if ($check_exist){
                $booked_plan="1";
            }else{
                 $booked_plan= $lang['book_now'];
            }
      $FunObj=new clsWeekendPlans();
      $result=$FunObj->UserWeekendPlans($weekend_id);
       
        $Obj=new clsTripGallery();
        $S_Obj=new clsSchedule();
          $arr=array();                
          $data=array();
          $row=array();
        foreach ($result as $data) {
                   
         $sol=$Obj->Gallery($weekend_id);
        
 ?>
 <!DOCTYPE html>
<html lang="en">
   <head>
      
      <title></title>
   <?php include'../links/links.php'; ?>
    
          <link rel="stylesheet" href="css/trip-details.css">
   </head>
   <body>
     <?php include'title_bar.php'; ?>

    
 <div class="container">
   <div class="row">
     <div class="col-md-12">
        <?php 
            if ($msg) {
             ?>
             <div class="alert alert-success text-center"><?php echo $msg; ?></div>
             <?php 
            }
            ?>
      <div class="title1">
       <h2>   <a href="new-trip.php?lang=<?php echo $set_lang; ?>"><i class="fa fa-arrow-left"></i></a> <?php echo $data['trip_name']; ?></h2>
       <h6><i class="fa fa-map-marker"></i> <?php echo $data['destination']; ?></h6>
       <hr>
     </div>
     </div>
     <div class="col-md-12">
       <div class="summary">
         <div>
           <h5> <i class="fa fa-clock"></i> <?php echo $lang['txt46']; ?></h5>
           <h6><?php echo $data['start_date']; ?> --> <?php echo $data['end_date']; ?></h6>
         </div>
          <div>
           <h5><i class="fa fa-user"></i> <?php echo $lang['group']; ?></h5>
           <h6><?php echo $data['members']; ?></h6>
         </div>
          <div>
           <h5><i class="fa fa-money"></i> <?php echo $lang['txt27']; ?></h5>
           <h6><?php echo $data['fee_charges']; ?></h6>
         </div>
       </div>
     </div>
     <div class="col-md-12">
      <div class="video">
       <div class="img-container">
         <img src="../img/images.jpg" id="image">
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
     </div>
     <div class="col-md-12">
       <div class="book">
        <form method="post">  
         <p><?php echo $lang['txt47']; ?>: 
           <select class="form-control" name="member">
     <?php  
            $limit=$data['booking_member'];
            for ($i = 1; $i <= $limit; $i++) {
        ?>       
           <option><?php echo $i; ?></option>
         <?php } ?>  
         </select>
         </p>
         <?php
         if ($book_mem>=$data['members']) {
          ?>
          <div class="btn btn-danger"><?php echo $lang['txt48']; ?></div>
         <?php
           
         }
          else if ($booked_plan==1) {
             ?>
          <div class="btn btn-primary"><?php echo $lang['txt49']; ?></div>
             <?php
                } else{
         ?>

         <button class="btn btn-primary" name="booked"><?php echo $booked_plan; ?></button>
       <?php } ?>
          &emsp;<?php 
                if ($book_mem) {
                   echo $book_mem."/".$data['members']; 
                 }else{
                  echo "0"."/".$data['members'];
                 }  
          ?>
         <hr>
         </form> 
       </div>
     </div>
     <div class="col-md-12">
       <div class="title">
         <h2><?php echo $lang['txt52']; ?></h2>
       </div>
       <div class="main-container">
              <div class="details">
                <div>
                 <p><?php echo $lang['txt25']; ?>:<span> <?php echo $data['trip_name']; ?></span></p>
                 <p><?php echo $lang['txt32']; ?>:<span> <?php echo $data['start_date']; ?></span></p>
                 <p><?php echo $lang['txt27']; ?>:<span> <?php echo $data['fee_charges']; ?></span></p>
                 <p><?php echo $lang['txt33']; ?>:<span> <?php echo $data['pickup_point']; ?></span></p>
               </div>
               <div>
                 <p><?php echo $lang['txt26']; ?>:<span> <?php echo $data['destination']; ?></span></p>
                 <p><?php echo $lang['txt35']; ?>:<span> <?php echo $data['cmn_interest']; ?></span></p>
                 <p><?php echo $lang['group']; ?>:<span> <?php echo $data['members']; ?></span></p>
                 <p><?php echo $lang['txt38']; ?>:<span> <?php echo $data['arrival_time']; ?></span></p>
               </div>
              </div>
              <p><?php echo $lang['txt40']; ?>:<span> <?php echo $data['note']; ?></span></p>
              <hr>
            </div>
     </div>

     <div class="col-md-12">
       <div class="title">
        <h2><?php echo $lang['txt41']; ?></h2>
      </div>
        <div id="accordion">
           
           <?php
                
            $s_result=$S_Obj->UserSchedule($weekend_id);
                  
               foreach ($s_result as $arr){
           ?>

          <div class="card">
            <div class="card-header">
               <a class="card-link" data-toggle="collapse" href="#collapse<?php echo $arr['s_no']; ?>">
                <?php echo $lang['txt42']; ?>: <?php echo $arr['location']; ?>
               </a>
             </div>
            <div id="collapse<?php echo $arr['s_no']; ?>" class="collapse show" data-parent="#accordion">
              <div class="card-body">
               <img src="../schedule/<?php echo $arr['photo']; ?>">
               <div class="event"><?php echo $arr['event']; ?></div>
              </div>
            </div>
           </div><br>

             <?php    
                  }
              ?>

         </div>
     </div>
     <div class="col-md-12">
       <div class="title">
        <h2><?php echo $lang['txt50']; ?></h2>
      </div>
      <div class="map">
         <iframe src="https://www.google.com/maps/embed?pb=<?php echo $data['map']; ?>" width="100%" height="300" frameborder="0" style="border:0; outline:none;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
              <?php    
                 }
              ?>
      </div>
     </div>
   </div>
 </div>



<footer>
  <h6><div class="lang_btn">
     <?php echo $lang['lang']; ?>: <a href="trip-details.php?lang=en">EN | </a><a href="trip-details.php?lang=hi">हिन्दी</a><a href="trip-details.php?lang=ur"> | اردو</a>
   </div></h6>
</footer>
<script src="js/script.js"></script>
   </body>
</html>


