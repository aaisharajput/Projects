<?php session_start();

     require_once('php/code.php');
       include'new.php';
     $u_id=$_SESSION['u_id'];
     $Obj=new clsUser();
     $fun=$Obj->GetUserDetail($u_id);
     $arr=array();
     $profile_pic="";
     $f_name="";
     $l_name="";
     $msg="";
     $msg2="";
     foreach ($fun as $arr) {
        $f_name=$arr['f_name'];
        $l_name=$arr['l_name'];
        $profile_pic=$arr['profile_pic'];
     }
     $status=1;
     $update=$Obj->UpdateStatus($u_id,$status);



      if (isset($_POST['register'])) {
        $Prp=new clsUserPrp();
        $Prp->P_f_name=$_POST['f_name'];
        $Prp->P_l_name=$_POST['l_name'];
        $image=$_FILES['admin_photo']['name'];

        if ($image) {
          $Prp->P_profile_pic=$image;
        }else{
          $Prp->P_profile_pic=$profile_pic;
        }
        $detail_result=$Obj->AdminProfile($Prp,$u_id);
       
        $img_name=$_FILES['admin_photo']['name'];
       $tmp_name=$_FILES['admin_photo']['tmp_name'];
       $file_path="../login/photo/";
        move_uploaded_file($tmp_name,$file_path.$img_name);

        if ($detail_result) {
           $msg=$lang['delt_sav'];;
           header("Refresh: 1");
        }else{
           $msg2=$lang['delt_false'];;
        }
 } 
   
 ?>
 <!DOCTYPE html>
<html>
<head>
	<title></title>
  <?php include'links/links.php'; ?>

  	<link rel="stylesheet" href="css/dash.css">

</head>
<body>

     <div class="container-fluid">
     	<div class="row">
          <?php include'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

           	   <div class="row dash_content">
           	   	  <div class="col-12 header">
           	   	  	<div>
           	   	   <h3>	<i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['dash'];?></h2></div>
                   <br>
                    <?php if($msg){ ?>
                       <div class="alert alert-success text-center">
                           <?php echo $msg; ?><?php echo $msg=""; ?>
                        </div>
                        <?php }
                            ?>
                             <?php if($msg2){ ?>
                       <div class="alert alert-danger text-center">
                           <?php echo $msg2; ?><?php echo $msg2=""; ?>
                        </div>
                        <?php }
                            ?>
           	   	  	<div class="profile">
           	   	  		<div class="img">
           	   	  		  
                          <button type="button" class="btn" data-toggle="modal" data-target="#myModal">
                          <img src="../login/photo/<?php echo $profile_pic; ?>">
                          <?php echo $lang['profile']; ?>
                        </button>
                        
           	   	  		</div>
           	   	  		<h4><?php echo $f_name." ".$l_name;?></h4>
           	   	  		<span><?php echo $lang['super'];?></span>
           	   	  		   	<div class="multi_lang" >
		                    	 <?php echo $lang['lang']; ?>: <a href="dash.php?lang=en">EN | </a><a href="dash.php?lang=hi">हिन्दी</a><a href="dash.php?lang=ur"> | اردو</a>
	     	                </div>
           	   	  	</div>
           	   	  </div>


                  

                           <!-- The Modal -->
                        <div class="modal" id="myModal">
                          <div class="modal-dialog modal-sm">
                            <div class="modal-content">

                                 <!-- Modal body -->
                              <div class="modal-body">
                                 <h4 class="modal-title">
                                        <?php echo $lang['profile']; ?> <button type="button" class="close" data-dismiss="modal">&times;</button></h4>
                                 <div class="profile-pic">
                                 <div class="img">
                              <img src="../login/photo/<?php echo $profile_pic; ?>" class="img">                             
                               <label for="file"><i class="fa fa-plus"></i></label>
                            </div>
                          </div>
                               
                                  <form method="post" enctype="multipart/form-data">
                                    <input id="file_name" name="pic" readonly>
                                     <input type="file" name="admin_photo" id="file" onchange="showpic();" hidden>
                           <div class="form-group">
                              <input type="text" class="form-control" name="f_name" value="<?php echo $f_name; ?>" placeholder="<?php echo $lang['f_name']; ?>" required>
                            </div>
                           
                            <div class="form-group">
                              <input type="text" class="form-control" name="l_name" value="<?php echo $l_name; ?>" placeholder="<?php echo $lang['l_name']; ?>">
                            </div> 
                           
                            <button type="submit" class="btn btn-success" name="register"><?php echo $lang['save']; ?></button>
                        </form>
                               
                              </div>


                            </div>
                          </div>
                        </div>

           	   	  <div class="col-lg-12 main-content">
                    <?php 
                             
                          $info=$Obj->UserCount();
                         
                          $FunObj=new clsWeekendPlans();
                          $counttrip=$FunObj->TripCount();

                          $FunObjj=new clsPlanPurchase(); 
                          $weekend=$FunObjj->Status();
                          $sum_amount=0;

                           $data_info=array();
                           $data_count=array();
                           $array_w=array();
                           $p_array=array();
                          foreach ($info as $data_info) {
                            $ans=$data_info['COUNT(u_id)'];
                          }
                          foreach ($counttrip as $data_count) {
                            $answer=$data_count['COUNT(plan_id)'];
                          }

                          foreach ($weekend as $array_w) {
                            $pla_id=$array_w['plan_id'];
                            $memb=$array_w['member_booking'];
                            $p_id=$FunObj->UserWeekendPlans($pla_id);
                            foreach ($p_id as $p_array) {
                              $fee=$p_array['fee_charges'];
                              $sum_amount=$memb*$fee+$sum_amount;
                            }
                          }

                    ?>
           	   	  	<span class="box">
           	   	  		<h3><?php echo $ans; ?></h3>
           	   	  		<h6><?php echo $lang['tang'];?></h6>
           	   	  	</span>
           	   	  		<span class="box">
           	   	  		<h3><?php echo $answer; ?></h3>
           	   	  		<h6><?php echo $lang['trips'];?></h6>
           	   	  	</span>
           	   	  		<span class="box">
           	   	  		<h3>Rs. <?php echo $sum_amount; ?></h3>
           	   	  		<h6><?php echo $lang['earn'];?></h6>
           	   	  	</span>

                    <?php 
                       $T_Obj=new clsTraffic();
                       $t_result=$T_Obj->ShowTraffic();
                       $t_arr=array();
                       foreach ($t_result as $t_arr) {
                         $traffic=$t_arr['views'];
                       }
                    ?>
           	   	  		<span class="traffic">
           	   	  		<h3><?php echo $traffic; ?></h3>
           	   	  		<h6><?php echo $lang['traf'];?></h6>
           	   	  	</span>
           	   	  </div>

           	   	  <div class="col-lg-7">
           	   	  	<div class="recent-grid">
					       <div class="card">
						       <div class="card-header">
						          <h2><?php echo $lang['recent'];?></h2>
							      <a href="new_trip_tbl.php?lang=<?php echo $set_lang; ?>"><button><?php echo $lang['see'];?></button></a>
						        </div>
						        <div class="card-body">

							        <table width="100%">
							           <thead>
									        <tr>
									        	<td><?php echo $lang['t_title'];?></td>
									        	<td><?php echo $lang['dat'];?></td>
										        <td><?php echo $lang['mem'];?></td>
								        	</tr>

								       </thead>
								 <tbody>
 	    <?php 
                 $p_date=date("Y-m-d");
                 $result=$FunObj->NewWeekendPlans($p_date);
                   

               if($result){
                 $data_arra=array();
                
                  $data=array();
                  foreach ($result as $data) {    
                    $plan_id=$data['plan_id'];
                   $varibl=$FunObjj->TotalUserCount($plan_id);                
                    foreach ($varibl as $data_arra) {  
                    
          ?>
							         <tr>
								         <td><?php echo $data['trip_name']; ?> </td>
								         <td><?php echo $data['start_date']; ?> </td>
								         <td><?php 
                               if($data_arra['SUM(member_booking)']){
                                  echo $data_arra['SUM(member_booking)'];
                               }else{
                                echo "0";
                               } ?>/<?php echo $data['members']; ?>  </td>
							         </tr>
						<?php 
              }
						    }
						}
						 ?>   
                                   
								</tbody>

							</table>
							
						</div>
						
					</div>
				
			</div>
          </div>
           	   	  <div class="col-lg-5">
           	   	  	 	<div class="recent-grid">
					       <div class="card">
						       <div class="card-header">
						          <h2><?php echo $lang['disap'];?></h2>
						        </div>
						        <div class="card-body">

							        <table>
							           <thead>
							           
									        <tr>
									        	<td><?php echo $lang['nam'];?></td>
									        	<td><?php echo $lang['acc_v'];?></td>
									        	<td><?php echo $lang['opera'];?></td>
								        	</tr>

								       </thead>
								 <tbody>
								 		<?php 

							           	   
                                           $sol=$Obj->StatusUser();

                                          if($sol){
                                             $arr=array();
                                             foreach ($sol as $arr) {     

							           	?>
							         <tr>
							         	<form method="post">
								         <td><?php echo $arr['f_name'];?></td>
								         <td><?php echo $arr['reg_date'];?></td>
								         <td><button class="btn btn-danger" value="<?php echo $arr['u_id'];?>" onclick="deleteuser(this);"><?php echo $lang['del'];?></button></td>
								         </form>
							         </tr>    
							         <?php
							           }
							           }
							          ?>                               
								</tbody>

							</table>
							
						     </div>
						
					      </div>
					
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

         function showpic(){
         var a=document.getElementById('file').value;
         a=a.substring(12);
           document.getElementById('file_name').value=a;

         }


   function deleteuser(id)
    {
       var u_id=$(id).val();
       var action="delete_user";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {delete_user:action,u_id:u_id},
                      success: function(data){
                         window.location.href="dash.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }
      </script>

</body>
</html>