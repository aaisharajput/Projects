<?php session_start();
 
     require_once('../php/code.php');
     $u_id= $_SESSION['u_id'];
    
 ?>
 <!DOCTYPE html>
<html lang="en">
   <head>
      
      <title></title>
 <?php include'../links/links.php'; ?>
    
          <link rel="stylesheet" href="css/booking-history.css">
   </head>
   <body>

     <?php include'title_bar.php'; ?>
     
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
      <h1 class="h1"><?php echo $lang['txt4']; ?></h1><br>
    </div>
    <?php 
        $FunObj=new clsPlanPurchase();
        $result=$FunObj->ShowAllBooking($u_id);
        $Obj=new clsWeekendPlans();
        $W_Obj=new clsSchedule();
        $data=array();
        $row=array();
        $arr=array();
       
   if(!$result) {

       ?>
     <div class="col-md-12">
      <div class="no-trip">
        <h3><?php echo $lang['txt22']; ?></h3>
      </div>
    </div>
    <?php 
       }else{
     
     ?>
    <div class="col-md-12">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#home"><?php echo $lang['txt7']; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu1"><?php echo $lang['txt19']; ?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#menu2"><?php echo $lang['txt24']; ?></a>
            </li>
           
        </ul>
        <br>

      <div class="tab-content">
       <div id="home" class="container tab-pane active">
        <div class="table-responsive">
             <table class="table table-light table-hover table-striped" >
                 <tr class="sticky">
                     <th><b><?php echo $lang['txt25']; ?></b></th>
                     <th><b><?php echo $lang['txt26']; ?></b></th>
                     <th><b><?php echo $lang['txt27']; ?></b></th>
                     <th><b><?php echo $lang['txt28']; ?></b></th>
                     <th><b><?php echo $lang['txt29']; ?></b></th>
                     <th colspan="3"><b><?php echo $lang['txt30']; ?></b></th>
                 </tr>

              <?php 
                  $count=0;
                  $p_date=date("Y-m-d");
                 foreach ($result as $data) {
                   $plan_id=$data['plan_id'];
                   $sol=$Obj->UserWeekendPlans($plan_id);
                   $s_result=$W_Obj->UserSchedule($plan_id);
                   foreach ($sol as $row) {
                   $start_date=$row['start_date'];
                   
                   if ($p_date<$start_date) {

                     $B_Obj=new clsPlanPurchase();
                     $l_result=$B_Obj->CheckBookingLimit($plan_id);
                     $l_arr=array();
                     $count++;
                     $book_mem="";
                     if ($l_result) {
                     foreach ($l_result as $l_arr) {
                      $book_mem=$l_arr['sum(member_booking)'];
                      }
                     }
                  ?>

                 <tr>
                    <td><?php echo $row['trip_name'];  ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td><?php echo $row['fee_charges']; ?></td>
                    <td><?php echo $data['member_booking']; ?></td>
                    <td><?php
                             if ($data['pay_status']==0) {
                                echo $lang['txt24'];
                             }else{
                                 echo $lang['txt19'];
                             }
                              ?>
                                
                    </td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#my<?php echo $plan_id;  ?>"><?php echo $lang['txt52']; ?></button></td>
                    <form method="post">
                      <?php
                             if ($data['pay_status']==0) {
                                if ($book_mem>=$row['members']) {
                                 ?>
                                 <td><button class="btn btn-danger"><?php echo $lang['txt48']; ?></button></td>
                                 <?php
           
                                 }
                                  else{
                             ?>  <td><a><button class="btn btn-success" value="<?php echo $plan_id; ?>" onclick="pay(this);"><?php echo $lang['txt53']; ?></button></td>
                             <?php } ?>
                                 <td><button class="btn btn-danger" value="<?php echo $plan_id; ?>" onclick="cancelTrip(this);"><?php echo $lang['txt54']; ?></button></td>
                             <?php
                             }else{
                             ?>  <td><button class="btn btn-success"><?php echo $lang['txt19']; ?></button></td>
                             <td></td>
                             <?php
                             }
                              ?>
                     </form>
                  </tr>
                 
                   <!-- The Modal -->
   <div class="modal" id="my<?php echo $plan_id;  ?>">
     <div class="modal-dialog  modal-lg">
       <div class="modal-content">

      <!-- Modal Header -->
           <div class="modal-header">
             <h4 class="modal-title"><?php echo $lang['txt31']; ?></h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>

      <!-- Modal body -->
           <div class="modal-body">
            <div class="main-container">
              <div class="details">
                <div>
                 <p><?php echo $lang['txt25']; ?>:<span> <?php echo $row['trip_name'];  ?></span></p>
                 <p><?php echo $lang['txt32']; ?>:<span> <?php echo $row['start_date'];  ?> to <?php echo $row['end_date'];  ?></span></p>
                 <p><?php echo $lang['group']; ?>:<span> <?php echo $row['members'];  ?></span></p>
                 <p><?php echo $lang['txt27']; ?>:<span> <?php echo $row['fee_charges'];  ?></span></p>
                 <p><?php echo $lang['txt33']; ?>:<span> <?php echo $row['pickup_point'];  ?></span></p>
                 <p><?php echo $lang['txt34']; ?>:<span> <?php echo $data['pay_mode'];  ?></span></p>
               </div>
               <div>
                 <p><?php echo $lang['txt26']; ?>:<span> <?php echo $row['destination'];  ?></span></p>
                 <p><?php echo $lang['txt35']; ?>:<span> <?php echo $row['cmn_interest'];  ?></span></p>
                 <p><?php echo $lang['txt36']; ?>:<span> <?php echo $data['member_booking'];  ?></span></p>
                 <p><?php echo $lang['txt37']; ?>:<span> <?php echo $pay=$row['fee_charges']*$data['member_booking'];  ?></span></p>
                 <p><?php echo $lang['txt38']; ?>:<span> <?php echo $row['arrival_time'];  ?></span></p>
                 <p><?php echo $lang['txt39']; ?>:<span> <?php 
                        if ($data['pay_status']==0) {
                                echo $lang['txt24'];
                             }else{
                                 echo $lang['txt19'];
                             }
                  ?></span></p>
               </div>
              </div>
              <p><?php echo $lang['txt40']; ?>:<span> <?php echo $row['note'];  ?></span></p>
              <hr>
              <h4><?php echo $lang['txt41']; ?></h4>
              <hr>
              <div class="details">
                <div>
                 <p><span><?php echo $lang['txt42']; ?></span></p>
                <?php  
                     foreach ($s_result as $arr){
                 ?>
                 <p><?php echo $arr['location'];  ?></p>
                  <?php
                    } 
                  ?>
               </div>
               <div>
                 <p><span><?php echo $lang['txt43']; ?></span></p>

                  <?php  
                     foreach ($s_result as $arr){
                 ?>
                 <p><?php echo $arr['event'];  ?></p>
                  <?php
                    } 
                  ?>

               </div>
              </div>
            </div>
           </div>

          </div>
        </div>
      </div>
              <?php    
                           }else{
                             $msg=$lang['txt44'];
                             }
                       }
                     }
                 ?>
            </table>
            <?php 
               if($count==0){
                   echo $msg;
               }
                ?>
         </div> 
    </div>
    <div id="menu1" class="container tab-pane fade">
      <div class="table-responsive">
             <table class="table table-light table-hover table-striped" >
                 <tr class="sticky">
                     <th><b><?php echo $lang['txt25']; ?></b></th>
                     <th><b><?php echo $lang['txt26']; ?></b></th>
                     <th><b><?php echo $lang['txt27']; ?></b></th>
                     <th><b><?php echo $lang['txt28']; ?></b></th>
                     <th><b><?php echo $lang['txt29']; ?></b></th>
                     <th colspan="2"><b><?php echo $lang['txt30']; ?></b></th>
                 </tr>
                   <?php 
                   $msg="";
                   $count=0;
                  $p_date=date("Y-m-d");
                 foreach ($result as $data) {
                   $plan_id=$data['plan_id'];
                   $Status=$data['pay_status'];
                   if ($Status==1) {
                     
                   $sol=$Obj->UserWeekendPlans($plan_id);
                   $s_result=$W_Obj->UserSchedule($plan_id);
                   $count++;
                   foreach ($sol as $row) {
                   $start_date=$row['start_date'];

                   if ($p_date<$start_date) {
                  ?>

                 <tr>
                    <td><?php echo $row['trip_name'];  ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td><?php echo $row['fee_charges']; ?></td>
                    <td><?php echo $data['member_booking']; ?></td>
                    <td><?php echo $lang['txt19']; ?></td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#my1<?php echo $plan_id;  ?>"><?php echo $lang['txt52']; ?></button></td>
                    <td><button class="btn btn-success"><?php echo $lang['txt19']; ?></button></td>
                  </tr>
                 
                   <!-- The Modal -->
   <div class="modal" id="my1<?php echo $plan_id;  ?>">
     <div class="modal-dialog  modal-lg">
       <div class="modal-content">

      <!-- Modal Header -->
           <div class="modal-header">
             <h4 class="modal-title"><?php echo $lang['txt31']; ?></h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>

      <!-- Modal body -->
           <div class="modal-body">
            <div class="main-container">
              <div class="details">
                <div>
                 <p><?php echo $lang['txt25']; ?>:<span> <?php echo $row['trip_name'];  ?></span></p>
                 <p><?php echo $lang['txt32']; ?>:<span> <?php echo $row['start_date'];  ?> to <?php echo $row['end_date'];  ?></span></p>
                 <p><?php echo $lang['group']; ?>:<span> <?php echo $row['members'];  ?></span></p>
                 <p><?php echo $lang['txt27']; ?>:<span> <?php echo $row['fee_charges'];  ?></span></p>
                 <p><?php echo $lang['txt33']; ?>:<span> <?php echo $row['pickup_point'];  ?></span></p>
                 <p><?php echo $lang['txt34']; ?>:<span> <?php echo $data['pay_mode'];  ?></span></p>
               </div>
               <div>
                 <p><?php echo $lang['txt26']; ?>:<span> <?php echo $row['destination'];  ?></span></p>
                 <p><?php echo $lang['txt35']; ?>:<span> <?php echo $row['cmn_interest'];  ?></span></p>
                 <p><?php echo $lang['txt36']; ?>:<span> <?php echo $data['member_booking'];  ?></span></p>
                 <p><?php echo $lang['txt37']; ?>:<span> <?php echo $pay=$row['fee_charges']*$data['member_booking'];  ?></span></p>
                 <p><?php echo $lang['txt38']; ?>:<span> <?php echo $row['arrival_time'];  ?></span></p>
                 <p><?php echo $lang['txt39']; ?>:<span> <?php echo $lang['txt19']; ?></span></p>
               </div>
              </div>
              <p><?php echo $lang['txt40']; ?>:<span> <?php echo $row['note'];  ?></span></p>
              <hr>
              <h4><?php echo $lang['txt41']; ?></h4>
              <hr>
              <div class="details">
                <div>
                 <p><span><?php echo $lang['txt42']; ?></span></p>
                <?php  
                     foreach ($s_result as $arr){
                 ?>
                 <p><?php echo $arr['location'];  ?></p>
                  <?php
                    } 
                  ?>
               </div>
               <div>
                 <p><span><?php echo $lang['txt43']; ?></span></p>

                  <?php  
                     foreach ($s_result as $arr){
                 ?>
                 <p><?php echo $arr['event'];  ?></p>
                  <?php
                    } 
                  ?>

               </div>
              </div>
            </div>
           </div>

          </div>
        </div>
      </div>
              <?php    
                         }
                       }
                      }else{
                             $msg=$lang['txt44'];
                      }
                     }
                 ?>
            </table>
                <?php 
               if($count==0){
                   echo $msg;
               }
                ?>
               
         </div> 
    </div>
    <div id="menu2" class="container tab-pane fade">
      <div class="table-responsive">
             <table class="table table-light table-hover table-striped" >
                 <tr class="sticky">
                     <th><b><?php echo $lang['txt25']; ?></b></th>
                     <th><b><?php echo $lang['txt26']; ?></b></th>
                     <th><b><?php echo $lang['txt27']; ?></b></th>
                     <th><b><?php echo $lang['txt28']; ?></b></th>
                     <th><b><?php echo $lang['txt29']; ?></b></th>
                     <th colspan="3"><b><?php echo $lang['txt30']; ?></b></th>
                 </tr>
                   <?php 
                   $msg="";
                   $count=0;
                  $p_date=date("Y-m-d");
                 foreach ($result as $data) {
                   $plan_id=$data['plan_id'];
                   $Status=$data['pay_status'];
                   if ($Status==0) {
                     
                   $sol=$Obj->UserWeekendPlans($plan_id);
                   $s_result=$W_Obj->UserSchedule($plan_id);
                   
                   foreach ($sol as $row) {
                   $start_date=$row['start_date'];

                   if ($p_date<$start_date) {
                     $B_Obj=new clsPlanPurchase();
                     $l_result=$B_Obj->CheckBookingLimit($plan_id);
                     $l_arr=array();
                     $book_mem="";
                     $count++;
                     if ($l_result) {
                     foreach ($l_result as $l_arr) {
                      $book_mem=$l_arr['sum(member_booking)'];
                       $count++;
                      }
       }
                  ?>

                 <tr>
                    <td><?php echo $row['trip_name'];  ?></td>
                    <td><?php echo $row['destination']; ?></td>
                    <td><?php echo $row['fee_charges']; ?></td>
                    <td><?php echo $data['member_booking']; ?></td>
                    <td><?php echo $lang['txt24']; ?></td>
                    <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#my2<?php echo $plan_id;  ?>"><?php echo $lang['txt52']; ?></button></td>
                    <form method="post">
                   <?php    if ($book_mem>=$row['members']) {
                                 ?>
                                <td> <button class="btn btn-danger"><?php echo $lang['txt48']; ?></button></td>
                                 <?php
           
                                 }
                                  else{
                             ?>  <td><a><button class="btn btn-success" value="<?php echo $plan_id; ?>" onclick="pay(this);"><?php echo $lang['txt53']; ?></button></td>
                             <?php } ?>
                      <td><button class="btn btn-danger" value="<?php echo $plan_id; ?>" onclick="cancelTrip(this);"><?php echo $lang['txt54']; ?></button></td>
                     </form>
                  </tr>
                 
                   <!-- The Modal -->
   <div class="modal" id="my2<?php echo $plan_id;  ?>">
     <div class="modal-dialog  modal-lg">
       <div class="modal-content">

      <!-- Modal Header -->
           <div class="modal-header">
             <h4 class="modal-title"><?php echo $lang['txt31']; ?></h4>
             <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>

      <!-- Modal body -->
           <div class="modal-body">
            <div class="main-container">
              <div class="details">
                <div>
                 <p><?php echo $lang['txt25']; ?>:<span> <?php echo $row['trip_name'];  ?></span></p>
                 <p><?php echo $lang['txt32']; ?>:<span> <?php echo $row['start_date'];  ?> to <?php echo $row['end_date'];  ?></span></p>
                 <p><?php echo $lang['group']; ?>:<span> <?php echo $row['members'];  ?></span></p>
                 <p><?php echo $lang['txt27']; ?>:<span> <?php echo $row['fee_charges'];  ?></span></p>
                 <p><?php echo $lang['txt33']; ?>:<span> <?php echo $row['pickup_point'];  ?></span></p>
                 <p><?php echo $lang['txt34']; ?>:<span> <?php echo $data['pay_mode'];  ?></span></p>
               </div>
               <div>
                 <p><?php echo $lang['txt26']; ?>:<span> <?php echo $row['destination'];  ?></span></p>
                 <p><?php echo $lang['txt35']; ?>:<span> <?php echo $row['cmn_interest'];  ?></span></p>
                 <p><?php echo $lang['txt36']; ?>:<span> <?php echo $data['member_booking'];  ?></span></p>
                 <p><?php echo $lang['txt37']; ?>:<span> <?php echo $pay=$row['fee_charges']*$data['member_booking'];  ?></span></p>
                 <p><?php echo $lang['txt38']; ?>:<span> <?php echo $row['arrival_time'];  ?></span></p>
                 <p><?php echo $lang['txt39']; ?>:<span> <?php echo $lang['txt24']; ?></span></p>
               </div>
              </div>
              <p><?php echo $lang['txt40']; ?>:<span> <?php echo $row['note'];  ?></span></p>
              <hr>
              <h4><?php echo $lang['txt41']; ?></h4>
              <hr>
              <div class="details">
                <div>
                 <p><span><?php echo $lang['txt42']; ?></span></p>
                <?php  
                     foreach ($s_result as $arr){
                 ?>
                 <p><?php echo $arr['location'];  ?></p>
                  <?php
                    } 
                  ?>
               </div>
               <div>
                 <p><span><?php echo $lang['txt43']; ?></span></p>

                  <?php  
                     foreach ($s_result as $arr){
                 ?>
                 <p><?php echo $arr['event'];  ?></p>
                  <?php
                    } 
                  ?>

               </div>
              </div>
            </div>
           </div>

          </div>
        </div>
      </div>
              <?php    
                         }
                       }
                      }else{
                             $msg=$lang['txt44'];
                      }
                     }
                 ?>
            </table>
                <?php 
               if($count==0){
                   echo $msg;
               }
                ?>
           </div> 
          </div>
 
        </div>

       </div>

    </div>
  </div>

       <?php  
          }
        ?>

<footer>
  <h6><div class="lang_btn">
     <?php echo $lang['lang']; ?>: <a href="trip-booked.php?lang=en">EN | </a><a href="trip-booked.php?lang=hi">हिन्दी</a><a href="trip-booked.php?lang=ur"> | اردو</a>
   </div></h6>
</footer>
<script type="text/javascript">
  
   function cancelTrip(id)
    {  
       var weekend_id=$(id).val();
       var action="delete_trip";
       $.ajax({
                     type: 'POST',
                     url: '../php/session.php',
                     data: {delete_trip:action,weekend_id:weekend_id},
                      success: function(data){
                         window.location.href="trip-booked.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }
    function pay(id)
    {  
       var plan_id=$(id).val();
       var action="getplan_id";
       $.ajax({
                     type: 'POST',
                     url: '../php/session.php',
                     data: {getplan_id:action,plan_id:plan_id},
                      success: function(data){
                         window.location.href="payment.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }

</script>
   </body>
</html>
