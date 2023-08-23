<?php

abstract class clsConnection
{
    protected $dbConn;    
    public function __construct()
    {        
        $dbHost="localhost";  
        $dbName="explore";  
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

    public function Login($Prp);                //done
    public function UserProfile($Prp,$u_id);    //done
    public function ChangePswd($Prp,$u_id);     //done
    public function GetUserDetail($u_id);       //done
    public function GetAllUserDetail();
    public function StatusUser(); 
    public function DeleteUser($u_id);
    public function UserCount();
    public function UserExist($Prp);
    public function UpdateStatus($u_id,$status);
    public function AdminProfile($Prp,$u_id);
    public function GetAllUserDetailDesc();

}

class clsUserPrp
{
    private $P_email;
    private $P_pswd;

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

      public function GetAllUserDetail(){
        try{
              
             $sql="SELECT * FROM user_tbl";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "user fetch Error:".$e->getMessage();
        }
    }

    public function GetAllUserDetailDesc(){
        try{
              
             $sql="SELECT * FROM user_tbl order by reg_date desc";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "user fetch Error:".$e->getMessage();
        }
    }

      public function AdminProfile($Prp,$u_id){
        try{

             $sql="UPDATE user_tbl SET f_name=:f_name,l_name=:l_name,profile_pic=:profile_pic WHERE u_id=:u_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':f_name',$Prp->P_f_name);
             $stmt->bindParam(':l_name',$Prp->P_l_name);
             $stmt->bindParam(':profile_pic',$Prp->P_profile_pic);
             $stmt->bindParam(':u_id',$u_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Profile Error:".$e->getMessage();
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

    public function UserCount(){
        try{
             $sql="SELECT COUNT(u_id) FROM user_tbl WHERE status=1";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Address Fetch Error:".$e->getMessage();
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


    public function GetUserDetail($u_id){
        try{

             $sql="SELECT * FROM user_tbl where u_id=:u_id";
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

    public function StatusUser(){
         try{

             $sql="SELECT * FROM user_tbl WHERE status=0";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "User Details Error:".$e->getMessage();
        }
    }

    public function DeleteUser($u_id){
         try{

             $sql="DELETE FROM user_tbl WHERE u_id=:u_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':u_id',$u_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "User Details Error:".$e->getMessage();
        }
    }

}



 
/*------------------------------------------------Hobbies table ---------------------------------------------------------------*/

 interface I_Hobbies{

    public function UserHobbies($u_id);
}

class clsHobbiesPrp
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

class clsHobbies extends clsConnection implements I_Hobbies
{


    public function UserHobbies($u_id){
        try{

             $sql="SELECT * FROM user_hobbies where u_id=:u_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':u_id',$u_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Hobby Error:".$e->getMessage();
        }
    }

}




/*------------------------------------------------WeekendPlans table ---------------------------------------------------------------*/

 interface I_WeekendPlans{

    public function ShowWeekendPlans();   
    public function UserWeekendPlans($plan_id);     
    public function NewWeekendPlans($p_date); 
    public function PreviousWeekendPlan($current_date);
    public function TripCount();
    public function UpdateTrip($Prp,$plan_id);
    public function DeleteTrip($plan_id);
    public function InsertTrip($Prp);
    public function GetPlanId($trip_name);
}

class clsWeekendPlansPrp
{
    private $P_pickup_point;
    private $P_trip_name;
    private $P_arrival_time;
    private $P_start_date;
    private $P_end_date;
    private $P_destination;
    private $P_fee_charges;
    private $P_members;
    private $P_booking_member;
    private $P_cmn_interest;
    private $P_stay_address;
    private $P_note;
    private $P_map;

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
             $sql="SELECT * FROM weekend_plans order by post_date desc";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Show Weekend plans Error:".$e->getMessage();
        }
    }

        public function UpdateTrip($Prp,$plan_id){
        try{

             $sql="UPDATE weekend_plans SET pickup_point=:pickup_point,arrival_time=:arrival_time,start_date=:start_date,end_date=:end_date,destination=:destination,fee_charges=:fee_charges,members=:members,booking_member=:booking_member,cmn_interest=:cmn_interest,stay_address=:stay_address,note=:note WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':pickup_point',$Prp->P_pickup_point);
             $stmt->bindParam(':arrival_time',$Prp->P_arrival_time);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->bindParam(':start_date',$Prp->P_start_date);
             $stmt->bindParam(':end_date',$Prp->P_end_date);
             $stmt->bindParam(':destination',$Prp->P_destination);
             $stmt->bindParam(':fee_charges',$Prp->P_fee_charges);
             $stmt->bindParam(':members',$Prp->P_members);
             $stmt->bindParam(':booking_member',$Prp->P_booking_member);
             $stmt->bindParam(':cmn_interest',$Prp->P_cmn_interest);
             $stmt->bindParam(':stay_address',$Prp->P_stay_address);
             $stmt->bindParam(':note',$Prp->P_note);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Plan Update Error:".$e->getMessage();
        }
    }

    public function GetPlanId($trip_name){
         try{
             $sql="SELECT * FROM weekend_plans Where trip_name=:trip_name";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':trip_name',$trip_name);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "User Weekend plans Error:".$e->getMessage();
        }
    }

    public function InsertTrip($Prp){
        try{
             
             $sql="INSERT INTO weekend_plans (trip_name,pickup_point,arrival_time,start_date,end_date,destination,fee_charges,members,cmn_interest,stay_address,note,booking_member,map) VALUES (:trip_name,:pickup_point,:arrival_time,:start_date,:end_date,:destination,:fee_charges,:members,:cmn_interest,:stay_address,:note,:booking_member,:map)";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':pickup_point',$Prp->P_pickup_point);
             $stmt->bindParam(':arrival_time',$Prp->P_arrival_time);
             $stmt->bindParam(':trip_name',$Prp->P_trip_name);
             $stmt->bindParam(':start_date',$Prp->P_start_date);
             $stmt->bindParam(':end_date',$Prp->P_end_date);
             $stmt->bindParam(':destination',$Prp->P_destination);
             $stmt->bindParam(':fee_charges',$Prp->P_fee_charges);
             $stmt->bindParam(':members',$Prp->P_members);
             $stmt->bindParam(':booking_member',$Prp->P_booking_member);
             $stmt->bindParam(':cmn_interest',$Prp->P_cmn_interest);
             $stmt->bindParam(':stay_address',$Prp->P_stay_address);
             $stmt->bindParam(':note',$Prp->P_note);
             $stmt->bindParam(':map',$Prp->P_map);
             $result=$stmt->execute();
           return $result; 
        }
        catch (PDOException $e){
            echo "Trip Insert Error:".$e->getMessage();
        }
    }



         public function DeleteTrip($plan_id){
         try{

             $sql="DELETE FROM weekend_plans WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Trip Delete Error:".$e->getMessage();
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
    
      public function NewWeekendPlans($p_date){
        try{
             $sql="SELECT * FROM weekend_plans Where start_date>=:p_date";
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
    public function PreviousWeekendPlan($curr_date){
        try{
             $sql="SELECT * FROM weekend_plans Where start_date<:curr_date";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':curr_date',$curr_date);
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

    public function ShowSchedule();         
    public function UserSchedule($plan_id);
    public function UpdateTrip($Prp);
    public function DeleteTrip($plan_id);
    public function InsertTrip($Prp);
    public function DeleteSchedule($s_no);
}

class clsSchedulePrp
{
    private $P_location;
    private $P_event;
    private $P_s_no;
    private $P_photo;

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

     public function ShowSchedule(){
        try{
             $sql="SELECT * FROM schedule";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Show Schedule Error:".$e->getMessage();
        }
    }

     public function InsertTrip($Prp){
        try{
             
             $sql="INSERT INTO schedule (plan_id,location,event,photo) VALUES (:plan_id,:location,:event,:photo)";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$Prp->P_plan_id);
             $stmt->bindParam(':location',$Prp->P_location);
             $stmt->bindParam(':event',$Prp->P_event);
             $stmt->bindParam(':photo',$Prp->P_photo);
             $result=$stmt->execute();
           return $result; 
        }
        catch (PDOException $e){
            echo "Schedule Insert Error:".$e->getMessage();
        }
    }


        public function UpdateTrip($Prp){
        try{

             $sql="UPDATE schedule SET location=:location,event=:event WHERE s_no=:s_no";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':location',$Prp->P_location);
             $stmt->bindParam(':event',$Prp->P_event);
             $stmt->bindParam(':s_no',$Prp->P_s_no);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Plan Update Error:".$e->getMessage();
        }
    }

    public function DeleteSchedule($s_no){
         try{

             $sql="DELETE FROM schedule WHERE s_no=:s_no";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':s_no',$s_no);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "User Details Error:".$e->getMessage();
        }

     }

     public function DeleteTrip($plan_id){
         try{

             $sql="DELETE FROM schedule WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "User Details Error:".$e->getMessage();
        }

     }

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
    public function InsertImage($Prp);   
    public function DeleteGallery($gallery_id);   
    public function DeleteTrip($plan_id);
}

class clsTripGalleryPrp
{
    private $P_plan_id;
    private $P_source;

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

       public function DeleteTrip($plan_id){
         try{

             $sql="DELETE FROM trip_gallery WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Trip Delete Error:".$e->getMessage();
        }

     }


    public function InsertImage($Prp){
        try{
             
             $sql="INSERT INTO trip_gallery (plan_id,source) VALUES (:plan_id,:source)";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$Prp->P_plan_id);
             $stmt->bindParam(':source',$Prp->P_source);
             $result=$stmt->execute();
           return $result; 
        }
        catch (PDOException $e){
            echo "Schedule Insert Error:".$e->getMessage();
        }
    }

      public function DeleteGallery($gallery_id){
         try{

             $sql="DELETE FROM trip_gallery WHERE gallery_id=:gallery_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':gallery_id',$gallery_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "User Details Error:".$e->getMessage();
        }

     }

}






/*------------------------------------------------PlanPurchase table ---------------------------------------------------------------*/

 interface I_PlanPurchase{

    public function PaidUserCount($plan_id); 
    public function TotalUserCount($plan_id);         
    public function UserPlanPurchase($plan_id);
    public function AllPlanPurchase();
    public function Status();
    public function DeleteTrip($plan_id);
}

class clsPlanPurchasePrp
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


class clsPlanPurchase extends clsConnection implements I_PlanPurchase
{

     public function PaidUserCount($plan_id){
        try{
             $sql="SELECT SUM(member_booking) FROM plan_purchase WHERE plan_id=:plan_id AND pay_status=1";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Address Fetch Error:".$e->getMessage();
        }
    }

     public function DeleteTrip($plan_id){
         try{

             $sql="DELETE FROM plan_purchase WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Trip Delete Error:".$e->getMessage();
        }

     }


    public function Status(){
        try{
             $sql="SELECT * FROM plan_purchase WHERE pay_status=1";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Status Fetch Error:".$e->getMessage();
        }
    }

    public function TotalUserCount($plan_id){
        try{
             $sql="SELECT SUM(member_booking) FROM plan_purchase WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Address Fetch Error:".$e->getMessage();
        }
    }

      public function UserPlanPurchase($plan_id){
        try{
             $sql="SELECT * FROM plan_purchase WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Address Fetch Error:".$e->getMessage();
        }
    }

     public function AllPlanPurchase(){
        try{
             $sql="SELECT * FROM plan_purchase";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Address Fetch Error:".$e->getMessage();
        }
    }



}





/*------------------------------------------------Message table ---------------------------------------------------------------*/
interface I_Message{

    public function UserMessageInsert($Prp);            
    public function UserMessageFetch($receiver_id,$sender_id);   
    public function UserListFetch();       
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

    public function UserListFetch(){
        try{
             $sql="SELECT distinct sender_id FROM message WHERE sender_id!=21 order by msg_date desc";
             $stmt=$this->dbConn->prepare($sql);
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

    public function UserContactIssue();             
    public function GetUserDetail($fd_id);
    public function DeleteUser($fd_id);
    public function UpdateMailStatus($fd_id);
}

class clsContactPrp
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


class clsContact extends clsConnection implements I_Contact
{
    public function UserContactIssue(){
        try{
             
             $sql="SELECT * FROM feedback order by fd_id desc";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result; 
        }
        catch (PDOException $e){
            echo "Address Insert Error:".$e->getMessage();
        }
    }

    public function GetUserDetail($fd_id){
        try{

             $sql="SELECT * FROM feedback where fd_id=:fd_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':fd_id',$fd_id);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "User Details Error:".$e->getMessage();
        }
    }
 public function DeleteUser($fd_id){
         try{

             $sql="DELETE FROM feedback WHERE fd_id=:fd_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':fd_id',$fd_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "User Details Error:".$e->getMessage();
        }
    }   

    public function UpdateMailStatus($fd_id){
        try{

             $sql="UPDATE feedback SET status='mailed' WHERE fd_id=:fd_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':fd_id',$fd_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Address Update Error:".$e->getMessage();
        }
    } 

}





/*------------------------------------------------Review table ---------------------------------------------------------------*/

 interface I_Review{

    public function AllReviews();
    public function CountReview($plan_id);         
    public function UserReviews($plan_id); 
    public function TripReviews($plan_id);
    public function CountRate($rating,$plan_id);
    public function DeleteReview($review_id);
    public function DeleteTrip($plan_id);
}

class clsReviewPrp
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


class clsReview extends clsConnection implements I_Review
{
    public function AllReviews(){
        try{
             
             $sql="SELECT distinct plan_id from review ";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Address Insert Error:".$e->getMessage();
        }
    }

      public function DeleteTrip($plan_id){
         try{

             $sql="DELETE FROM review WHERE plan_id=:plan_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':plan_id',$plan_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Trip Delete Error:".$e->getMessage();
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
            echo "Show Booking Error:".$e->getMessage();
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
            echo "Address Insert Error:".$e->getMessage();
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
            echo "Address Insert Error:".$e->getMessage();
        }
    }

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
            echo "Review Fetch Error:".$e->getMessage();
        }
    }



}




/*------------------------------------------------Notification table ---------------------------------------------------------------*/

 interface I_Notification{

    public function NotificationInsert($Prp);      
    public function DeleteNotification($notify_id);   
    public function UpdateNotification($Prp);
    public function ShowNotification($p_date);

}

class clsNotificationPrp
{
    private $P_notify_id;
    private $P_trip_name;
    private $P_post_date;

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
    public function NotificationInsert($Prp){
        try{
             
             $sql="INSERT INTO notification (trip_name,post_date) VALUES (:trip_name,:post_date)";

             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':trip_name',$Prp->P_trip_name);
             $stmt->bindParam(':post_date',$Prp->P_post_date);
             $result=$stmt->execute();
           return $result; 
        }
        catch (PDOException $e){
            echo "Notification Insert Error:".$e->getMessage();
        }
    }

    public function DeleteNotification($notify_id){
         try{

             $sql="DELETE FROM notification WHERE notify_id=:notify_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':notify_id',$notify_id);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "User Details Error:".$e->getMessage();
        }
    }  


     public function UpdateNotification($Prp){
        try{

             $sql="UPDATE notification SET trip_name=:trip_name WHERE notify_id=:notify_id";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->bindParam(':notify_id',$Prp->P_notify_id);
             $stmt->bindParam(':trip_name',$Prp->P_trip_name);
             $result=$stmt->execute();
           return $result;
        }
        catch (PDOException $e){
            echo "Address Update Error:".$e->getMessage();
        }
    }

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
            echo "Review Fetch Error:".$e->getMessage();
        }
    }


}




/*------------------------------------------------Traffic table ---------------------------------------------------------------*/

 interface I_Traffic{

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

    public function ShowTraffic(){
        try{
             $sql="SELECT * FROM traffic";
             $stmt=$this->dbConn->prepare($sql);
             $stmt->execute();
             $result=$stmt->fetchAll();
           return $result;
        }
        catch (PDOException $e){
            echo "Review Fetch Error:".$e->getMessage();
        }
    }

}


?>

