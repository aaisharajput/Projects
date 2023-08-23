<?php session_start();
 
     if (isset($_POST['login'])) {
         header("location:index.php");
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
                    <h2 class="text-center">Code Verification</h2>
                    
                       <div class="alert alert-success text-center">
                           Password changed succesfully. Login again!!
                        </div>
                   
                       
                    <div class="form-group">
                       <input class="form-control button" type="submit" name="login" value="Login">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>