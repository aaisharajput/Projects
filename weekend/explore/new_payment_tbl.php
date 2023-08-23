<?php session_start();
  error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
     require_once('php/code.php');
     $msg="";
   $u_id=$_SESSION['u_id'];
     $Obj=new clsUser();
     $fun=$Obj->GetUserDetail($u_id);
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

    <link rel="stylesheet" href="css/table-style.css">

</head>
<body>

     <div class="container-fluid">
      <div class="row">
          <?php include'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

               <div class="row dash_content">
                  <div class="col-12 header">
                    <div>
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['trans'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo  $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="new_payment_tbl.php?lang=en">EN | </a><a href="new_payment_tbl.php?lang=hi">हिन्दी</a><a href="new_payment_tbl.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
          <!-- content start -->
          <br>
                    <div class="main-div ">
                           <h1><?php echo $lang['new_tr_det'];?></h1>
                            <div class="table-responsive">
      
                              <table class="table table-light table-hover table-striped" >
                                  <tr class="sticky">
                                      <th><b><?php echo $lang['trip_n'];?></b></th>
                                      <th><b><?php echo $lang['fee'];?></b></th>
                                      <th><b><?php echo $lang['mem'];?></b></th>
                                      <th><b><?php echo $lang['p_memb'];?></b></th>
                                      <th><?php echo $lang['opera'];?></th>
                                  </tr>
                                  <?php 
                                  $p_date=date("Y-m-d");
                                      $obj=new clsWeekendPlans();
                                      $result=$obj->NewWeekendPlans($p_date);
                                      
                                      if ($result) {
                                        $data=array();
                                        foreach ($result as $data) {
                                            $plan_id=$data['plan_id'];      
                                           $FunObj=new clsPlanPurchase();
                                           $sol=$FunObj->PaidUserCount($plan_id);
                                            $vari=$FunObj->TotalUserCount($plan_id);
                                            $data_arr=array();
                                           $arr=array();
                                           foreach ($sol as $arr) {
                                             foreach ($vari as $data_arr) {     
                                          ?>
                                          <tr>
                                      <td><?php echo $data['trip_name']; ?></td>
                                      <td><?php echo $data['fee_charges'];?></td>
                                      <td><?php 
                                               if($data_arr['SUM(member_booking)']){
                                                    echo $data_arr['SUM(member_booking)'];
                                                }else{
                                                  echo "0";
                                                }
                                      ?>/<?php echo $data['members'];?></td>
                                      <td><?php 
                                           if ($arr['SUM(member_booking)']) {
                                             echo $arr['SUM(member_booking)'];
                                           }else{
                                            echo "0";
                                          }
                                          ?> </td>
                                      <td><button  class="btn btn-success" value="<?php echo $data['plan_id']; ?>" onclick="getid(this);"><?php echo $lang['see_m'];?></button></td>
                                 </tr>
                                          <?php
                                        }
                                        }
                                        }
                                      } else{
                                       $msg=$lang['no_plans'];
                                      }
                                  ?>
                                 
                                

            
                           </table>
                           <?php 
                              if ($msg) {
                                 echo $msg;
                               } 
                              ?>
                    </div>
                  </div>

                 <!--content end-->
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


         function getid(id)
       {
       var weekend_id=$(id).val();
       var action="trip_review";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {trip_review:action,weekend_id:weekend_id},
                      success: function(data){
                         window.location.href="new_payment.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }

      </script>
</body>
</html>