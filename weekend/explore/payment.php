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

    <link rel="stylesheet" href="css/payment.css">

</head>
<body>

     <div class="container-fluid">
      <div class="row">
          <?php include'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

               <div class="row dash_content">
                  <div class="col-12 header">
                    <div>
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['pay'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo  $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="payment.php?lang=en">EN | </a><a href="payment.php?lang=hi">हिन्दी</a><a href="payment.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
            <div class="arrow">
              <a href="transaction_tbl.php?lang=<?php echo $set_lang; ?>"><i class="fa fa-arrow-left"></i></a>
            </div>
             <div class="main-div ">
                           <h1><?php echo $lang['trans_d'];?></h1>
                           <div>
                          <?php echo $lang['pay_s'];?>: 
                          <select onchange="selectfile();" id="content">
                                    <option value="all"><?php echo $lang['all'];?></option>
                                    <option value="paid"><?php echo $lang['pad'];?></option>
                                    <option value="unpaid"><?php echo $lang['u_pad'];?></option>
                                 </select>
                         </div>
                            <div class="table-responsive" id="table_con">
      
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
                                    $msg="";
                                    if($result){
                                    foreach ($func_result as $newarr) {
                                    
                                    foreach ($result as $data) {
                                     $u_id=$data['u_id'];

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
                                      } elseif ($data['pay_status']==1) {
                                        echo "Paid";
                                      }else{
                                         echo "Cancelled";
                                      }
                                      ?> </td>
                           
                                 </tr>
                               <?php 
                                  }
                                   }
                                 }
                               }else{
                                    $msg=$lang['not_booked'];
                                 }
                               ?>
        
                           </table>
                          <h4><?php
                           if($msg){
                            echo $msg;
                           } 
                           ?></h4>
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

         function selectfile(){

          var get_id=$("#content").val(); 
           if (get_id=="paid") {
              $("#table_con").load("paid.php?lang=<?php echo $set_lang; ?>");
           }else if (get_id=="unpaid") {
             $("#table_con").load("unpaid.php?lang=<?php echo $set_lang; ?>");
           }else{
               $("#table_con").load("all_payment.php?lang=<?php echo $set_lang; ?>");
           }

         }
      </script>
</body>
</html>