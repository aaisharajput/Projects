<?php session_start();
 
     require_once('php/code.php'); 
     include'new.php';
     $msg="";
     if (isset($_POST['notify'])) {
     	 $Prp=new clsNotificationPrp();
     	 $Prp->P_trip_name=$_POST['trip_name'];
     	 $Prp->P_post_date=$_POST['post_date'];

     	 $FunObj=new clsNotification();
     	 $f_result=$FunObj->NotificationInsert($Prp);
     	 if($f_result){
     	 	$msg=$lang['ins_suc'];
     	 	header("refresh:1");
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
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['notify'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="notification.php?lang=en">EN | </a><a href="notification.php?lang=hi">हिन्दी</a><a href="notification.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
           
              <div class="form-div">
             <!-- content start -->
                                  <?php 
                                       if ($msg) {
                                       	  ?>
                                       	  <div class="alert alert-success text-center">
                                       	  	<?php echo $msg; ?>
                                       	  </div>
                                  <?php
                                       }
                                  ?>

                  <div class="container">
                        
                             <div class="main-div ">
                           <h1><?php echo $lang['trip_notify'];?></h1>
                           <div>
                         
                         </div>
                            <div class="table-responsive">
      
                              <table class="table table-light table-hover table-striped" >
                                  <tr class="sticky">
                                      <th><b><?php echo $lang['trip_nm'];?></b></th>
                                      <th><b><?php echo $lang['last_da'];?></b></th>
                                      <th colspan="2"><?php echo $lang['opera'];?></th>
                                  </tr>
                                  <?php  
                                       $p_date=date("Y-m-d");
                                       $Obj=new clsNotification();
                                       $result=$Obj->ShowNotification($p_date);
                                       $data=array();
                                       foreach ($result as $data) {
                                         
                                  ?>
                                 <tr>
                                      <td><input type="text" id="t_name" value="<?php echo $data['trip_name']; ?> " class="form-control"></td>
                                      <td><input type="date" id="p_date" value="<?php echo $data['post_date']; ?>" class="form-control"> </td>
                                      <td> <a href="trip_details.php"><button  class="btn btn-success" value="<?php echo $data['notify_id']; ?>" onclick="update_notify(this);"><?php echo $lang ['up']; ?></button></a></td>
                                      <td> <a href="trip_details.php"><button  class="btn btn-danger" value="<?php echo $data['notify_id']; ?>" onclick="delete_notify(this);"><?php echo $lang ['delt']; ?></button></a></td>
                                 </tr>
                             <?php } ?>
                     
                           </table>
                    </div>

               </div>  
                      <form method="POST">
                    	<h5><?php echo $lang['trip_nm'];?></h5>
               	       <input type="text" name="trip_name" class="form-control"><br>
               	       <h5><?php echo $lang['last_da'];?></h5>
               	       <input type="date" name="post_date" class="form-control">
               	       <br>
               	       <button class="btn btn-success" name="notify"><?php echo $lang['noti'];?></button><br><br>
                    </form>
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


          function delete_notify(id)
       {
       var notify_id=$(id).val();
       var action="delete_notify";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {delete_notify:action,notify_id:notify_id},
                      success: function(data){
                         window.location.href="notification.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }


         function update_notify(id){


           var t_name=$(id).parents('tr').find("#t_name").val();
           var p_date=$(id).parents('tr').find("#p_date").val();
           var notify_id=$(id).val();
           var action="update_notify";
  
             $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {update_notify:action,notify_id:notify_id,t_name:t_name,p_date:p_date},
                      success: function(data){
                         window.location.href="notification.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
               

         }
      </script>
</body>
</html>