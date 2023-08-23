

  $(".carousel").owlCarousel({
           margin: 35,
           loop: true,
           autoplay: true,
           autoplayTimeout: 1000,
           autoplayHoverPause: true,
           responsive: {
             0:{
               items:1,
               nav: false
             },
             200:{
               items:2,
               nav: false
             },
             600:{
               items:3,
               nav: false
             },
             1000:{
               items:4,
               nav: false
             }
           }
         });
