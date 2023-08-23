<?php session_start();

require_once('php/code.php');
$date="";
     $outgoing= $_SESSION['u_id']; //admin
     $incoming=$_SESSION['user_id'];  //user

     $FunObj=new clsUser();
     $res=$FunObj->GetUserDetail($incoming);
     foreach ($res as $arr) {
       $user_name=$arr['f_name']." ".$arr['l_name'];
       $user_pic=$arr['profile_pic'];
       $online=$arr['online'];
     }

     $fun=$FunObj->GetUserDetail($outgoing);
     $arr=array();
     $profile_pic="";
     foreach ($fun as $arr) {
        $f_name=$arr['f_name'];
        $l_name=$arr['l_name'];
        $profile_pic=$arr['profile_pic'];
     }

     $Obj=new clsMessage();

?>

<!DOCTYPE html>
<html>
<head>
  <title></title>

  <?php include'links/links.php'; ?>

    <link  rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet"  href="css/navbar.css">



</head>
<body>

     <div class="container-fluid">
      <div class="row">
            <?php include'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

               <div class="row dash_content">
                  <div class="col-12 header">
                    <div>
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['cht'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo $f_name." ".$l_name; ?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="chat.php?lang=en">EN | </a><a href="chat.php?lang=hi">हिन्दी</a><a href="chat.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
            
              <div class="form-div">
             <!-- content start -->
    <div class="profile-card">
    <section class="chat-area">

      <header id="online">
        <a href="user-chat-list.php?lang=<?php echo $set_lang; ?>" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../login/photo/<?php echo $user_pic; ?>" alt="">
        <div class="details">
          

          <span><?php echo $user_name; ?></span><br>
          <?php 
            if($online==1){
              ?>
          <small><i class="fa fa-circle" style="color: #468669;"></i> Online</small>
          <?php 
                }else{
                  ?>

          <small><i class="fa fa-circle" style="color: #bd2130;"></i> Offline</small>
        <?php } ?>
        </div>
      </header>
      <div class="chat-box" id="chat-box">
           
         
      </div>
      <div class="typing-area">
        <input type="text" class="incoming_id"  value="<?php echo $user_id; ?>" hidden>
        <input type="text" class="input-field" id="message" placeholder="Type a message here..." autocomplete="off" required>
         <button onclick="send_chat();" value="<?php echo $incoming; ?>" id="sending"><i class="fab fa-telegram-plane"></i></button>
      </div>
    </section>
  </div>         

  <!--content end-->
            </div>
                   
               </div>
               
          
               </div>

           </div>
        </div>
     </div>
      <script>
        function show(){
             document.getElementById('sidebar').classList.toggle('open');
         }


function send_chat()
    {  
       var user_id=$(sending).val();
       var message=$("#message").val();
       if(message){
       var action="chat";
        $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {chat:action,user_id:user_id,message:message},
                      success: function(data){
                        $("#message").val('');                  
                         }
                });
      }
        
    }


  setInterval("refreshing();",1000);
  function refreshing(){
      $("#chat-box").load("sample.php");
       $("#online").load(" #online");
    }

$(document).ready(function(){
  $("#chat-box").animate({scrollTop: $("#chat-box").get(0).scrollHeight},2000);
});     
 </script>
</body>
</html>