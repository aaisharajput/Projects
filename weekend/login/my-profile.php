<?php session_start();
    require_once('../php/code.php');
    include'../select_lang.php'; 

     $u_id= $_SESSION['u_id'];
       $f_name="";
       $l_name="";
       $email="";
       $gender="";
       $phone_no="";
       $alt_phone_no="";
       $zipcode="";
       $reg_date="";
       $city="";
       $state="";
       $profile_pic="";
       $msg="";
       $msg2="";
       $FunObj=new clsUser();
       $result=$FunObj->GetUserDetail($u_id);
         if ($result) {
               $data=array();

                foreach ($result as $data) {
                   $f_name=$data['f_name'];
                   $l_name=$data['l_name'];
                   $email=$data['email'];
                   $gender=$data['gender'];
                   $phone_no=$data['phone_no'];
                   $alt_phone_no=$data['alt_phone_no'];
                   $zipcode=$data['zipcode'];
                   $reg_date=$data['reg_date'];
                   $city=$data['city'];
                   $state=$data['state'];
                   $profile_pic=$data['profile_pic'];
                 }
            
         }else{
              $msg2=$lang['txt79'];
         }

    
    if (isset($_POST['save'])) {
        $Prp=new clsUserPrp();
        $Prp->P_gender=$_POST['gender'];
        $Prp->P_phone_no=$_POST['phone_no'];
        $Prp->P_alt_phone_no=$_POST['alt_phone_no'];
        $Prp->P_zipcode=$_POST['zipcode'];
        $Prp->P_city=$_POST['city'];
        $Prp->P_state=$_POST['state'];
        
        $pic=$_FILES['photo']['name'];
        if ($pic) {
          $Prp->P_profile_pic=$_FILES['photo']['name'];
        }else{
          $Prp->P_profile_pic=$profile_pic;
        }
        $detail_result=$FunObj->UserProfile($Prp,$u_id);

       $img_name=$_FILES['photo']['name'];
       $tmp_name=$_FILES['photo']['tmp_name'];
       $file_path="photo/";

        move_uploaded_file($tmp_name,$file_path.$img_name);

        if ($detail_result) {
           $msg=$lang['txt17'];
           header("Refresh: 1");
        }else{
           $msg2=$lang['txt80'];
        }
 } 
?>    

<!DOCTYPE html>
<html>
<head>
  <title></title>
<?php include'../links/links.php'; ?>   
<link rel="stylesheet" href="css/my-profile.css">
 </head>
<body>
    
       <?php include'title_bar.php'; ?>     
         <br>

<div class="container-fluid">
<div class="account">
 <h6>account cretaed on <?php echo $reg_date; ?></h6>
 </div>
 <br><br>
  <div class="profile-card">
    <form method="post" enctype="multipart/form-data">
    <div class="image-container">
      <center>

       <img src="photo/<?php echo $profile_pic ; ?> ">  
       
      <input type="file" name="photo" id="file" onchange="show();" hidden>
      <label for="file"><i class="fa fa-plus"></i></label>
      </center>
    </div>
    <div class="main-container">

       <div class="tittle">
        <input id="file_name" readonly>
        <h2><?php echo $f_name; ?> <br><?php echo $l_name; ?>
           </h2>
       </div>
    
         
             <div class="form-group">
               <p><i class="fa fa-envelope info"></i><?php echo $email; ?></p>
               <hr>
                 <?php if($msg){ ?>
                       <div class="alert alert-success text-center">
                           <?php echo $msg; ?><?php echo $msg=""; ?>
                        </div>
                        <?php }
                            ?>
                             <?php if($msg2){ ?>
                       <div class="alert alert-success text-center">
                           <?php echo $msg2; ?><?php echo $msg2=""; ?>
                        </div>
                        <?php }
                            ?>
               <i class="fa fa-user info"></i>
                <select class="form-control" name="gender">
                  <option hidden><?php echo $gender; ?></option>
                  <option value="Male"><?php echo $lang['txt82']; ?></option>
                  <option value="Female"><?php echo $lang['txt83']; ?></option>
                  <option value="Other"><?php echo $lang['txt84']; ?></option>
                </select>
               <i class="fa fa-phone info"></i><input type="tel" name="phone_no" placeholder="<?php echo $lang['txt85']; ?>" value="<?php echo $phone_no; ?>" class="form-control">
               <i class="fa fa-phone info"></i><input type="tel" name="alt_phone_no" placeholder="<?php echo $lang['txt86']; ?>" value="<?php echo $alt_phone_no; ?>" class="form-control">
               <i class="fa fa-home info"></i><input type="text" name="city" placeholder="<?php echo $lang['txt87']; ?>" value="<?php echo $city; ?>" class="form-control">
                                              <input type="tel" name="zipcode" placeholder="<?php echo $lang['txt88']; ?>" value="<?php echo $zipcode; ?>" class="form-control pincode">
                                              <input type="text" name="state" placeholder="<?php echo $lang['txt89']; ?>" value="<?php echo $state; ?>" class="form-control state">
             </div>
              <button type="submit" class="btn btn-primary" name="save"><?php echo $lang['txt90']; ?></button>
         
    </div>
    </form>
  </div>
</div>

<footer>
  <h6><div class="lang_btn">
     <?php echo $lang['lang']; ?>: <a href="my-profile.php?lang=en">EN | </a><a href="my-profile.php?lang=hi">हिन्दी</a><a href="my-profile.php?lang=ur"> | اردو</a>
   </div></h6>
</footer>
<script>
  
  function show(){
         var a=document.getElementById('file').value;
         a=a.substring(12);
           document.getElementById('file_name').value=a;

         }


</script>
</body>
</html>