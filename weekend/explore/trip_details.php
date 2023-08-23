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
                           <?php echo $lang['lang']; ?>: <a href="trip_details.php?lang=en">EN | </a><a href="trip_details.php?lang=hi">हिन्दी</a><a href="trip_details.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
           
          <a href="trip_tbl.php?lang=<?php echo $set_lang; ?>"> <i class="fa fa-arrow-left"></i></a>
              <div class="form-div">
             <!-- content start -->


                  <div class="container">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home"><?php echo $lang['detl'];?></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1"><?php echo $lang['sch'];?></a>
                      </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="home" class="container tab-pane active"><br>
                        
                             <div class="form-design ">
            
                                     <?php 
                                         $Obj=new clsWeekendPlans();
                                         $result=$Obj->UserWeekendPlans($weekend_id);
                                         $data=array();
                                         foreach ($result as $data) {
                                       ?>

                                 <h2 class="txt_color"><?php echo $data['trip_name'];?></h2>
                                     <hr>
                                   <p><?php echo $lang['pick'];?> <b>:</b>  <?php echo $data['pickup_point']; ?></p>
                                   <p><?php echo $lang['arr_t'];?> <b>:</b> Before  <?php echo $data['arrival_time']; ?></p>
                                   <p><?php echo $lang['fr'];?><b>:</b> <?php echo $data['start_date']; ?></p>
                                   <p><?php echo $lang['to'];?><b>:</b>  <?php echo $data['end_date']; ?></p>
                                   <p><?php echo $lang['dest'];?> <b>:</b> <?php echo $data['destination']; ?></p>
                                   <p><?php echo $lang['fe_per'];?> <b>:</b> <?php echo $data['fee_charges']; ?></p>
                                   <p><?php echo $lang['group']; ?> <b>:</b> <?php echo $data['members']; ?></p>
                                   <p><?php echo $lang['book_lim']; ?> <b>:</b> <?php echo $data['booking_member']; ?></p>
                                   <p><?php echo $lang['int'];?> <b>:</b> <?php echo $data['cmn_interest']; ?></p>   
                                   <p><?php echo $lang['stay'];?> <b>:</b> <?php echo $data['stay_address']; ?></p>
                                   <p><?php echo $lang['pos'];?><b>:</b> <?php echo $data['post_date']; ?></p>
                                   <p><?php echo $lang['note'];?> <b>:</b></p>    
                                   <textarea class="form-control" rows="5"><?php echo $data['note']; ?></textarea>
                                   <?php } ?>
                             </div>


                      </div>
                          <div id="menu1" class="container tab-pane fade"><br>
                        
                                    <div class="form-design">
            
                                 <h2 class="txt_color"><?php echo $lang['trip_sch']; ?></h2>
                                     <hr>
                                    <table class="table table-light table-hover">
                                      <tr>
                                        <th><?php echo $lang['loc']; ?></th>
                                        <th><?php echo $lang['event']; ?></th>
                                      </tr>
                                    <?php 
                                        $FunObj=new clsSchedule();
                                        $sol=$FunObj->UserSchedule($weekend_id);
                                        $row=array();
                                        foreach ($sol as $row) {
                                         
                                     ?>
                                      <tr>
                                        <td><?php echo $row['location']; ?></td>
                                        <td><?php echo $row['event']; ?></td>
                                      </tr>
                                 <?php } ?>
                                    </table>
                
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
      </script>
</body>
</html>