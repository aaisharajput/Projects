<?php session_start();

if (!isset($_SESSION['u_id'])) {
          header("location:../index.php?lang=$set_lang");
        }
 include'../select_lang.php'; 

 include '../php/code.php';

  $u_id=$_SESSION['u_id'];
  $plan_id=$_SESSION['plan_id'];
  $_SESSION['trip_id']=$plan_id;

       $FunObj=new clsUser();
       $result=$FunObj->GetUserDetail($u_id);
         if ($result) {
               $data=array();

                foreach ($result as $data) {
                   $f_name=$data['f_name'];
                   $l_name=$data['l_name'];
                   $email=$data['email'];
                   $pic=$data['profile_pic'];
                   } 
               }

  $Obj=new clsWeekendPlans();
  $sol=$Obj->UserWeekendPlans($plan_id);
  $arr=array();
  foreach ($sol as $arr) {
      $trip_name=$arr['trip_name'];
      $destination=$arr['destination'];
      $fee=$arr['fee_charges'];
  }

  $P_Obj=new clsPlanPurchase();
  $p_result=$P_Obj->AlreadyBooked($u_id,$plan_id);
  $p_arr=array();
  foreach ($p_result as $p_arr) {
      $book_mem=$p_arr['member_booking'];
  }

  $price=$book_mem*$fee;

?>




<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <?php include '../links/links.php'; ?>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type="text/javascript">
        function preback(){ window.history.forward();}
        setTimeout("preback()",0);
        window.onunload = function() {null};
    </script>
    <style>
    body {
        font-family: 'Nunito', sans-serif;
    }
    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="{{ asset('assets/img/gat.ico') }}" type="image/x-icon">
    <!-- bootstrap css -->
    <link href="{{ asset('vendor/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- Custom css -->
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- Font css -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="wrapper">
    <div id="loader" class="lds-hourglass "></div>
        <div class="mt-1 row justify-content-around">
            <div class="mt-5" style="width:500px;height: 700px;border: 2px solid black;padding: 20px 15px;">
                <h4><b>Payment Details</b></h4>
                <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <td><?php echo $f_name; ?></td>
                      </tr>
                       <tr>
                        <th>Email</th>
                        <td><?php echo $email ?></td>
                      </tr>
                      <tr>
                        <th>Trip Name</th>
                        <td><?php echo $trip_name; ?></td>
                      </tr>
                      <tr>
                        <th>Destination</th>
                        <td><?php echo $destination; ?></td>
                      </tr>
                      <tr>
                        <th>Fee/per</th>
                        <td><?php echo $fee; ?></td>
                      </tr>
                      <tr>
                        <th>Member</th>
                        <td><?php echo $book_mem; ?></td>
                      </tr>
                      <tr>
                        <th>Total Amount</th>
                        <td><?php echo $price; ?></td>
                      </tr>
                    </thead>
                  </table>
               <center><button id="rzp-button1" class="btn  btn-outline-primary borderradius">Pay Now</button></center>
            </div>
        </div>
     
    </div>
    <script>
   
    var options = {
        "key": "rzp_test_KKft3rAtwVj4hA",
        "amount": "10000", // 2000 paise = INR 20
        "name": "fjhdj",
        "description": "Total Amount",
        "image": "photo/<?php echo $pic; ?>",
        "handler": function(response) {

            var action="payment";

                $.ajax({
                    type: 'POST',
                    url: '../php/session.php',
                    data: {payment:action},
                      success: function(data){
                       window.location.href="trip-booked.php?lang=<?php echo $set_lang; ?>";                
                  }
                });

        },
        "prefill": {
            "name": "Sapna Devi",
            "email": "sapnadevi.1610a@gmail.com"
        },
        "notes": {
            "address": "Hello World"
        },
        "theme": {
            "color": "#149f92"
        }
    };

    document.getElementById('rzp-button1').onclick = function(e) {

        options.amount = "<?php echo $price*100; ?>";
        options.name = "<?php echo $f_name; ?>";
        options.prefill.name = "<?php echo $f_name; ?>";
        options.prefill.email = "<?php echo $email; ?>";

        var rzp1 = new Razorpay(options);
        rzp1.open();
        e.preventDefault();
    }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIfC-Owt2dktbqePJ1_cAQipFPtCZzr1M&amp;libraries=places&amp;callback=initAutocomplete"
        async="" defer=""></script>
    
    <script src="vendor/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>



    <script type="text/javascript">
    $("#owl-slider").owlCarousel({
        items: 1,
        autoplay: true,
        autoPlaySpeed: 150,
        autoPlayTimeout: 50,
        stopOnHover: true,
        navigation: false,
        dots: false
    })
    $(document).ready(function() {
        $("#owl-slider").owlCarousel();
    });
    </script>
</body>

</html>