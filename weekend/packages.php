<?php session_start();
 
     require_once('php/code.php');
 ?>
 <!DOCTYPE html>
<html>
<head>
  <title></title>
<?php include 'links/links.php' ?>

    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/packages.css">
</head>
<body>

    <div class="container-fluid nav-container">
            <?php include 'navbar.php' ?>
              <div class="lang_btn">
               <?php echo $lang['lang']; ?>: <a href="packages.php?lang=en">EN | </a><a href="packages.php?lang=hi">हिन्दी</a><a href="packages.php?lang=ur"> | اردو</a>
              </div>
              
  <section class="packages" id="packages">

    <h1 class="pac-heading">
     <?php if($set_lang=='en'){ ?>    
        <span><?php echo $lang['P']; ?></span>
        <span><?php echo $lang['A']; ?></span>
        <span><?php echo $lang['C']; ?></span>
        <span><?php echo $lang['K']; ?></span>
        <span><?php echo $lang['A']; ?></span>
        <span><?php echo $lang['G']; ?></span>
        <span><?php echo $lang['E']; ?></span>
        <span><?php echo $lang['S']; ?></span>
       <?php  
       }elseif($set_lang=='hi'){ ?>
        <span><?php echo $lang['P']; ?></span>
        <span><?php echo $lang['A']; ?></span>
        <span><?php echo $lang['C']; ?></span>
        <span><?php echo $lang['K']; ?></span>
         <?php  
       }else{?>
        <span><?php echo $lang['P']; ?></span>
        <span><?php echo $lang['A']; ?></span>
        <span><?php echo $lang['C']; ?></span>
        <span><?php echo $lang['K']; ?></span>
        <span><?php echo $lang['G']; ?></span>
        <span><?php echo $lang['E']; ?></span>
      <?php  }       
       
       ?>
    </h1>

    <div class="box-container">
       
         <?php 

                 $FunObj=new clsWeekendPlans();
                 $result=$FunObj->ShowWeekendPlans();
       
                $Obj=new clsTripGallery();
                         
                 $data=array();
                  $row=array();
                 foreach ($result as $data) {
                  $plan_id=$data['plan_id'];
                   
                   $sol=$Obj->Gallery($plan_id);
                  
                   ?> 

        <div class="box">
                <?php
                     foreach ($sol as $row){
                      $source=$row['source'];
                      break;
                      }
                    ?> 
            <img src="img/<?php echo $source; ?>" alt="">
               
               <?php
                     $date1=date_create($data['start_date']);
                     $date2=date_create($data['end_date']);
                      $diff=date_diff($date1,$date2);
                      $day=$diff->format("%a");
                       $night=$day-1;  
                          ?> 

            <div class="content">
                <h3> <i class="fas fa-map-marker-alt"></i> <?php echo $data['destination']; ?> </h3>
                <p> <?php echo $day; ?> <?php echo $lang['day']; ?> <?php echo $night; ?> <?php echo $lang['night']; ?></p>
                <p> <?php echo $lang['group']; ?>: <?php echo $data['members']; ?></p>
                <p> <?php echo $lang['act']; ?>: <?php echo $data['cmn_interest']; ?></p>
                <p> <?php echo $lang['post']; ?>: <?php echo $data['post_date']; ?></p>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="far fa-star"></i>
                </div>
                <?php $fee=$data['fee_charges']; 
                      $extra=rand(100,5000);
                      $sum=$fee+$extra;
                ?>
                <div class="price"> <?php echo $lang['rs']; ?> <?php echo $data['fee_charges']; ?> <span>Rs. <?php echo $sum; ?></span> </div>
               
            </div>
        </div>
           <?php    
                  }
              ?>
    </div>

   </section>

      
<footer>
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-6">
              <h2><?php echo $lang['about_us']; ?></h2>
              <p> <?php echo $lang['about_p']; ?></p>

           <ul class="soc-links">
               <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
               <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
           </ul>
           </div>

           <div class="col-lg-3">
              <h2><?php echo $lang['Quick_Links']; ?></h2>
              <ul>
                  <li><a href="index.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['home']; ?></a></li>
                  <li><a href="about.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['about']; ?></a></li>
                  <li><a href="faq.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['faq']; ?></a></li>
                  <li><a href="contact.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['contact']; ?></a></li>
                  <li><a href="login.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['login']; ?></a></li>
              </ul>
           </div>
           <div class="col-lg-3">
               <h2><?php echo $lang['Contact_Info']; ?></h2>
               
                <p class="contact-p">
                  <i class="fa fa-map-marker"></i> 
                      G.G.M SCIENCE CLG, <br>
                          J&K,180006
                </p>
                     
                  <p class="contact-p">
                   <i class="fa fa-phone"></i>
                      +123 4567 890
                      <br>+123 4567 890
                  </p>

                  <p class="contact-p">
                   <i class="fa fa-envelope"></i> 
                     xyz@gmail.com
                 </p>
                  
                

           </div>
       </div>
   </div>
</footer>
      
 </div>
      <script>
        
        var icon = document.getElementById("icon");
        icon.onclick=function(){
          document.body.classList.toggle("dark-theme");
          if (document.body.classList.contains("dark-theme")) {
            icon.src = "img/sun.png";
          }else{
            icon.src = "img/moon.png";
          }
        }

      </script>
</body>
</html>