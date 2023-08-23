  <?php session_start();
require_once('code.php');
    if (isset($_POST['trip_review'])) {
        $_SESSION['weekend_id']=$_POST['weekend_id'];
     }

    if (isset($_POST['trip_details'])) {
        $_SESSION['weekend_id']=$_POST['weekend_id'];
     }

    if (isset($_POST['delete_trip'])) {
        $plan_id=$_POST['weekend_id'];
        $u_id=$_SESSION['u_id'];
        $Obj=new clsPlanPurchase();
        $result=$Obj->CancelBooking($u_id,$plan_id);
     }

     if (isset($_POST['delete_review'])) {
        $review_id=$_POST['review_id'];
        $Obj=new clsReview();
        $result=$Obj->DeleteReview($review_id);
     }

    if (isset($_POST['getplan_id'])) {
        $_SESSION['plan_id']=$_POST['plan_id'];
     }

    if (isset($_POST['payment'])) {
        $u_id=$_SESSION['u_id'];
        $plan_id=$_SESSION['trip_id'];
        $Obj=new clsPlanPurchase();
        $result=$Obj->PaymentSuccess($u_id,$plan_id);
     }

      if (isset($_POST['chat'])) {
        $outgoing=$_POST['user_id'];
        $Prp=new clsMessagePrp();
       $Prp->P_sender_id=$outgoing;
       $Prp->P_receiver_id=21;
       $Prp->P_message=$_POST['message'];
       $Obj=new clsMessage();
       $sol=$Obj->UserMessageInsert($Prp);
     }


  ?> 