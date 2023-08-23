<?php session_start();
 
     require_once('php/code.php');
     $u_id=$_SESSION['us_id'];
     if (isset($_POST['delete'])) {
       $fun=new clsUser();
       $sol=$fun->DeleteUser($u_id);
       header("location:user_tbl.php?lang=$set_lang");
     }

        $a_id=$_SESSION['u_id'];
     $obj=new clsUser();
     $fun=$obj->GetUserDetail($a_id);
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

<?php include 'links/links.php'; ?>

    <link rel="stylesheet" href="css/user_details.css">

</head>
<body>

     <div class="container-fluid">
      <div class="row">
           <?php include 'title_bar.php'; ?>
           
           <div class="col-md-9 col-sm-12">

               <div class="row dash_content">
                  <div class="col-12 header">
                    <div>
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['user'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="user_details.php?lang=en">EN | </a><a href="user_details.php?lang=hi">हिन्दी</a><a href="user_details.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
           
          <a href="user_tbl.php?lang=<?php echo $set_lang; ?>"> <i class="fa fa-arrow-left"></i></a>
              <div class="form-div">
             <!-- content start -->


                  <div class="container-fluid">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home"><?php echo $lang['det'];?></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#menu1"><?php echo $lang['int'];?></a>
                      </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div id="home" class="container tab-pane active"><br>
                        
                             <div class="container form-design">
                              <div class="row">
                              <?php
                                  

                                  $result=$obj->GetUserDetail($u_id);
                                   $arr=array();
                                   foreach ($result as $arr) {
                                   ?>
                                 <div class="col-md-12">
                                 <h2 class="txt_color"><?php echo $lang['users_d'];?></h2>
                                     <hr>
                                  </div>
                                     <div class="col-md-5">
                                      <div class="img-container">
                                       <img src="../login/photo/<?php echo $arr['profile_pic'];?>">
                                     </div>
                                   </div>
                                     <div class="col-md-7">
                                   <p><?php echo $lang['nam'];?><b>:</b> <?php echo $arr['f_name']." ".$arr['l_name'];?></p>
                                   <p><?php echo $lang['email'];?><b>:</b> <?php echo $arr['email'];?></p>
                                   <p><?php echo $lang['gen'];?><b>:</b> <?php echo $arr['gender'];?></p>
                                   <p><?php echo $lang['phone'];?><b>:</b> <?php echo $arr['phone_no'];?></p>
                                   <p><?php echo $lang['alt'];?><b>:</b> <?php echo $arr['alt_phone_no'];?></p>
                                   <p><?php echo $lang['add'];?><b>:</b> <?php echo $arr['city'];?></p>
                                   <p><?php echo $lang['zip'];?><b>:</b>  <?php echo $arr['zipcode'];?></p>
                                   <p><?php echo $lang['verf'];?> <b>:</b>  <?php 
                                                                                   if($arr['status']==1){
                                                                                    echo"verified";
                                                                                   }else{
                                                                                    echo"pending";
                                                                                   }

                                                                            ?></p> 
                                      <?php 
                                         if ($arr['status']==0) {
                                          
                                      ?>                
                                                           
                                   <form method="POST">                                           
                                   <div class="btn-design">  
                                    <button class="btn btn-danger" name="delete"><?php echo $lang['del'];?></button>
                                   </div>
                                   </form>   
                                 <?php } ?>
                                   <?php
                                 }
                               
                               ?>
                             </div>
                               </div> 
                             </div>


                      </div>
                       <div id="menu1" class="container tab-pane fade"><br>
                        
                                    <div class="form-design">
            
                                 <h2 class="txt_color"><?php echo $lang['user_int'];?></h2>
                                 <hr>
                                 <ol type="1">
                                 <?php
                                      $Funobj=new clsHobbies();
                                      $sol=$Funobj->UserHobbies($u_id);
                                      $row=array();
                                      if ($sol) {
                                        foreach ($sol as $row) {
                                       
                                 ?>
                                    
                                  <li> <p><b>:</b> <?php echo $row['hobby'];?></p></li>
                           
                                      <?php
                                         }
                                       }else {
                                         echo "<h4>".$lang['not_provided']."</h4>";
                                       }
                                         ?>
                                    </ol>     
                             </div>
                           
                       </div>
               
                     </div>
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
      </script>
</body>
</html>