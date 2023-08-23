<?php session_start();
 include'select_lang.php';
     if (isset($_POST['login'])) {
         header("location:login.php?lang=$set_lang");
         exit();
     }
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
<?php include 'links/links.php' ?>
    <link rel="stylesheet" href="css/forget-pswd.css">
</head>
<body>
    <div class="container">
        <div class="row">
             <div class="col-md-12 form">
                <form action="" method="POST" autocomplete="off">
                    <h2 class="text-center"><?php echo $lang['code']; ?></h2>
                    
                       <div class="alert alert-success text-center">
                           <?php echo $lang['txt110']; ?>
                        </div>
                   
                       
                    <div class="form-group">
                       <input class="form-control button" type="submit" name="login" value="<?php echo $lang['s_login']; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>