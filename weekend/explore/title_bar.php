 

   <?php include'new.php'; ?>

<style>
    .dropdown-menu .dropdown-item{
        color: #000;
    }
     .dropdown-menu .dropdown-item:focus{
        background: #fff;
    }
    .dropdown-toggle{
        padding: 0;
    }
</style>

       <div class="col-md-3 col-sm-12 sidebar" id="sidebar">
         <div class="stick">
             <h2><?php echo $lang['admin'];?></h2>

            <ul>
                <li class="active">
                     <a href="dash.php?lang=<?php echo $set_lang; ?>" class=""><?php echo $lang['s_dash'];?></a>
                </li>
                <li>
                     <a href="user_tbl.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['tang'];?></a>
                </li>
                 <li>
                     <a class="nav-link dropdown-toggle" href="transaction_tbl.php?lang=<?php echo $set_lang; ?>" id="navbardrop" data-toggle="dropdown">
                      <?php echo $lang['trip'];?>
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="trip_tbl.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['trip_his'];?></a>
                      <a class="dropdown-item" href="new_trip_tbl.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['new-tr'];?></a>
                      <a class="dropdown-item" href="notification.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['noti'];?></a>
                    </div>
                 </li>
                 <li>
                     <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                      <?php echo $lang['pays'];?>
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="transaction_tbl.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['pay_his'];?></a>
                      <a class="dropdown-item" href="new_payment_tbl.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['new_pay'];?></a>
                    </div>
                 </li>
                 <li>
                     <a href="review_tbl.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['rev'];?></a>
                </li>
                <li>
                     <a href="contact_tbl.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['cont'];?></a>
                </li>
                <li>
                     <a href="user-chat-list.php?lang=<?php echo $set_lang;?>"><?php echo $lang['cht'];?></a>
                </li>
                  <li>
                     <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                      <i class="fa fa-user"></i>
                    </a>
                    <div class="dropdown-menu">
                      <a class="dropdown-item" href="new-pswd.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['chnge_pswd'];?></a>
                      <a class="dropdown-item" href="logout.php?lang=<?php echo $set_lang; ?>"><?php echo $lang['log'];?></a>
                    </div>
                 </li>
            </ul>
          </div>
        </div>

      