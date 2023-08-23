<?php session_start();
 
     require_once('../php/code.php');
     include'../select_lang.php'; 
     $u_id= $_SESSION['u_id'];
     $f_name="";
     $l_name="";
     $profile_pic="";
     $online="";
     
     $U_Obj=new clsUser();
    $U_fetch=$U_Obj->GetUserDetail($u_id);
    foreach ($U_fetch as $arr) {
      $f_name= $arr['f_name'];
      $l_name=$arr['l_name'];
    }
    $A_fetch=$U_Obj->GetUserDetail(21);
    foreach ($A_fetch as $arrdata) {
      $profile_pic= $arrdata['profile_pic'];
      $online=$arrdata['online'];
    }

     $status=1;
     $update=$U_Obj->UpdateStatus($u_id,$status);

 ?>
 <!DOCTYPE html>
<html lang="en">
   <head>
      
      <title></title>
     <?php include'../links/links.php'; ?>
          <link rel="stylesheet" href="css/home.css">
          <link rel="stylesheet" href="css/chat.css">
           <link rel="stylesheet" href="css/hobby.css">
           <style>
             .lang_btn .lang{
                 color: red;
             }
           </style>
   </head>
   <body>
 <?php include'title_bar.php'; ?>

 <?php include'hobby.php'; ?>

      <div class="home-img">
        <div class="content">
              <h1><?php echo $lang['explore']; ?><br><?php echo $lang['weekend']; ?></h1><br>
              <p><?php echo $lang['Welcome']; ?> <?php echo $f_name; ?> <?php echo  $l_name; ?></p>
        </div>
    <img src="../img/imgg.jpg">
 </div>
 <br><br>
                   <?php

                          $Obj=new clsUser();    
                          $info=$Obj->UserCount();

                          $FunObj=new clsWeekendPlans();
                          $counttrip=$FunObj->TripCount();
                         
                        foreach ($info as $data_info) {
                            $ans=$data_info['COUNT(u_id)'];
                          }
                          foreach ($counttrip as $data_count) {
                            $answer=$data_count['COUNT(plan_id)'];
                          }

                       $T_Obj=new clsTraffic();
                       $t_result=$T_Obj->ShowTraffic();
                       $t_arr=array();
                       foreach ($t_result as $t_arr) {
                         $traffic=$t_arr['views'];
                         }

                       $P_Obj=new clsPlanPurchase();
                       $P_result=$P_Obj->CountUserTrip($u_id);
                       $P_arr=array();
                       foreach ($P_result as $P_arr) {
                         $my_trip=$P_arr['count(u_id)'];
                       }

                          ?>
       <div class="main-content">
           <span class="box">
             <h3><?php echo $ans; ?></h3>
             <h6><?php echo $lang['txt12']; ?></h6>
           </span>
             <span class="box">
             <h3><?php echo $answer; ?></h3>
            <h6><?php echo $lang['txt13']; ?></h6>
           </span>
            <span class="box">
             <h3><?php echo $my_trip; ?></h3>
             <h6><?php echo $lang['txt6']; ?></h6>
           </span>
             <span class="traffic">
             <h3><?php echo $traffic; ?></h3>
            <h6><?php echo $lang['txt14']; ?></h6>
          </span>
        </div>
        
        <?php  
            $p_date=date("Y-m-d");
            $Obj=new clsNotification();
            $result=$Obj->ShowNotification($p_date);
            $data=array();
            $notifi="";
            foreach ($result as $data) {
               $notifi=$data['trip_name'];     
            }
         ?>
  <?php if ($notifi) {
    ?>
    <div class="alert alert-primary">
       <marquee scrolldelay="1" behaviour="scroll" scrollamount="8"> 
        <div class="coming">
        <div class="notify">
           <h3><?php echo $notifi; ?></h3>
         </div>      
         <button class="btn btn-warning"><?php echo $lang['txt11']; ?></button>    
         <div class="notify hide">
           <h3><?php echo $notifi; ?></h3>
         </div>      
         <button class="btn btn-warning hide"><?php echo $lang['txt11']; ?></button>  
      
       </div>
      </marquee>         
    </div>
<?php } ?>
  <br>
      <div class="carousel-box">
         <div class="carousel owl-carousel items">
            <div class="item month" data-name="all">
               <?php echo $lang['txt7']; ?>
            </div>
            <div class="item" data-name="Jan">
               <?php echo $lang['txt57']; ?>
            </div>
            <div class="item" data-name="Feb">
               <?php echo $lang['txt58']; ?>
            </div>
            <div class="item" data-name="Mar">
               <?php echo $lang['txt59']; ?>
            </div>
            <div class="item" data-name="Apr">
               <?php echo $lang['txt60']; ?>
            </div>
            <div class="item" data-name="May">
               <?php echo $lang['txt61']; ?>
            </div>
            <div class="item" data-name="Jun">
               <?php echo $lang['txt62']; ?>
            </div>
            <div class="item" data-name="Jul">
               <?php echo $lang['txt63']; ?>
            </div>
            <div class="item" data-name="Aug">
               <?php echo $lang['txt64']; ?>
            </div>
            <div class="item" data-name="Sep">
               <?php echo $lang['txt65']; ?>
            </div>
            <div class="item" data-name="Oct">
               <?php echo $lang['txt66']; ?>
            </div>
            <div class="item" data-name="Nov">
               <?php echo $lang['txt67']; ?>
            </div>
            <div class="item" data-name="Dec">
               <?php echo $lang['txt68']; ?>
            </div>
         </div>
      </div>


   
                  
                

   <div class="wrapper">
    <div class="gallery">
            <?php 

                 $FunObj=new clsWeekendPlans();
                 $result=$FunObj->ShowWeekendPlans();
       
                $Obj=new clsTripGallery();
                         
                 $data=array();
                  $row=array();
                 foreach ($result as $data) {
                  $plan_id=$data['plan_id'];
                  $post_date=$data['start_date'];
                   
                   $sol=$Obj->Gallery($plan_id);
               foreach ($sol as $row){
                $source=$row['source'];
                break;
               }
               ?> 
      <div class="image" data-name="<?php echo date('M', strtotime("$post_date")); ?>"><span><button class="btn" value="<?php echo $plan_id;?>" onclick="getplanid(this);"><img src="../img/<?php echo $source; ?>"></button></span></div>
      <?php    
             }
       ?>
    </div>
  </div>

  <button type="button" class="btn chatting-box" data-toggle="modal" data-target="#myModal">
  <i class="fas fa-comment-dots"></i>
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content modal-chat-content">

      <!-- Modal body -->
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <div class="modal-body">

   <div class="profile-card">
    <section class="chat-area">
      <header id="online">
       
        <img src="photo/<?php echo $profile_pic; ?>" alt="">
        <div class="details">
          <span><?php echo $lang['txt69']; ?></span><br>
          <?php  if($online==1){

           ?>
          <small><i class="fa fa-circle"></i> <?php echo $lang['txt70']; ?></small>
        <?php }else{
          ?>
            <small><i class="fa fa-circle" style="color: #bd2130;"></i> <?php echo $lang['txt71']; ?></small>
          <?php
        } ?>
        </div>
      </header>
      <div class="chat-box" id="chat-box">
         

      </div>
      <div class="typing-area">
        <input type="text" id="message" class="input-field" placeholder="<?php echo $lang['txt72']; ?>" autocomplete="off">
        <button onclick="send_chat();" value="<?php echo $u_id; ?>" id="sending"><i class="fab fa-telegram-plane"></i></button>
      </div>
    </section>
  </div>
      </div>

    </div>
  </div>
</div>

<footer>
  <h6><div class="lang_btn">
     <?php echo $lang['lang']; ?>: <a href="home.php?lang=en">EN | </a><a href="home.php?lang=hi">हिन्दी</a><a href="home.php?lang=ur"> | اردو</a>
   </div></h6>
</footer>
  <script src="js/main.js"></script>
   <script type="text/javascript">
   function getplanid(id)
    {
       var weekend_id=$(id).val();
       var action="trip_review";
       $.ajax({
                     type: 'POST',
                     url: '../php/session.php',
                     data: {trip_review:action,weekend_id:weekend_id},
                      success: function(data){
                         window.location.href="carosole_review.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }

function send_chat()
    {  
       var user_id=$(sending).val();
       var message=$("#message").val();
       if(message){
       var action="chat";
        $.ajax({
                     type: 'POST',
                     url: '../php/session.php',
                     data: {chat:action,user_id:user_id,message:message},
                      success: function(data){
                        $("#message").val('');                  
                         }
                });
      }
        
    }

  $('.item').on('click', function(){
   $('.item').removeClass('month');
   $(this).toggleClass('month');
})


  setInterval("refreshing();",600);
  function refreshing(){
      $("#chat-box").load("chat.php");
      $("#online").load(" #online");
    }

$(document).ready(function(){
  $("#html,#chat-box").animate({scrollTop: $("#chat-box").offset().bottom},1000);
});

</script>
   </body>
</html>