<?php session_start();

if (!isset($_SESSION['u_id'])) {
          header("location:../index.php");
        }
        

require_once('php/code.php');
     $u_id=$_SESSION['u_id'];
     $Obj=new clsUser($u_id);
      $status=0;
     $update=$Obj->UpdateStatus($u_id,$status);
     
unset($_SESSION['u_id']);
header("Location:index.php");
?>