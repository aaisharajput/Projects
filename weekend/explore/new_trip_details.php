<?php session_start();
 
     require_once('php/code.php');
     include'new.php';
       $weekend_id=$_SESSION['weekend_id'];
      
      $msg="";
      $msg2="";
      $Obj=new clsWeekendPlans();
      $FunObj=new clsSchedule();
      $R_Fun=new clsReview();
      $p_obj=new clsPlanPurchase();
      $G_Obj=new clsTripGallery();
        $result=$Obj->UserWeekendPlans($weekend_id);
        $data=array();
        foreach ($result as $data) {

          $pickup_point=$data['pickup_point'];
          $arrival_time=$data['arrival_time'];
          $start_date=$data['start_date'];
          $end_date=$data['end_date'];
          $destination=$data['destination'];
          $fee_charges=$data['fee_charges'];
          $members=$data['members'];
          $booking_member=$data['booking_member'];
          $cmn_interest=$data['cmn_interest'];
          $stay_address=$data['stay_address'];
          $note=$data['note'];
          $post_date=$data['post_date'];

        }

    

     if (isset($_POST['update'])) {
          $Prp=new clsWeekendPlansPrp();
          $Prp->P_pickup_point=$_POST['pick'];
          $Prp->P_arrival_time=$_POST['time'];
          $Prp->P_start_date=$_POST['s_date'];
          $Prp->P_end_date=$_POST['e_date'];
          $Prp->P_destination=$_POST['destination'];
          $Prp->P_fee_charges=$_POST['fee'];
          $Prp->P_members=$_POST['member'];
          $Prp->P_booking_member=$_POST['limit'];
          $Prp->P_stay_address=$_POST['stay'];
          $Prp->P_cmn_interest=$_POST['interest'];
          $Prp->P_note=$_POST['note'];
           
           $update_result=$Obj->UpdateTrip($Prp,$weekend_id);
           if ($update_result) {
             $msg=$lang['text_3'];;
             header("refresh: 1");
           }else{
            $msg=$lang['text_4'];;
           }
       }


      if (isset($_POST['delete'])){
        $delete_sch=$FunObj->DeleteTrip($weekend_id);
        $G_Obj->DeleteTrip($weekend_id);
        $R_Fun->DeleteTrip($weekend_id);
        $p_obj->DeleteTrip($weekend_id);
        $delete_trip=$Obj->DeleteTrip($weekend_id);
        if ($delete_trip) {
           header("Location:new_trip_tbl.php?lang=$set_lang");
        }
      } 



     if (isset($_POST['schedule_add'])) {
            $Prp=new clsWeekendPlansPrp();
        
          $Prp->P_location=$_POST['location'];
          $Prp->P_event=$_POST['event'];
          $Prp->P_photo=$_FILES['file']['name'];
          $Prp->P_plan_id=$weekend_id;

             $S_Obj=new clsSchedule();
             $S_result=$S_Obj->InsertTrip($Prp);

       $img_name=$_FILES['file']['name'];
       $tmp_name=$_FILES['file']['tmp_name'];
       $file_path="../schedule/";

        move_uploaded_file($tmp_name,$file_path.$img_name);

          if ($S_result) {
               $msg=$lang['text_9'];
               header("refresh: 1");
             }
     }


     if (isset($_POST['gallery_add'])) {
       $Prp=new clsTripGalleryPrp();
       $Prp->P_source=$_POST['sel_pic'];
       $Prp->P_plan_id=$weekend_id;
       $res=$G_Obj->InsertImage($Prp);

       $img_name=$_FILES['photo']['name'];
       $tmp_name=$_FILES['photo']['tmp_name'];
       $file_path="../img/";

        move_uploaded_file($tmp_name,$file_path.$img_name);
      

       if ($res) {
         $msg=$lang['text_10'];
         header("refresh: 1");
         }

     }

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
  <link rel="stylesheet"  href="css/trip_details.css">

</head>
<body>

     <div class="container-fluid">
      <div class="row">
          <?php include'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

               <div class="row dash_content">
                  <div class="col-12 header">
                    <div>
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['trip_d'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo  $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="new_trip_details.php?lang=en">EN | </a><a href="new_trip_details.php?lang=hi">हिन्दी</a><a href="new_trip_details.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
           
          <a href="new_trip_tbl.php?lang=<?php echo $set_lang; ?>"> <i class="fa fa-arrow-left"></i></a>
              <div class="form-div">
             <!-- content start -->
                                <?php if ($msg) { ?>
                                  <div class="alert alert-success text-center">
                                    <?php echo $msg; ?><?php echo $msg="" ; ?>
                                  </div>
                                <?php } ?>
                             

                  <div class="container">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home"><?php echo $lang['detl'];?></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1"><?php echo $lang['sch'];?></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu2"><?php echo $lang['add_sch']; ?></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu3"><?php echo $lang['add_gal']; ?></a>
                      </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="home" class="container tab-pane active"><br>
                        
                             <div class="form-design ">
                                     
                                   <form method="post">
                                 <h2 class="txt_color"><?php echo $data['trip_name'];?></h2>
                                     <hr>
                                   <p><?php echo $lang['pick'];?> <b>:</b> <input type="text" name="pick" value="<?php echo $pickup_point; ?>" class="form-control"> </p>
                                   <p><?php echo $lang['arr_t'];?> <b>:</b><input type="text" name="time" value="<?php echo $arrival_time; ?>" class="form-control"> </p>
                                   <p><?php echo $lang['fr'];?><b>:</b><input type="date" name="s_date" value="<?php echo $start_date; ?>" class="form-control"> </p>
                                   <p><?php echo $lang['to'];?><b>:</b><input type="date" name="e_date" value="<?php echo $end_date; ?>" class="form-control">  </p>
                                   <p><?php echo $lang['dest'];?> <b>:</b> <input type="text" name="destination" value="<?php echo $destination; ?>" class="form-control"></p>
                                   <p><?php echo $lang['fe_per'];?> <b>:</b><input type="number" name="fee" value="<?php echo $fee_charges; ?>" class="form-control"> </p>
                                   <p><?php echo $lang['group']; ?> <b>:</b> <input type="number" name="member" value="<?php echo $members; ?>" class="form-control"></p>
                                   <p><?php echo $lang['book_lim']; ?>  <b>:</b><input type="number" name="limit" value="<?php echo $booking_member; ?>" class="form-control"> </p>
                                   <p><?php echo $lang['int'];?> <b>:</b><input type="text" name="interest" value="<?php echo $cmn_interest; ?>" class="form-control"></p>   
                                   <p><?php echo $lang['stay'];?> <b>:</b><input type="text" name="stay" value="<?php echo $stay_address; ?>" class="form-control"> </p>
                                   <p><?php echo $lang['pos'];?><b>:</b> <?php echo $post_date; ?></p>
                                   <p><?php echo $lang['note'];?> <b>:</b></p>    
                                   <textarea class="form-control" rows="5" name="note"><?php echo $note; ?></textarea>
                                   <div class="btn-design">  
                                    <button class="btn btn-success" name="update"><?php echo $lang['up'];?></button>&emsp;&emsp;&emsp;
                                    <button class="btn btn-danger" name="delete"><?php echo $lang['delt'];?></button>
                                   </div>
                           
                                 </form>
                             </div>


                      </div>
                          <div id="menu1" class="container tab-pane fade"><br>
                        
            
                                 <h2 class="txt_color"><?php echo $lang['trip_sch']; ?></h2>
                                     <hr>
                                    <table class="table table-light table-hover">
                                      <tr>
                                        <th><?php echo $lang['loc']; ?></th>
                                        <th><?php echo $lang['event']; ?></th>
                                        <th colspan="2"><?php echo $lang ['oper']; ?></th>
                                      </tr>
                                    <?php 
                                        
                                        $sol=$FunObj->UserSchedule($weekend_id);
                                        $row=array();
                                        if ($sol) {
                                            foreach ($sol as $row) {
                                         
                                     ?>
                                     
                                      <tr>
                                        <td><input type="text" class="form-control" id="loc" value="<?php echo $row['location']; ?>"></td>
                                        <td><input type="text" class="form-control" id="event" value="<?php echo $row['event']; ?>"></td>
                                        <td> <button class="btn btn-success" value="<?php echo $row['s_no'];  ?>" onclick="update_schedule(this);"><?php echo $lang['up'];?></button></td>
                                        <td><button class="btn btn-danger" value="<?php echo $row['s_no'];  ?>" onclick="delete_schedule(this);"><?php echo $lang['delt'];?></button></td>
                                      </tr>
                                 <?php
                                   }
                                     }else{
                                       $msg2=$lang['data_not_found'];
                                     }

                                      ?>
                                    </table>
                                     <?php if ($msg2) { ?>
                                  <h5>
                                    <?php echo $msg2; ?><?php echo $msg2="" ; ?>
                                  </h5>
                                <?php } ?>
                       </div>
                       <div id="menu2" class="container tab-pane fade"><br>

                         <h2 class="txt_color"><?php echo $lang['add_sch']; ?></h2>
                                     <hr>
                                  <form method="POST" enctype="multipart/form-data">
                                    <table class="table insert">
                                      <tr>
                                        <th><?php echo $lang['loc']; ?></th>
                                        <th><?php echo $lang['event']; ?></th>
                                        <th><?php echo $lang['img']; ?></th>
                                      </tr>                                     
                                      <tr>
                                        <td><input type="text" name="location" class="form-control"></td>
                                        <td><input type="text" name="event" class="form-control"></td>
                                        <td><input type="file" name="file" class="form-control-file border"></td>
                                      </tr>
                                    </table>
                                      <div class="btn-design">  
                                           <button class="btn btn-primary" name="schedule_add"><?php echo $lang['add']; ?></button>
                                      </div>
                                    </form>
                       </div>
                       <div id="menu3" class="container tab-pane fade"><br>
                           <h2 class="txt_color"><?php echo $lang['add_gal']; ?></h2>
                                     <hr>
                                  <form method="POST" class="text-center" enctype="multipart/form-data">
                                                                       
                                       <input type="file" name="photo" id="pic" class="form-control-file border" onchange="show1();" required hidden>
                                      <label for="pic"><i class="fa fa-plus"></i></label><br>
                                      <input type="text" id="pic_name" name="sel_pic" readonly>
                                      <div class="btn-design">  
                                           <button class="btn btn-primary" name="gallery_add"><?php echo $lang['add']; ?></button>
                                      </div>
                                    </form>

                                 <div class="image-container">
                                  <?php 
                                      
                                      $g_result=$G_Obj->Gallery($weekend_id);
                                      $arr=array();
                                      foreach ($g_result as $arr) {
                                    
                                  ?>
                                   <img src="../img/<?php echo $arr['source']; ?>">
                                   <button class="btn" value="<?php echo $arr['gallery_id']; ?>" onclick="delete_gallery(this);"><i class="fas fa-times"></i></button>

                                 <?php 
                                    }
                                 ?>
                                 </div>   
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
      <script>
        function show1(){
         var a=document.getElementById('pic').value;
         a=a.substring(12);
           document.getElementById('pic_name').value=a;

         }


        function show(){
             document.getElementById('sidebar').classList.toggle('open');
         }

          function update_schedule(id){


           var location=$(id).parents('tr').find("#loc").val();
           var event=$(id).parents('tr').find("#event").val();
           var s_no=$(id).val();
           var action="update_schedule";
  
             $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {update_schedule:action,s_no:s_no,location:location,event:event},
                      success: function(data){
                         window.location.href="new_trip_details.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
               

         }

         function delete_schedule(id){

           var s_no=$(id).val();
           var action="delete_schedule";
  
             $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {delete_schedule:action,s_no:s_no},
                      success: function(data){
                         window.location.href="new_trip_details.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
               

         }


         function delete_gallery(id){
            var gallery_id=$(id).val();
           var action="delete_gallery";
  
             $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {delete_gallery:action,gallery_id:gallery_id},
                      success: function(data){
                         window.location.href="new_trip_details.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
         }
      </script>
</body>
</html> 