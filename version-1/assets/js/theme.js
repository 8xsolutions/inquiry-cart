/**** nivo slider function*****/
jQuery(document).ready(function($) {
$('#nivoparrallax').nivoSlider({
  slices: 15,
          boxCols: 8,
          boxRows: 4,
          startSlide: 0,
          controlNavThumbs: false,
          pauseOnHover: true,
          manualAdvance: false,
          effect: 'fade',
          animSpeed: 500,
          pauseTime: 2000,
          controlNav:1,
          directionNav: 1,
  });
 /**** end slider function*****/   

$('.featured-prodcuts,.related-prodcuts').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
                margin:15
         }
         , 768: {
             items: 3,
             margin:15
         }
         , 992: {
             items: 4,
             margin:15
         }
         , 1200: {
             items: 4
         }
     }
     , margin: 29, //padding: 10 
 });
$('.featured-prodcuts2').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
                margin:15
         }
         , 768: {
             items: 2,
             margin: 15
         }
         , 992: {
              items: 3,
         }
         , 1200: {
             items: 3
         }
     }
     , margin: 29, //padding: 10 
 });
$('.our-products').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
             margin:15
         }
         , 768: {
             items: 2,
             margin:15
         }
         , 992: {
             items: 3
         }
         , 1200: {
             items: 3
         }
     }
     , margin: 29, //padding: 10 
 });
$('.our-products-home3').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
             margin:15
         }
         , 768: {
             items: 3
         }
         , 992: {
             items: 4
         }
         , 1200: {
             items: 4
         }
     }
     , margin: 29 //padding: 10 
 });

$('.todaydel-products').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
             margin:15
             
         }
         , 768: {
             items: 1
         }
         , 992: {
             items: 1
         }
         , 1200: {
             items: 1
         }
     }
 });
 
 // start brand logo functin
$('#brand-logo').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 2,
             margin:10
         }
         , 480: {
             items: 3,
              margin:10
         }
         , 768: {
             items: 4,
              margin:10
         }
         , 992: {
             items: 5
         }
         , 1200: {
             items: 5
         }
     }
          , margin: 29, //padding: 10 
 });
 // start brand logo functin
$('.latest-blog-container').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2
         }
         , 768: {
             items: 2
         }
         , 992: {
             items: 2
         }
         , 1200: {
             items: 2
         }
     }
          , margin: 30, //padding: 10 
 });
 
 $('.latest-blog-container3').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: true,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2
         }
         , 768: {
             items: 2
         }
         , 992: {
             items: 3
         }
         , 1200: {
             items: 3
         }
     }
          , margin: 30, //padding: 10 
 });
 
 
 
 

$('#minispecialproduct').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: false,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 1
         }
         , 768: {
             items: 1
         }
         , 992: {
             items: 1
         }
         , 1200: {
             items: 1
         }
     }
 })
 
$('#minibestsaleproduct').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: false,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 1
         }
         , 768: {
             items: 1
         }
         , 992: {
             items: 1
         }
         , 1200: {
             items: 1
         }
     }
 });
 
 $('#minitopratingproduct').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     loop: false,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 1
         }
         , 768: {
             items: 1
         }
         , 992: {
             items: 1
         }
         , 1200: {
             items: 1
         }
     }
 });
 $('#testmonial').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: false,
     dots: true, 
     loop: false,
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 1
         }
         , 768: {
             items: 1
         }
         , 992: {
             items: 1
         }
         , 1200: {
             items: 1
         }
     }
 });
 
 /* pupup loging  */

 if (window.matchMedia('(min-width: 769px)').matches) {
 $('.logregister').click(function() {
$("#poupufrom").fadeToggle( "slow", "linear" );
return false;
});
  $('.closepoupu').click(function() {
$("#poupufrom").fadeToggle( "slow", "linear" );
return false;
});
}
    
// Countdown Start
if ($().countdown) {
 var austDay = new Date();
 austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
 $('#countdays').countdown({until: austDay});
  $('#countbox1').countdown({until: austDay});
   $('#countbox2').countdown({until: austDay});
}
// Countdown End 
/* cooldzoom */
 if (window.matchMedia('(min-width: 992px)').matches) {
     
     /* light box */
$('a.button-search').magnificPopup({
		type: 'iframe'
	});

jQuery("#zoom_image").elevateZoom({
cursor: 'crosshair',
        borderColour:"#e4dddd",
        zoomType: "window",
        lensShape : "round",
        lensSize    : 200,
        lensOpacity:0,
        gallery:'more',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        easing: false,
        loadingIcon: "assets/image/loader.gif"
});
};


/* light box */
$('.colorbox').magnificPopup({
type:'image',
        delegate: 'a',
        gallery: {
        enabled:true
        }
});
/* thamvanil products */
 // start brand logo functin
$('#more').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 3
         }
         , 480: {
             items: 3
         }
         , 768: {
             items: 3
         }
         , 992: {
             items: 3
         }
         , 1200: {
             items: 3
         }
     }
          , margin: 6 //padding: 10 
 });
   
 /* related product leftsidebar */
    $('.related-prodcuts2').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
              margin: 15
         }
         , 768: {
             items: 3
             
         }
         , 992: {
             items: 3,
             margin: 15
         }
         , 1200: {
             items: 3
         }
     }
          , margin: 29 //padding: 10 
 });
 /* related product leftsidebar */
    $('.related-prodcuts3').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2,
              margin: 15
         }
         , 768: {
             items: 2,
               margin: 15
             
         }
         , 992: {
             items: 3,
             margin: 15
         }
         , 1200: {
             items: 3
         }
     }
          , margin: 29 //padding: 10 
 });
  // list view show
$("#listview").click(function(){
    $("#products-grid").fadeOut("slow");
   $("#products-list").fadeIn("slow");
});
$("#gridview").click(function(){
    $("#products-grid").fadeIn("3000");
   $("#products-list").fadeOut("slow");
});

// end list view show  
//about team Carousel
    $('.our-team-inner').owlCarousel({
     autoplay: false, 
     autoplaySpeed: 600,
     nav: true,
     dots: false, 
     autoplayHoverPause: true,
     responsive: {
         0: {
             items: 1
         }
         , 480: {
             items: 2
         }
         , 768: {
             items: 3
         }
         , 992: {
             items: 4
         }
         , 1200: {
             items: 5
         }
     }
          , margin: 29 //padding: 10 
 });  
//end about team Carousel    
/* mobile menu */
$('.toggle-icon').click(function() {
    if ($('.mobile-main-menu').is(":hidden")) {
       $('.mobile-main-menu').fadeIn("fast");
    } else {
        $('.mobile-main-menu').fadeOut("fast");
    }
    return false;
});                
// end brand logo functin
/* search cate */
$('#catsearch').ddslick();
$(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#tot-buttom').fadeIn();
        } else {
            $('#tot-buttom').fadeOut();
        }
    });
    //Click event to scroll to top
    $('#tot-buttom').click(function () {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });   
    
  $('[data-toggle="tooltip"]').tooltip();   
    
    
    
});
// end brand logo functin


