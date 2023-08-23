<?php include'../select_lang.php'; ?>

<nav class="navbar navbar-expand-md  fixed-top">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Explore</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <i class="fa fa-bars"></i>
  </button>
   
  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="home.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['home']; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="new-trip.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['txt1']; ?></a>
      </li>
     
       
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
       <?php echo $lang['txt2']; ?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="booking-history.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['txt3']; ?></a>
        <a class="dropdown-item" href="trip-booked.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['txt4']; ?></a>
      </div>
    </li>
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <?php echo $lang['txt5']; ?>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="my_trip.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['txt6']; ?></a>
        <a class="dropdown-item" href="all_trip.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['txt7']; ?></a>
      </div>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <i class="fa fa-user"></i>
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="my-profile.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['txt9']; ?></a>
        <a class="dropdown-item" href="new-pswd.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['txt10']; ?></a>
      </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="logout.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['txt8']; ?></a>
      </li>
    </ul>
  </div>
</nav>
<br><br>