<?php session_start();
 include'../select_lang.php'; 

if (!isset($_SESSION['u_id'])) {
          header("location:../index.php?lang=$set_lang");
        }
        
    require_once('../php/code.php');
     $u_id=$_SESSION['u_id'];
     $Obj=new clsUser($u_id);
      $status=0;
     $update=$Obj->UpdateStatus($u_id,$status);
unset($_SESSION['u_id']);
header("Location:../index.php?lang=$set_lang");
?>