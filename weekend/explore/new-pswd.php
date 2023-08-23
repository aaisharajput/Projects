<?php session_start();
 
     require_once('php/code.php');
    include'new.php';
    $pswd="";
    $u_id= $_SESSION['u_id'];
    $msg="";
    $err="";
   
    if (isset($_POST['change-password'])) {
            $n_pswd=$_POST['password'];
             $c_pswd=$_POST['cpassword'];
            $o_pswd=md5($_POST['old-password']);
           $FunObj=new clsUser();

          $result=$FunObj->GetUserDetail($u_id);
          if ($result) {
               $data=array();

                foreach ($result as $data) {
                   $pswd=$data['pswd'];
                 }
            
         }else{
              $err=$lang['txt91'];
         }
  
        
   if ($pswd==$o_pswd) {
       
        if ($n_pswd==$c_pswd) {
           
          $Prp=new clsUserPrp();
          $Prp->P_pswd=md5($n_pswd);

          $FunObj=new clsUser();

         $change=$FunObj->ChangePswd($Prp,$u_id);
         if ($change) {
             $msg=$lang['text_6'];;
         }else{
            $err=$lang['pswd_not_change'];
         }
       }else{
             $err=$lang['confirm_not_match'];
       }
   }else{
        $err=$lang['txt95'];
   }

 } 



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

    <link rel="stylesheet" href="css/new-pswd.css">

</head>
<body>

     <div class="container-fluid">
      <div class="row">
          <?php include'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

               <div class="row dash_content">
                  <div class="col-12 header">
                    <div>
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['chng_pswd'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo  $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="new-pswd.php?lang=en">EN | </a><a href="new-pswd.php?lang=hi">हिन्दी</a><a href="new-pswd.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12 form">
          <!-- content start -->
                  <div class="form-div">

                  <form action="" method="POST" autocomplete="off">
                    <h2 class="text-center"><?php echo $lang['chnge_pswd'];?></h2>
                    
                         <?php if($msg){ ?>
                       <div class="alert alert-success text-center">
                           <?php echo $msg; ?><?php echo $msg=""; ?>
                        </div>
                        <?php }
                            ?>
                            <?php if($err){ ?>
                       <div class="alert alert-danger text-center">
                           <?php echo $err; ?><?php echo $err=""; ?>
                        </div>
                        <?php }
                            ?>
                      <div class="form-group">
                        <input class="form-control" type="text" name="old-password" placeholder="Old password" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Create new password" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change">
                    </div>
                </form>

                
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

      </script>
</body>
</html>