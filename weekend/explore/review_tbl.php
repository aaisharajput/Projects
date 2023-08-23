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
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['rev_w'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="review_tbl.php?lang=en">EN | </a><a href="review_tbl.php?lang=hi">हिन्दी</a><a href="review_tbl.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
          <!-- content start -->
                        <div class="main-div ">
                           <h1><?php echo $lang['user_rev'];?></h1>
                            <div class="table-responsive">
      
                              <table class="table table-light table-hover table-striped" >
                                  <tr class="sticky">
                                      <th><b><?php echo $lang['trip_nm'];?></b></th>
                                      <th><b><?php echo $lang['total_rv'];?></b></th>
                                      <th><?php echo $lang['oper'];?></th>
                                  </tr>
                                  <?php
                                      $obj=new clsReview();
                                      $funobj=new clsWeekendPlans();
                                      $sol=$funobj->ShowWeekendPlans();

                                     if ($sol) {
                                          
                                          $arr=array();
                                          foreach ($sol as $arr){
                                            $plan_id=$arr['plan_id'];
                                        $sec=$obj->CountReview($plan_id);
                                        $row=array();
                                        foreach ($sec as $row) {
                                          
                                        
                                   ?>
                                          
                                 <tr>
                                      <td><?php echo $arr['trip_name'];?></td>
                                      <td><?php 
                                           if ($row['Count(comment)']) {
                                             echo $row['Count(comment)'];
                                           }else{
                                            echo "0";
                                          }
                                          ?>

                                       </td>
                                      <td><button  class="btn btn-success" value="<?php echo $arr['plan_id']; ?>" onclick="getplanid(this);"><?php echo $lang['see_m'];?></button></td>
                                 </tr>
                               <?php
                             }
                             }
                               
                             }else{
                              echo "No reviews";
                             }


                               ?>
                  
                         </table>
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

   function getplanid(id)
    {
       var weekend_id=$(id).val();
       var action="trip_review";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {trip_review:action,weekend_id:weekend_id},
                      success: function(data){
                         window.location.href="review_details.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }

      </script>
</body>
</html>