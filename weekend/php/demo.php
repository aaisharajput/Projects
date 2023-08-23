<?php

        $dbHost="localhost";  
        $dbName="id16927525_explore";  
        $dbUser="id16927525_explore_root";      
        $dbPassword="1/AaISha2($]";     

       $con=mysqli_connect($dbHost,$dbUser,$dbPassword,$dbName);
       if($con){
           echo "successful";
       }else{
           echo "failed";
       }
?>