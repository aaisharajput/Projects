<?php session_start();
 
     require_once('php/code.php'); 
     include'new.php';
   $msg="";
   $msg2="";

     if (isset($_POST['weekend_add'])) {
          $Prp=new clsWeekendPlansPrp();
        
          $Prp->P_trip_name=$_POST['trip_name'];
          $Prp->P_pickup_point=$_POST['pickup'];
          $Prp->P_arrival_time=$_POST['arrival'];
          $Prp->P_start_date=$_POST['start_date'];
          $Prp->P_end_date=$_POST['end_date'];
          $Prp->P_destination=$_POST['destination'];
          $Prp->P_fee_charges=$_POST['fee'];
          $Prp->P_members=$_POST['member'];
          $Prp->P_booking_member=$_POST['limit'];
          $Prp->P_stay_address=$_POST['stay'];
          $Prp->P_cmn_interest=$_POST['interest'];
          $Prp->P_note=$_POST['note'];
          $Prp->P_map=$_POST['map'];

           
           $Obj=new clsWeekendPlans();
           $insert=$Obj->InsertTrip($Prp);
           if ($insert) {
             $msg=$lang['text_7'];;
            header("Refresh:1");

           }else{
            $msg2=$lang['text_8'];;
           }
       }




      if (isset($_POST['delete'])){
        $delete_sch=$FunObj->DeleteTrip($weekend_id);
        $delete_trip=$Obj->DeleteTrip($weekend_id);
        if ($delete_trip) {
           header("Location:new_trip_tbl.php?lang=$set_lang");
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

<?php include 'links/links.php'; ?>

    <link rel="stylesheet" href="css/new_trip_tbl.css">

</head>
<body>

     <div class="container-fluid">
      <div class="row">
             <?php include 'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

               <div class="row dash_content">
                  <div class="col-12 header">
                    <div>
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['c_trip'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo  $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="new_trip_tbl.php?lang=en">EN | </a><a href="new_trip_tbl.php?lang=hi">हिन्दी</a><a href="new_trip_tbl.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
           
              <div class="form-div">
             <!-- content start -->
                     <?php if ($msg) { ?>
                                  <div class="alert alert-success text-center">
                                    <?php echo $msg; ?><?php echo $msg="" ; ?>
                                  </div>
                                <?php } ?>
                         <?php if ($msg2) { ?>
                                  <div class="alert alert-danger text-center">
                                    <?php echo $msg2; ?><?php echo $msg2="" ; ?>
                                  </div>
                                <?php } ?>
                                         

                  <div class="container">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home"><?php echo $lang['detl'];?></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1"><?php echo $lang['add_tr'];?></a>
                      </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="home" class="container tab-pane active"><br>
                        
                             <div class="main-div ">
                           <h1><?php echo $lang['recent'];?></h1>
                           <div>
                       
                         </div>
                            <div class="table-responsive">
      
                              <table class="table table-light table-hover table-striped" >
                                  <tr class="sticky">
                                      <th><b><?php echo $lang['trip_nm'];?></b></th>
                                      <th><b><?php echo $lang['dest'];?></b></th>
                                      <th><b><?php echo $lang['dat'];?></b></th>
                                      <th><?php echo $lang['opera'];?></th>
                                  </tr>
                                  <?php  
                                       $c_date=date("Y-m-d");
                                       $Obj=new clsWeekendPlans();
                                       $result=$Obj->NewWeekendPlans($c_date);
                                       $data=array();
                                       foreach ($result as $data) {
                                         
                                  ?>
                                 <tr>
                                      <td><?php echo $data['trip_name']; ?></td>
                                      <td><?php echo $data['destination']; ?> </td>
                                      <td><?php echo $data['start_date']; ?> </td>
                                      <td><button  class="btn btn-success" value="<?php echo $data['plan_id']; ?>" onclick="get_details(this);"><?php echo $lang['see_m'];?></button></td>
                                 </tr>
                             <?php } ?>
                             
                     
                           </table>
                    </div>
               </div>  


                      </div>
       
                       <div id="menu1" class="container tab-pane fade"><br>
                        
                               <div class="form-design">
            
                                 <h2 class="txt_color"><?php echo $lang['add_n_tr'];?> </h2>
                                     <hr>
                              <form method="POST">
                             <table class="table insert">
                                  <tr>
                                   <td><?php echo $lang['trip_n'];?><b>:</b> </td>
                                   <td> <input type="text" name="trip_name" class="form-control" required></td>
                                 </tr>
                                 <tr>
                                   <td><?php echo $lang['pick'];?><b>:</b> </td>
                                   <td> <input type="text" name="pickup" class="form-control" required></td>
                                 </tr>
                                 <tr>
                                   <td><?php echo $lang['arr_t'];?><b>:</b> </td>
                                   <td> <input type="time" name="arrival" class="form-control" required></td>
                                 </tr>
                                 <tr>
                                   <td> <?php echo $lang['fr'];?><b>:</b></td>
                                   <td>  <input type="date" name="start_date" class="form-control" required></td>
                                 </tr>
                                 <tr>
                                   <td><?php echo $lang['to'];?> <b>:</b> </td>
                                   <td> <input type="date" name="end_date" class="form-control" required></td>
                                 </tr>
                                 <tr>
                                   <td><?php echo $lang['dest'];?><b>:</b> </td>
                                   <td> <input type="text" name="destination" class="form-control" required></td>
                                 </tr>
                                 <tr>
                                   <td><?php echo $lang['fe_per'];?><b>:</b> </td>
                                   <td> <input type="number" name="fee" class="form-control" required></td>
                                 </tr>
                                 <tr>
                                   <td><?php echo $lang['group'];?><b>:</b> </td>
                                   <td> <input type="number" name="member" class="form-control" required></td>
                                 </tr>
                                 <tr>
                                   <td><?php echo $lang['book_lim'];?> <b>:</b> </td>
                                   <td> <input type="number" name="limit" class="form-control" required></td>
                                 </tr>
                                 <tr>
                                   <td> <?php echo $lang['int'];?> <b>:</b> </td>
                                   <td> <input type="text" name="interest" class="form-control" required></td>
                                  </tr>
                                 <tr>   
                                   <td><?php echo $lang['stay'];?><b>:</b> </td>
                                   <td> <input type="text" name="stay" class="form-control" required></td>
                                 </tr>
                                 <tr>   
                                   <td><?php echo $lang['map'];?><b>:</b> </td>
                                   <td> <input type="text" name="map" class="form-control" required></td>
                                 </tr>
                            </table>
                                   <p><?php echo $lang['note'];?> <b>:</b></p>
                                   <textarea cols="50" rows="5" name="note" class="form-control"></textarea><br>
                                    <div class="btn-design">  
                                           <button class="btn btn-primary" name="weekend_add"><?php echo $lang['add'];?></button>
                                      </div>
                                </form>

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
        function show(){
             document.getElementById('sidebar').classList.toggle('open');
         }


          function get_details(id)
       {
       var weekend_id=$(id).val();
       var action="trip_review";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {trip_review:action,weekend_id:weekend_id},
                      success: function(data){
                         window.location.href="new_trip_details.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }

      </script>
</body>
</html>