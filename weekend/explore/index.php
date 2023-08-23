<?php session_start();
 
     require_once('php/code.php');
    $msg="";
   if (isset($_POST['signup'])) {
      $Prp=new clsUserPrp();
      $Prp->P_email=$_POST['email'];
      $Prp->P_pswd=md5($_POST['pswd']);

       $FunObj=new clsUser();
  
       $login=$FunObj->Login($Prp);
       if ($login) {
           $data=array();

           foreach ($login as $data) {
              $u_id=$data['u_id'];
              $status=$data['status'];
              $name=$data['f_name'];
            
           }
           if ($u_id==21) {
          
           if ($status==1) {
             $_SESSION['u_id']=$u_id;

             header("Location:dash.php");
           }else{
              $msg="Please verify your email first!!";
           }
         }else{
            $msg="Sorry!! No Other Users have allowed to login.";
         }
       }else{
            $msg="Invalid Email/Password!!";
       }

    } 
  
?>
<!DOCTYPE html>
	<html>
	<head>
	<title>
			Admin Login
		</title>
   
   <?php include'links/links.php'; ?>
	
		<link rel="stylesheet" type="text/css" href="css/index.css">


	</head>
	<body>
		<div class="container-fluid">
			<div class="row ">
			   
			   <div class="col-md-6 img">
				  <img src="../img/coffee.jpg" class="img-fluid" alt="image">
			   </div>	
				
				<div class="col-md-6 content">
					<h3 class="signin-text"> Sign In</h3>
          <div class="msg" style="color: red;">
					 <?php 
                if ($msg) {
                  echo $msg;
                  echo $msg="";
                }
           ?>
         </div>
					<form method="post">
						<div class="form-group">
							<label for="email"> Email</label>
							<input type="email" name="email" class="form-control" required/>
						     <br>
							<label for="password"> Password </label>
						    <input type="password" name="pswd" id="password" class="form-control">
	 
						   <div class="eye">
                           <i class="fas fa-eye" id="slash" onclick="toggle_eye()"></i>
                          </div>
					     <br>
						
						<button class="btn btn-class" name="signup"> Login</button>
						<a href="forget-pswd.php" class="forget_pass">Forgot Password?</a>
                         </div>
					</form>
				</div>	
			</div>
		</div>

<script>
	  var state=false;
        function toggle_eye()
        {
          if(state){
            document.getElementById("password").setAttribute("type","password");
            document.getElementById("slash").setAttribute("class","fas fa-eye");
            state=false;
          }
          else{
             document.getElementById("password").setAttribute("type","text");
             document.getElementById("slash").setAttribute("class","fas fa-eye-slash");
             state=true;
          }
        } 
      </script>

	</body>
	</html>