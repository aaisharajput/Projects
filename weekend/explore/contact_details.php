<?php session_start();
 
     require_once('php/code.php');
     include 'new.php';
     $fd_id=$_SESSION['fd_id'];
   $msg="";
   $msg2="";
    $Funobj= new clsContact();

              if (isset($_POST['mail_send'])) {
                        $to=$_POST['email'];
                        $query=$_POST['query'];
                        $name=$_POST['u_name'];
                        $response=$_POST['response'];
                         $subject="User Issues response ";
                         $headers = 'From:Explore The Unexplored'."\r\n";
                         $ms ="Thanks for contacting with us."."\r\n"."Dear $name ."."\r\n"." Your Query:$query"."\r\n";
                         $ms.="Solution: $response"."\r\n".'"Admin"';

                         if ( mail($to,$subject,$ms,$headers)) {
                            $mail_result=$Funobj->UpdateMailStatus($fd_id);
                            if($mail_result){
                                $msg=$lang['mail_send'];
                                header("Refresh:2");
                               }else{
                                $msg2=$lang['not_send_mail'];
                              }
                         }else{
                          $msg2=$lang['not_send_mail'];
                        }
                    }   


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

    <link rel="stylesheet" href="css/contact.css">

</head>
<body>

     <div class="container-fluid">
      <div class="row">
          <?php include'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

               <div class="row dash_content">
                  <div class="col-12 header">
                    <div>
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['contt'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo  $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="contact_details.php?lang=en">EN | </a><a href="contact_details.php?lang=hi">हिन्दी</a><a href="contact_details.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
          <!-- content start --> 
          <a href="contact_tbl.php?lang=<?php echo $set_lang; ?>"> <i class="fa fa-arrow-left"></i></a>
              <div class="form-div">
                        <?php if ($msg) {
                          ?><div class="alert alert-success text-center"><?php echo $msg; ?></div>
                      <?php  }   ?>
                      <?php if ($msg2) {
                          ?><div class="alert alert-danger text-center"><?php echo $msg2; ?></div>
                      <?php  }   ?>
                  <div class="form-design">
            
                 <h2 class="txt_color"><?php echo $lang['user_i'];?></h2>
                    <hr>
                    <?php
                      
                       $result=$Funobj->GetUserDetail($fd_id);
                       if ($result) {
                        $arr=array();
                         foreach ($result as $arr) {

                    ?>
                 <form method="post">
                 <p><?php echo $lang['nam'];?><b>:  </b><input type="text" name="u_name" value="<?php echo $arr['name']; ?>" readonly></p>
                 <p><?php echo $lang['email'];?><b>:  </b><input type="text" name="email" value="<?php echo $arr['email']; ?>" readonly></p>
                 <p><?php echo $lang['qur'];?>:</p>
                  <div class="query"> <textarea name="query" class="form-control query" rows="6" readonly><?php echo $arr['fd_text']; ?></textarea></div><br>
                  <p><?php echo $lang['sol']; ?>:</p>
                  <textarea name="response"  rows="5" class="form-control" required></textarea>
                 <div class="btn-design">
                  
                  <button class="btn btn-success" name="mail_send">
                           <?php if ($arr['status']=='not') {
                            echo $lang['mal'];
                           }else{ ?>
                             <i class="fa fa-check"> <?php echo $lang['mail_again']; ?></i>
                           <?php } ?>
                               </button>  &emsp;     
                  <button class="btn btn-danger" value="<?php echo $arr['fd_id'];?>" onclick="deleteissues(this)";><?php echo $lang['del'];?></button>
                 
                 </div>
                  </form>
                 <?php
                   }
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

         
         function deleteissues(id)
    {
       var fd_id=$(id).val();
       var action="delete_issue";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {delete_issue:action,fd_id:fd_id},
                      success: function(data){
                         window.location.href="contact_tbl.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }

      </script>
</body>
</html>