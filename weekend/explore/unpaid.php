<?php session_start();
 
     include'new.php';

     require_once('php/code.php');
       $weekend_id=$_SESSION['weekend_id'];
 
 ?>
  <table class="table table-light table-hover table-striped" >
                                  <tr class="sticky">
                                      <th><b><?php echo $lang['named'];?></b></th>
                                      <th><b><?php echo $lang['book'];?></b></th>
                                      <th><b><?php echo $lang['chrg'];?></b></th>
                                      <th><b><?php echo $lang['stat'];?></b></th>
                                  </tr>
                                 <?php 
                                    $Obj=new clsPlanPurchase();
                                    $result=$Obj->UserPlanPurchase($weekend_id);
                                    $func=new clsWeekendPlans();
                                    $func_result=$func->UserWeekendPlans($weekend_id);
                                    $data=array();
                                    $arr=array();
                                    $newarr=array();
                                    $count=0;
                                    if($result){
                                    foreach ($func_result as $newarr) {
                                    
                                    foreach ($result as $data) {
                                     $u_id=$data['u_id'];
                                     if ($data['pay_status']==0) {
                                     	$count++;

                                     $FunObj=new clsUser();
                                     $sol=$FunObj->GetUserDetail($u_id);
                                     foreach ($sol as $arr) {
                                     $total=$newarr['fee_charges']*$data['member_booking'];

                                 ?> 
                                 <tr>
                                      <td><?php echo $arr['f_name']; ?></td>
                                      <td><?php echo $data['member_booking']; ?></td>
                                      <td><?php echo $total; ?></td>
                                      <td><?php if($data['pay_status']==0){
                                           echo "Unpaid";
                                      } 
                                      ?> </td>
                           
                                 </tr>
                               <?php 
                                  }
                              }
                                   }
                                 }
                               }
                               ?>
        
                           </table>
                           <h4><?php
                      
                            if($count==0){
                            echo $lang['data_not_found'];
                           }
                           ?></h4>