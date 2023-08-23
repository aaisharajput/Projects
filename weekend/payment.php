<?php session_start();


 include 'class.php';
  $s_no=1;

 $patient_id=2;
 $faculty_id=3;
 $price=100;

      /*   $funob=new clsfaculty_login();

         $result2=$funob->Singlefacultydetail($faculty_id);

         $data=array();

         foreach($result2 as $data)   
         {
         $fname=$data['designation']." ".$data['f_name']." ".$data['l_name'];
         }
        $funObj=new clspatient_login();
        $result1=$funObj->GetUserDetails($s_no);
        $data=array();

        foreach($result1 as $data)
        {
         $pname=  $data['f_name']." ".$data['l_name'];

        }*/
 ?>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <?php include 'links/links.php' ?>
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
        <div class="mt-3 row justify-content-around">
            <div class="mt-5" style="width:450px;height: 550px;border: 2px solid black;padding: 15px 15px;">
                <h5><b>Payment Details</b></h5>
                <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th>Payment for</th>
                        <td>Home Appointment</td>
                      </tr>
                      
                       <tr>
                        <th>Payment From</th>
                        <td>sapna</td>
                      </tr>
                       <tr>
                        <th>Payment To</th>
                        <td>Devi</td>
                      </tr>
                       <tr>
                        <th>Price</th>
                        <td>1000</td>
                      </tr>
                    </thead>
                 </table>
               <center><button id="rzp-button1" class="btn  btn-outline-primary borderradius">Pay Now</button></center>
            </div>
        </div>
     
    </div>
    <script>
    var options = {
        "key": "rzp_test_RW4r8LUcdo1IRe",
        "amount": "10000", // 2000 paise = INR 20
        "name": "fjhdj",
        "description": "Purchase Description",
        "image": "img/trt.png",
        "handler": function(response) {

         /*   var action="payment";
                $.ajax({
                    type: 'POST',
                    url: 'code.php',
                    data: {payment:action},
                      success: function(data){
                       window.location.href="user_profile.php";                
                  }
                });*/
          },
        "prefill": {
            "name": "E-Sanjeevani",
            "email": "khidmathub@gmail.com"
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
        options.name = "sapna";
        options.prefill.name = "devi";
        options.prefill.email = "fafaffa@ggggg";

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