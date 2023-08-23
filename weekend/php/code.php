<?php

abstract class clsConnection
{
    protected $dbConn;    
    public function __construct()
    {        
        $dbHost="localhost";  
        $dbName="explore";  
        // $dbUser="root";      
        // $dbPassword="Ashcode@123";     
        $dbUser="root";      
        $dbPassword=""; 
        try
        {  
            $this->dbConn= new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUser,$dbPassword); 
            $this->dbConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
        } 
        catch(PDOException $e)
        {  
            Echo "Connection failed" . $e->getMessage();  
        }  
    }
    function __destruct()
    {
        $this->dbConn=null;
    }
}

/*------------------------------------------------User table ---------------------------------------------------------------*/

interface I_User{

    public function Register($Prp);             
    public function UserExist($Prp);            
    public function Login($Prp);                
    public function UserProfile($Prp,$u_id);    
    public function ChangePswd($Prp,$u_id);     
    public function GetUserDetail($u_id);       
    public function EmailVerify($email);        
    public function UserCount();
    public function UpdateStatus($u_id,$status);

}

class clsUserPrp
{
    private $P_f_name;
    private $P_l_name;
    private $P_email;
    private $P_pswd;
    private $P_gender;
    private $P_act_code;
    private $P_status;
    private $P_phone_no;
    private $P_alt_phone_no;
    private $P_profile_pic;
    private $P_zipcode;
    private $P_city;
    private $P_state;

    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}


class clsUser extends clsConnection implements I_User
{
    public function Register($Prp){
        try{
             
             $sql="INSERT INTO user_tbl (f_name,l_name,email,pswd) VALUES (:f_name,:l_name,:email,:pswd)";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':f_name',$Prp->P_f_name);
             $stmt->bindParam(':l_name',$Prp->P_l_name);
             $stmt->bindParam(':email',$Prp->P_email);
             $stmt->bindParam(':pswd',$Prp->P_pswd);
             $result=$stmt->execute();
           return $result; 
        }
        catch (PDOException $e){
            echo "Register Error:".$e->getMessage();
        }
    }

     public function UpdateStatus($u_id,$status){
        try{

             $sql="UPDATE user_tbl SET online=:status WHERE u_id=:u_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':status',$status);
             $stmt->bindParam(':u_id',$u_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Update Status Error:".$e->getMessage();
        }
    }

    public function UserCount(){
        try{
             $sql="SELECT COUNT(u_id) FROM user_tbl WHERE status=1";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "User Count Fetch Error:".$e->getMessage();
        }
    }



     public function UserExist($Prp){
        try{
             $sql="SELECT * FROM user_tbl WHERE email=:email";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':email',$Prp->P_email);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "User Exist Error:".$e->getMessage();
        }
    }



     public function Login($Prp){
        try{
              
             $sql="SELECT * FROM user_tbl WHERE email=:email AND pswd=:pswd";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':email',$Prp->P_email);
             $stmt->bindParam(':pswd',$Prp->P_pswd);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Login Error:".$e->getMessage();
        }
    }



    public function UserProfile($Prp,$u_id){
        try{

             $sql="UPDATE user_tbl SET gender=:gender,phone_no=:phone_no,alt_phone_no=:alt_phone_no,profile_pic=:profile_pic,zipcode=:zipcode,city=:city,state=:state WHERE u_id=:u_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':gender',$Prp->P_gender);
             $stmt->bindParam(':phone_no',$Prp->P_phone_no);
             $stmt->bindParam(':alt_phone_no',$Prp->P_alt_phone_no);
             $stmt->bindParam(':profile_pic',$Prp->P_profile_pic);
             $stmt->bindParam(':zipcode',$Prp->P_zipcode);
             $stmt->bindParam(':city',$Prp->P_city);
             $stmt->bindParam(':state',$Prp->P_state);
             $stmt->bindParam(':u_id',$u_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Profile Error:".$e->getMessage();
        }
    }



     public function ChangePswd($Prp,$u_id){
        try{

             $sql="UPDATE user_tbl SET pswd=:pswd WHERE u_id=:u_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':pswd',$Prp->P_pswd);
             $stmt->bindParam(':u_id',$u_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Change Pswd Error:".$e->getMessage();
        }
    }


    public function GetUserDetail($u_id){
        try{

             $sql="SELECT * FROM user_tbl WHERE u_id=:u_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':u_id',$u_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "User Details Error:".$e->getMessage();
        }
    }


     public function EmailVerify($email){
        try{
             
                 $status=1;

                 $sql="UPDATE user_tbl SET status=:status WHERE email=:email";
                 $stmt=$this->dbConn->prepare($sql);
                 $stmt->bindParam(':status',$status);
                 $stmt->bindParam(':email',$email);
                 $result=$stmt->execute();
                return $result;
           
           
        }
        catch (PDOException $e){
            echo "Email Verify Error:".$e->getMessage();
        }
    }


}



 
/*------------------------------------------------Hobbies table ---------------------------------------------------------------*/

 interface I_Hobbies{

    public function UserHobbies($u_id,$value);
    public function ShowUserHobby($u_id);
}

class clsHobbiesPrp
{
    private $P_u_id;
    private $P_hobby;

    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}

class clsHobbies extends clsConnection implements I_Hobbies
{


    public function UserHobbies($u_id,$value){
        try{

             $sql="INSERT INTO user_hobbies (u_id,hobby) VALUES (:u_id,:hobby)";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':u_id',$u_id);
             $stmt->bindParam(':hobby',$value);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Hobby Error:".$e->getMessage();
        }
    }

    public function ShowUserHobby($u_id){
        try{
             $sql="SELECT * FROM user_hobbies Where u_id=:u_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':u_id',$u_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Hobby Fetch Error:".$e->getMessage();
        }
    }

}




/*------------------------------------------------WeekendPlans table ---------------------------------------------------------------*/

 interface I_WeekendPlans{

    public function ShowWeekendPlans();   
    public function UserWeekendPlans($plan_id);     
    public function NewWeekendPlans($p_date); 
    public function TripCount();
    public function CurrentWeekendPlans($p_date);
    public function PreviousWeekendPlans($p_date);
    public function UserWeekendHistory($plan_id,$p_date);
}

class clsWeekendPlansPrp
{
    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}


class clsWeekendPlans extends clsConnection implements I_WeekendPlans
{

     public function ShowWeekendPlans(){
        try{
             $sql="SELECT * FROM weekend_plans";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Show Weekend plans Error:".$e->getMessage();
        }
    }

     public function TripCount(){
        try{
             $sql="SELECT COUNT(plan_id) FROM weekend_plans";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Trip Count Fetch Error:".$e->getMessage();
        }
    }


    public function UserWeekendPlans($plan_id){
        try{
             $sql="SELECT * FROM weekend_plans Where plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "User Weekend plans Error:".$e->getMessage();
        }
    }

    public function UserWeekendHistory($plan_id,$p_date){
        try{
             $sql="SELECT * FROM weekend_plans Where plan_id=:plan_id and start_date<:p_date";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->bindParam(':p_date',$p_date);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "User Weekend plans Error:".$e->getMessage();
        }
    }
    
      public function NewWeekendPlans($p_date){
        try{
             $sql="SELECT * FROM weekend_plans Where start_date>:p_date";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':p_date',$p_date);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "New Weekend plans Error:".$e->getMessage();
        }
    }

    public function CurrentWeekendPlans($p_date){
        try{
             $sql="SELECT * FROM weekend_plans Where start_date>=:p_date";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':p_date',$p_date);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Current Weekend plans Error:".$e->getMessage();
        }
    }

    public function PreviousWeekendPlans($p_date){
        try{
             $sql="SELECT * FROM weekend_plans Where start_date<:p_date";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':p_date',$p_date);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Previous Weekend plans Error:".$e->getMessage();
        }
    }

}





/*------------------------------------------------Schedule table ---------------------------------------------------------------*/

 interface I_Schedule{

    public function UserSchedule($plan_id);
}

class clsSchedulePrp
{

    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}


class clsSchedule extends clsConnection implements I_Schedule
{
    public function UserSchedule($plan_id){
        try{
             $sql="SELECT * FROM schedule Where plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "User Schedule Error:".$e->getMessage();
        }
    }

}





/*------------------------------------------------TripGallery table ---------------------------------------------------------------*/

 interface I_TripGallery{

    public function Gallery($plan_id);       
}

class clsTripGalleryPrp
{
    private $P_zipcode;
    private $P_city;
    private $P_state;

    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}


class clsTripGallery extends clsConnection implements I_TripGallery
{

     public function Gallery($plan_id){
        try{
             $sql="SELECT * FROM trip_gallery WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Gallery Error:".$e->getMessage();
        }
    }

}






/*------------------------------------------------PlanPurchase table ---------------------------------------------------------------*/

  interface I_PlanPurchase{

    public function UserTripBooking($Prp);         
    public function AlreadyBooked($u_id,$plan_id); 
    public function ShowAllBooking($u_id);
    public function CancelBooking($u_id,$plan_id);
    public function CountUserTrip($Prp);
    public function CheckBookingLimit($plan_id);
    public function PaymentSuccess($u_id,$plan_id);
    public function ShowMyTrip($u_id);
}

class clsPlanPurchasePrp
{
    private $P_plan_id;
    private $P_u_id;
    private $P_pay_mode;
    private $P_pay_status;
    private $P_booking_member;

    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}


class clsPlanPurchase extends clsConnection implements I_PlanPurchase
{
    public function UserTripBooking($Prp){
        try{
             
             $sql="INSERT INTO plan_purchase (plan_id,u_id,member_booking) VALUES (:plan_id,:u_id,:booking_member)";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$Prp->P_plan_id);
             $stmt->bindParam(':u_id',$Prp->P_u_id);
             $stmt->bindParam(':booking_member',$Prp->P_booking_member);
             $result=$stmt->execute();
           return $result; 
        }
        catch (PDOException $e){
            echo "Trip Booking Error:".$e->getMessage();
        }
    }


    public function PaymentSuccess($u_id,$plan_id){
        try{

             $sql="UPDATE plan_purchase SET pay_status=1 WHERE u_id=:u_id and plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->bindParam(':u_id',$u_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Payment Update Error:".$e->getMessage();
        }
    }

    public function CountUserTrip($u_id){
        try{
             
             $sql="SELECT count(u_id) FROM plan_purchase WHERE u_id=:u_id and pay_status=1";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':u_id',$u_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Trip Booking Error:".$e->getMessage();
        }
    }

    public function CheckBookingLimit($plan_id){
        try{
             
             $sql="SELECT sum(member_booking) FROM plan_purchase WHERE plan_id=:plan_id and pay_status=1";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Trip Booking Error:".$e->getMessage();
        }
    }



     public function AlreadyBooked($u_id,$plan_id){
        try{
             $sql="SELECT * FROM plan_purchase WHERE u_id=:u_id AND plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':u_id',$u_id);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Already Booked Error:".$e->getMessage();
        }
    }

      public function ShowAllBooking($u_id){
        try{
             $sql="SELECT * FROM plan_purchase WHERE u_id=:u_id order by book_date desc";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':u_id',$u_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Show Booking Error:".$e->getMessage();
        }
    }

    public function ShowMyTrip($u_id){
        try{
             $sql="SELECT * FROM plan_purchase WHERE u_id=:u_id and pay_status=1 order by book_date desc";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':u_id',$u_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Show Booking Error:".$e->getMessage();
        }
    }
    
     public function CancelBooking($u_id,$plan_id){
        try{
             $sql="DELETE FROM plan_purchase WHERE u_id=:u_id AND plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':u_id',$u_id);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Cancel Booking Error:".$e->getMessage();
        }
    }


}


/*------------------------------------------------Message table ---------------------------------------------------------------*/

interface I_Message{

    public function UserMessageInsert($Prp);            
    public function UserMessageFetch($receiver_id,$sender_id);          
}

class clsMessagePrp
{
    private $P_sender_id;
    private $P_receiver_id;
    private $P_message;

    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}


class clsMessage extends clsConnection implements I_Message
{
    public function UserMessageInsert($Prp){
        try{
             
             $sql="INSERT INTO message (sender_id,receiver_id,message) VALUES (:sender_id,:receiver_id,:message)";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':sender_id',$Prp->P_sender_id);
             $stmt->bindParam(':receiver_id',$Prp->P_receiver_id);
             $stmt->bindParam(':message',$Prp->P_message);
             $result=$stmt->execute();
           return $result; 
        }
        catch (PDOException $e){
            echo "Message Insert Error:".$e->getMessage();
        }
    }



     public function UserMessageFetch($receiver_id,$sender_id){
        try{
             $sql="SELECT * FROM message WHERE receiver_id=:receiver_id and sender_id=:sender_id or receiver_id=:sender_id and sender_id=:receiver_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':receiver_id',$receiver_id);
             $stmt->bindParam(':sender_id',$sender_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Message Fetch Error:".$e->getMessage();
        }
    }


}


/*------------------------------------------------Contact table ---------------------------------------------------------------*/

 interface I_Contact{

    public function UserContactIssue($Prp);         
        
}

class clsContactPrp
{
    private $P_email;
    private $P_fd_text;
    private $P_name;

    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}


class clsContact extends clsConnection implements I_Contact
{
    public function UserContactIssue($Prp){
        try{
             
             $sql="INSERT INTO feedback (email,fd_text,name) VALUES (:email,:fd_text,:name)";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':email',$Prp->P_email);
             $stmt->bindParam(':fd_text',$Prp->P_fd_text);
             $stmt->bindParam(':name',$Prp->P_name);
             $result=$stmt->execute();
           return $result; 
        }
        catch (PDOException $e){
            echo "User Contect Error:".$e->getMessage();
        }
    }

}


/*------------------------------------------------Review table ---------------------------------------------------------------*/

 interface I_Review{

    public function UserReviews($plan_id); 
    public function TripReviews($plan_id);
    public function CountReview($plan_id);
    public function CountRate($rating,$plan_id);
    public function UserInsertedReviews($u_id,$plan_id);
    public function InsertReview($Prp);
    public function DeleteReview($review_id);

}

class clsReviewPrp
{
    private $P_rating;
    private $P_comment;
    private $P_u_id;
    private $P_plan_id;

    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}


class clsReview extends clsConnection implements I_Review
{

     public function UserReviews($plan_id){
        try{
             $sql="SELECT * FROM review WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Review Fetch Error:".$e->getMessage();
        }
    }

    public function DeleteReview($review_id){
        try{
             $sql="DELETE FROM review WHERE review_id=:review_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':review_id',$review_id);
             $stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Delete Review Error:".$e->getMessage();
        }
    }

     public function InsertReview($Prp){
        try{
             
             $sql="INSERT INTO review (rating,comment,u_id,plan_id) VALUES (:rating,:comment,:u_id,:plan_id)";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':rating',$Prp->P_rating);
             $stmt->bindParam(':comment',$Prp->P_comment);
             $stmt->bindParam(':u_id',$Prp->P_u_id);
             $stmt->bindParam(':plan_id',$Prp->P_plan_id);
             $result=$stmt->execute();
           return $result; 
        }
        catch (PDOException $e){
            echo "Insert Review Error:".$e->getMessage();
        }
    }

    public function UserInsertedReviews($u_id,$plan_id){
        try{
             $sql="SELECT * FROM review WHERE plan_id=:plan_id and u_id=:u_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->bindParam(':u_id',$u_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "User Review Fetch Error:".$e->getMessage();
        }
    }

    public function CountRate($rating,$plan_id){
        try{
             
             $sql="SELECT Count(rating) from review where rating=:rating and plan_id=:plan_id";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':rating',$rating);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Count Rate Error:".$e->getMessage();
        }
    }

     public function TripReviews($plan_id){
        try{
             $sql="SELECT AVG(rating) FROM review WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Trip Review Fetch Error:".$e->getMessage();
        }
    }

    public function CountReview($plan_id){
        try{
             
             $sql="SELECT Count(comment) from review where plan_id=:plan_id";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Count Review Error:".$e->getMessage();
        }
    }

}




/*------------------------------------------------Traffic table ---------------------------------------------------------------*/

 interface I_Traffic{

    public function UpdateTraffic(); 
    public function ShowTraffic();                 
}

class clsTrafficPrp
{

    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}


class clsTraffic extends clsConnection implements I_Traffic
{

    public function UpdateTraffic(){
        try{

             $sql="UPDATE traffic SET views=views+1 WHERE traffic_id=1";
             $stmt=$this->dbConn->prepare($sql);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Traffic Update Error:".$e->getMessage();
        }
    }

    public function ShowTraffic(){
        try{
             $sql="SELECT * FROM traffic";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Traffic Fetch Error:".$e->getMessage();
        }
    }

}



/*------------------------------------------------Notification table ---------------------------------------------------------------*/

 interface I_Notification{

    public function ShowNotification($p_date);

}

class clsNotificationPrp
{

    public function __SET($prp, $val)
    {
        $this->$prp=$val;
    }
    public function &__GET($prp)
    {
        return $this->$prp;
    }
}


class clsNotification extends clsConnection implements I_Notification
{

     public function ShowNotification($p_date){
        try{
             $sql="SELECT * FROM notification Where post_date>=:p_date";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':p_date',$p_date);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Notification Fetch Error:".$e->getMessage();
        }
    }


}


?>