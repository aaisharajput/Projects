let user,email;
function pay_detail(){
    user_details((data)=>{
        user=data.user;
        email=data.email;
    })
}

function user_details(callback){
    let request = new XMLHttpRequest();
        request.open("POST","/user/user_detail");
        request.send();

        request.addEventListener("load", function(){
          callback(JSON.parse(request.responseText))
        });
 }


    var options = {
        "key": "rzp_test_KKft3rAtwVj4hA",
        "amount": "10000", // 2000 paise = INR 20
        "name": "sapna",
        "description": "Total Amount",
        "image": "../img/default.svg",
        "handler": function(response) {

            // var action="payment";

                // $.ajax({
                //     type: 'POST',
                //     url: '../php/session.php',
                //     data: {payment:action},
                //       success: function(data){
                //        window.location.href="trip-booked.php?lang=<?php echo $set_lang; ?>";                
                //   }
                // });

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
        var price=parseInt(document.getElementById("amount").innerText);
        console.log(price)
        // price*=100;
        options.amount = price;
        options.name = user;
        options.prefill.name = user;
        options.prefill.email = email;

        var rzp1 = new Razorpay(options);
        rzp1.open();
        e.preventDefault();
    }

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

    