<?php session_start();
   require_once('php/code.php');
    $admin_id= $_SESSION['u_id'];

     $Obj=new clsMessage();
     $result=$Obj->UserListFetch();

     $FunObj=new clsUser();

        $u_id=$_SESSION['u_id'];
     $U_Obj=new clsUser();
     $fun=$U_Obj->GetUserDetail($u_id);
     $arr=array();
     $profile_pic="";
     foreach ($fun as $arr) {
        $a_name=$arr['f_name']." ".$arr['l_name'];
        $profile_pic=$arr['profile_pic'];
     }
   header("refresh:5");
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>

  <?php include'links/links.php'; ?>

    
    <link  rel="stylesheet" href="css/user-list.css">

</head>
<body>

     <div class="container-fluid">
      <div class="row">
            <?php include'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

               <div class="row dash_content">
                  <div class="col-12 header">
                    <div>
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2> <?php echo $lang['chtt'];?> </h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo  $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="user-chat-list.php?lang=en">EN | </a><a href="user-chat-list.php?lang=hi">हिन्दी</a><a href="user-chat-list.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
            
              <div class="form-div">
             <!-- content start -->     

  <div class="profile-card">
    <section class="users">

      <header>
        
        <div class="content">
          <img src="../login/photo/<?php echo $profile_pic; ?>" alt="">
          <div class="details">
            <span><?php echo $a_name; ?></span>
            
          </div>
        </div>
      </header>
    
      <div class="users-list">
        <br>
          

               <?php 
               $message="";
               $date="";
                    foreach ($result as $data) {
                      $user_id=$data['sender_id'];
                      $user_name=$FunObj->GetUserDetail($user_id);
                       foreach ($user_name as $arr) {
                          
                           $Obj=new clsMessage();
                           $m_result=$Obj->UserMessageFetch($arr['u_id'],$admin_id);
                          $data_arr=array();
                          foreach ($m_result as $data_arr) {
                
                           $date=$data_arr['msg_date'];
                           $message=$data_arr['message'];
                     }
               ?>
               <button class="btn text-left" value="<?php echo $arr['u_id']; ?>" onclick="getuserid(this);">
                 <a>

                    <div class="content">
                    <img src="../login/photo/<?php echo $arr['profile_pic']; ?>" alt="">
                    <div class="details">
                        <span><?php echo $arr['f_name']." ".$arr['l_name']; ?></span>
                        <p><small><?php echo $message." <br> ".$date; ?></small></p>
                    </div>
                    </div>
                    <?php if ($arr['online']==0) {
                      ?>
                       <div class="status-dot" style="color: #bd2130;"><i class="fas fa-circle"></i></div>
                       <?php
                    } else{
                    ?>
                    <div class="status-dot"><i class="fas fa-circle"></i></div>
                  <?php } ?>
                    </a>
                  </button>
                <?php } } ?>    
                

         </div>
    </section>
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


          function getuserid(id)
       {
       var user_id=$(id).val();
       var action="user_number";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {user_number:action,user_id:user_id},
                      success: function(data){
                         window.location.href="chat.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }
      </script>
</body>
</html>