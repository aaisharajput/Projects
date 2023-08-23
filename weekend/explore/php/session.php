  <?php session_start();
 
     require_once('code.php');

    if (isset($_POST['trip_review'])) {
        $_SESSION['weekend_id']=$_POST['weekend_id'];
     }

    if (isset($_POST['trip_details'])) {
        $_SESSION['weekend_id']=$_POST['weekend_id'];
     }

       if (isset($_POST['delete_user'])) {
        
         $Obj=new clsUser();
         $u_id=$_POST['u_id'];
         $sol=$Obj->DeleteUser($u_id);
     }

     if (isset($_POST['user_issue'])) {
        $_SESSION['fd_id']=$_POST['fd_id'];
     }

      if (isset($_POST['delete_review'])) {
        $review_id=$_POST['review_id'];
        $Obj=new clsReview();
        $result=$Obj->DeleteReview($review_id);
     }

    if (isset($_POST['delete_issue'])) {
        
         $Obj=new clsContact();
         $fd_id=$_POST['fd_id'];
         $sol=$Obj->DeleteUser($fd_id);
     }
     
     if (isset($_POST['get_id'])) {
        $_SESSION['us_id']=$_POST['us_id'];
     }

     if (isset($_POST['update_schedule'])) {
         $Prp=new clsSchedulePrp();
         $Prp->P_s_no=$_POST['s_no'];
         $Prp->P_location=$_POST['location'];
         $Prp->P_event=$_POST['event'];

         $Obj=new clsSchedule();
         $sol=$Obj->UpdateTrip($Prp);
     }

     if (isset($_POST['delete_schedule'])) {
         $s_no=$_POST['s_no'];

         $Obj=new clsSchedule();
         $sol=$Obj->DeleteSchedule($s_no);
     }

     if (isset($_POST['delete_gallery'])) {
         $gallery_id=$_POST['gallery_id'];

         $Obj=new clsTripGallery();
         $sol=$Obj->DeleteGallery($gallery_id);
     }

     if (isset($_POST['delete_notify'])) {
         $notify_id=$_POST['notify_id'];

         $Obj=new clsNotification();
         $sol=$Obj->DeleteNotification($notify_id);
     }

     if (isset($_POST['update_notify'])) {
         $Prp->P_notify_id=$_POST['notify_id'];
         $Prp->P_trip_name=$_POST['t_name'];
         $Prp->P_post_date=$_POST['p_date'];

         $Obj=new clsNotification();
         $sol=$Obj->UpdateNotification($Prp);
     }

     if (isset($_POST['user_number'])) {
        $_SESSION['user_id']=$_POST['user_id'];
     }

      if (isset($_POST['chat'])) {
        $Prp=new clsMessagePrp();
       $Prp->P_sender_id=$_SESSION['u_id'];;
       $Prp->P_receiver_id=$_POST['user_id'];
       $Prp->P_message=$_POST['message'];
       
       $Obj=new clsMessage();
       $sol=$Obj->UserMessageInsert($Prp);
     }

  ?> 