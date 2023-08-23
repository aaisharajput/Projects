 <?php session_start();

 require_once('../php/code.php');
      $outgoing= $_SESSION['u_id']; //admin
     $incoming=$_SESSION['user_id'];  //user

     $Obj=new clsMessage();
     $result=$Obj->UserMessageFetch($incoming,$outgoing);
     $FunObj=new clsUser();
     $res=$FunObj->GetUserDetail($incoming);
     foreach ($res as $arr) {
       $user_pic=$arr['profile_pic'];
         }
     
 
            if (!$result) {
              ?>
                  <div class="text">No messages are available. Once you send message they will appear here.</div>

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
               <img src="../login/photo/<?php echo $user_pic; ?>" alt="">
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