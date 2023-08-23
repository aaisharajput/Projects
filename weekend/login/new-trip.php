<?php session_start();
 
     require_once('../php/code.php');
   
 ?>
 <!DOCTYPE html>
<html lang="en">
   <head>
      
      <title></title>
 <?php include'../links/links.php'; ?>
    
          <link rel="stylesheet" href="new-trip.css">
   </head>
   <body>
<?php include'title_bar.php'; ?>

 
 <div class="container">
   <div class="row">
    <div class="col-md-12">
      <h1><?php echo $lang['txt15']; ?></h1>
    </div>
   
     <?php 
                 $p_date=date("Y-m-d");
     
                 $FunObj=new clsWeekendPlans();
                 $result=$FunObj->NewWeekendPlans($p_date);

                 $Obj=new clsTripGallery();

               if($result){
                  $data=array();
                  $row=array();
                  foreach ($result as $data) {
                  $plan_id=$data['plan_id'];
                   $sol=$Obj->Gallery($plan_id);
                    
               
          ?>
     <div class="col-md-6">
      <div class="img-container">
       <?php
               foreach ($sol as $row){
                $source=$row['source'];
                break;
               }
           ?> 
        <img src="../img/<?php echo $source; ?>">
       <button class="btn" value="<?php echo $plan_id;?>" onclick="getplanid(this);"><?php echo $data['trip_name']; ?>  <br><?php echo $data['destination']; ?></button>
     
      </div>
     </div>
   <?php    
           }
               }else{
                ?>
               <div class="col-md-12">
                 <div class="no-trip">
                  <h3>Sorry!! No Weekend Trips Yet!!</h3>
                 </div>
               </div>
                <?php
               }
           ?>
   </div>
 </div>

<footer>
  <h6><div class="lang_btn">
     <?php echo $lang['lang']; ?>: <a href="new-trip.php?lang=en">EN | </a><a href="new-trip.php?lang=hi">हिन्दी</a><a href="new-trip.php?lang=ur"> | اردو</a>
   </div></h6>
</footer>

 <script type="text/javascript">

   function getplanid(id)
    {
       var weekend_id=$(id).val();
       var action="trip_details";
       $.ajax({
                     type: 'POST',
                     url: '../php/session.php',
                     data: {trip_details:action,weekend_id:weekend_id},
                      success: function(data){
                         window.location.href="trip-details.php?lang=<?php echo $set_lang; ?>";                  
                         }
                });
    }

</script>

   </body>
</html>

