<?php  include'select_lang.php';?>

 <nav class="navbar navbar-expand-lg ">
               <a class="navbar-brand" href="#">
                 <img src="img/car.png" class="logo">
               </a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                 <span class="navbar-toggler-icon"></span>
                 <label for="navbar-toggler-icon"><i class="fas fa-bars"></i></label>
               </button>
               <div class="collapse navbar-collapse" id="collapsibleNavbar">
                  <ul class="navbar-nav">
                   <li class="nav-item">
                      <a class="nav-link" href="index.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['home']; ?></a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" href="about.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['about']; ?></a>
                   </li>
                     <li class="nav-item">
                     <a class="nav-link" href="contact.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['contact']; ?></a>
                   </li>
                   <li class="nav-item">
                     <a class="nav-link" href="faq.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['faq']; ?></a>
                   </li> 
                   <li class="nav-item">
                     <a class="nav-link" href="login.php?lang=<?php echo $set_lang; ?>"><button class="btn log-in"><?php echo $lang['login']; ?></button></a>
                   </li>   
                   <li class="nav-item">
                     <a class="nav-link" href="#"><img src="img/moon.png" id="icon"></a>
                   </li>  
                 </ul>
               </div>  
             </nav>
                
