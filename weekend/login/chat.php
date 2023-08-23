 <?php session_start();

 require_once('../php/code.php');
 include'../select_lang.php';
     $profile_pic="";
     
     $U_Obj=new clsUser();
    $A_fetch=$U_Obj->GetUserDetail(21);
    foreach ($A_fetch as $arrdata) {
      $profile_pic= $arrdata['profile_pic'];
    }

     $outgoing=$_SESSION['u_id'];
     $date="";
     $Obj=new clsMessage();
     $result=$Obj->UserMessageFetch(21,$outgoing);

     
            if (!$result) {
              ?>
                  <div class="text"><?php echo $lang['txt109']; ?></div>

              <?php
            
            }else{

        ?>
           
           <?php   
               
               $data=array();
               foreach ($result as $data) {
                $sender_id=$data['sender_id'];
                 $date=$data['msg_date'];
              if ($outgoing==$sender_id) {
              
           ?>
           <div class="chat outgoing">
              <div class="details">
                  <p><?php echo $data['message']; ?></p>
              </div>
           </div> 

         <?php 
                }else{
             ?>
           <div class="chat incoming">
               <img src="photo/<?php echo $profile_pic; ?>" alt="">
               <div class="details">
                   <p><?php echo $data['message']; ?></p>
               </div>
            </div>

          <?php 
                    }
                 } 

               }  
          ?>
         <div class="text-center">
           <small><?php echo $date; ?></small>
          </div>