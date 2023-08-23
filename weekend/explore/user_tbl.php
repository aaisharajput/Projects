<?php session_start();
 
     require_once('php/code.php');
        $u_id=$_SESSION['u_id'];
     $FunObj=new clsUser();
     $fun=$FunObj->GetUserDetail($u_id);
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
                   <h3> <i class="fa fa-bars" id="fa-bars" onclick="show();"></i></h3><h2><?php echo $lang['user'];?></h2></div>
                    <div class="profile">
                      <div class="img">
                        <img src="../login/photo/<?php echo $profile_pic; ?>">
                      </div>
                      <h4><?php echo $a_name;?></h4>
                      <span><?php echo $lang['super'];?></span>
                          <div class="multi_lang" >
                           <?php echo $lang['lang']; ?>: <a href="user_tbl.php?lang=en">EN | </a><a href="user_tbl.php?lang=hi">हिन्दी</a><a href="user_tbl.php?lang=ur"> | اردو</a>
                        </div>
                    </div>
                  </div>


          <div class="col-lg-12">
          <!-- content start -->
                        <div class="main-div ">
                           <h1><?php echo $lang['users_d'];?></h1>
                            <div class="table-responsive">
      
                              <table class="table table-light table-hover table-striped" >
                                  <tr class="sticky">
                                      <th><b><?php echo $lang['named'];?></b></th>
                                      <th><b><?php echo $lang['re_da'];?></b></th>
                                      <th><b><?php echo $lang['verf'];?></b></th>
                                      <th><?php echo $lang['opera'];?></th>
                                  </tr>

             <?php 
     
                 
                 $result=$FunObj->GetAllUserDetailDesc();

               if($result){
                  $data=array();
                  foreach ($result as $data) {                    
               
          ?>
                                 <tr>
                                      <td><?php echo $data['f_name']; ?></td>
                                      <td><?php echo $data['reg_date']; ?></td>
                                      <td><?php 
                                                  if ($data['status']==0) {
                                                    echo "pending";
                                                  }else{
                                                    echo "verified";
                                                  }
                                                   ?> </td>
                                      <td><button  class="btn btn-success" value="<?php echo $data['u_id']; ?>" onclick="getuserid(this);"><?php echo $lang['see_m'];?></button></td>
                                 </tr>
               <?php 
                  }
                }
                ?>
                  
                         </table>
                    </div>
                </div>  
                   <!--content end-->
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


         function getuserid(id)
    {
       var us_id=$(id).val();
       var action="get_id";
       $.ajax({
                     type: 'POST',
                     url: 'php/session.php',
                     data: {get_id:action,us_id:us_id},
                      success: function(data){
                         window.location.href="user_details.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }

      </script>
</body>
</html>