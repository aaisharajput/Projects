<?php session_start();
 
     require_once('php/code.php');
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

    <link rel="stylesheet" href="css/table-style.css">

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
                           <?php echo $lang['lang']; ?>: <a href="contact_tbl.php?lang=en">EN | </a><a href="contact_tbl.php?lang=hi">हिन्दी</a><a href="contact_tbl.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
          <!-- content start -->
                        <div class="main-div ">
                           <h1><?php echo $lang['user_i'];?></h1>
                            <div class="table-responsive">
      
                              <table class="table table-light table-hover table-striped" >
                                  <tr class="sticky">
                                      <th><b><?php echo $lang['named'];?></b></th>
                                      <th><b><?php echo $lang['mail'];?></b></th>
                                      <th><b><?php echo $lang['status'];?></b></th>
                                      <th><?php echo $lang['oper'];?></th>
                                  </tr>
                                  <?php
                                    $msg="";
                                        $obj=new clsContact();
                                      $result=$obj->UserContactIssue();
                                      if ($result) {
                                        $arr=array();
                                        foreach ($result as $arr) {
                                          ?>
                                          <tr>
                                      <td><?php echo $arr['name'];?></td>
                                      <td><?php echo $arr['email'];?></td>
                                      <td><?php echo $arr['status'];?></td>
                                      <td><button  class="btn btn-success" value="<?php echo $arr['fd_id'];?>" onclick="userissues(this);"><?php echo $lang['see_m'];?></button></td>
                                 </tr>

                                          <?php
                                        }
                                      }else{
                                         $msg="NO ISSUE";
                                      }

                                  ?>
                                                               
                  
                         </table>
                         <p><?php 
                              echo $msg;
                              ?></p>
                    </div>
                </div>  
                   <!--content end-->
               </div>
               
                  <div>
                    
                  </div>
               </div>

           </div>
        </div>
     </div><script>
        function show(){
             document.getElementById('sidebar').classList.toggle('open');
         }


   function userissues(id)
    {
       var fd_id=$(id).val();
       var action="user_issue";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {user_issue:action,fd_id:fd_id},
                      success: function(data){
                         window.location.href="contact_details.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }
      </script>

</body>
</html>