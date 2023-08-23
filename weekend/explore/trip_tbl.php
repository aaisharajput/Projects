<?php session_start();
 
     require_once('php/code.php'); 

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

    <link rel="stylesheet" href="css/trip_tbl.css">

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
                           <?php echo $lang['lang']; ?>: <a href="trip_tbl.php?lang=en">EN | </a><a href="trip_tbl.php?lang=hi">हिन्दी</a><a href="trip_tbl.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
           
              <div class="form-div">
             <!-- content start -->


                  <div class="container">
                        
                             <div class="main-div ">
                           <h1><?php echo $lang['trip_his'];?></h1>
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
                                       $p_date=date("Y-m-d");
                                       $Obj=new clsWeekendPlans();
                                       $result=$Obj->PreviousWeekendPlan($p_date);
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
                         window.location.href="trip_details.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }
      </script>
</body>
</html>