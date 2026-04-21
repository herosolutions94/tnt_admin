$(document).ready(function() {
    
    /*========== Toggle ==========*/
    $(document).on('click', '.toggle', function() {
        $(".toggle").toggleClass("active");
		$("html").toggleClass("flow");
		$("[nav]").toggleClass("active");
    });
    
    /*========== File Upload ==========*/
    var imgFile;
    $(document).on('click', '#uploadDp', function() {
        imgFile = $(this).attr('data-file');
        $(this).parents('form').children('.uploadFile').trigger('click');
    });
    $(document).on('change', '.uploadFile', function() {
        // alert(imgFile);
        var file = $(this).val();
        $('.uploadImg').html(file);
    });

    
    /*========== Dropdown ==========*/
    $(document).on('click', '.drop_btn', function(e) {
        e.stopPropagation();
        var $this = $(this).parent().children('.drop_cnt');
        $('.drop_cnt').not($this).removeClass('active');
        var $parent = $(this).parent('.drop');
        $parent.children('.drop_cnt').toggleClass('active');
    });
    $(document).on('click', '.drop_cnt', function(e) {
        e.stopPropagation();
    });
    $(document).on('click', function() {
        $('.drop_cnt').removeClass('active');
    });
    /*----- video button -----*/

/*_____ FAQ's _____*/
$(document).on("click", ".faqBlk > h5", function() {
    $(".faqBlk")
        .not(
            $(this)
                .parent()
                .toggleClass("active")
        )
        .removeClass("active");
    $(".faqBlk > .txt")
        .not(
            $(this)
                .parent()
                .children(".txt")
                .slideToggle()
        )
        .slideUp();
});
var vid = $('video');
    // var vid = document.getElementById("bannerVid");
    // $(document).on('click', '.fa-play', function() {
      
    //     $(this).parents().children(vid).trigger('play');

    //     $(this).removeClass('fa-play').addClass('fa-pause');
    // });
    // $(document).on('click', '.fa-pause', function() {
    //     $(this).parents().children(vid).trigger('pause');

    //     $(this).removeClass('fa-pause').addClass('fa-play');
    // });


    /*========== Popup ==========*/
    $(document).on('click', '.popBtn', function() {
        var popUp = $(this).data('popup');
        $('body').addClass('flow');
        $('.popup[data-popup= ' + popUp + ']').fadeIn();
    });
    $(document).on('click', '.cros_btn', function() {
        var popUp = $(this).parents('.popup').data('popup');
        $('body').removeClass('flow');
        $('.popup[data-popup= ' + popUp + ']').fadeOut();
    });

$('.datepicker').datepicker({
            dateFormat: 'MM dd, yy',
            changeMonth: true,
            changeYear: true,
            yearRange: '1900:2060'
        });

        // Timepicker Js
        $('.timepicker').timepicki({
            reset: true
        });

        // Select Js
        $(document).ready(function () {
            $('.selectpicker').selectpicker();
        });
        
        // Data Table Js
        var sortOrder = ($('th.sortBy').index()>-1)?$('th.sortBy').index():0;
        $('.dataTable').DataTable({
            'order': [[
                sortOrder, 'asc'
            ]],
            'pageLength': 25,
            columnDefs: [{
                orderable: false,
                targets: 'no-sort'
            }],
            responsive: true
        });

        $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
        });

        $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true
        });

        $('.grid_view').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: false,
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    centerMode: false,
                }
                }
            ]
            });
            $('.color-slider').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: true,
            centerMode: true,
            centerPadding: '0',
            responsive: [
                {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
                }
            ]
            });
        
        
        $('#banner_carousel').owlCarousel({
            autoplay: true,
            nav: false,
            navText: ['<i class="fi-chevron-left"></i>','<i class="fi-chevron-right"></i>'],
            loop: true,
            dots:false,
            smartSpeed: 1000,
            animateOut: 'fadeOut',
            autoplayTimeout: 10000,
            autoplayHoverPause: true,
            autoWidth: false,
            margin: 20,
            items: 1
        });
        $('#owl-testi').owlCarousel({
            autoplay: true,
            nav: false,
            navText: ['<i class="fi-chevron-left"></i>', '<i class="fi-chevron-right"></i>'],
            dots: true,
            loop:true,
            margin:15,
            center:true,
            autoWidth: false,
            autoHeight: false,
            smartSpeed: 1000,
            animateOut: 'fadeOut',
            autoplayTimeout: 10000,
            autoplayHoverPause: true,
            responsive: {
                0:{
                    items: 1,
                    autoplay: false,
                    autoHeight: true,
                    dots: true,
                    nav:false
                },
                600:{
                    items:2
                },
                1000:{
                    items: 3
                }
            }
        });

        $('#customrers_slider').owlCarousel({
            autoplay: true,
            nav: false,
            navText: ['<i class="fi-chevron-left"></i>', '<i class="fi-chevron-right"></i>'],
            dots: true,
            loop:true,
            margin:15,
            center:true,
            autoWidth: false,
            autoHeight: false,
            smartSpeed: 1000,
            animateOut: 'fadeOut',
            autoplayTimeout: 10000,
            autoplayHoverPause: true,
            responsive: {
                0:{
                    items: 1,
                    autoplay: false,
                    autoHeight: true,
                    dots: true,
                    nav:false
                },
                600:{
                    items:2
                },
                1000:{
                    items: 4
                },
                1000:{
                    items: 5
                }
            }
          });



        var offSet = $('body').offset().top;
        var offSet = offSet + 50;
        $(window).scroll(function() {
            var scrollPos = $(window).scrollTop();
            if (scrollPos >= offSet) {
               $('header').addClass('fix'); 
            } else {
                $('header').removeClass('fix'); 
            }
        });

       
        

});


function textAreaAdjust(o) {
    o.style.height = '1px';
    o.style.height = (25 + o.scrollHeight) + 'px';
}

// smooth scroling effect================
// $("html").easeScroll({
//     stepSize: 40,
//     arrowScroll: 40
// });

/*========== Page Loader ==========*/
$(window).on('load', function() {
    $('.loader').delay(700).fadeOut();
    $('#pageloader').delay(1200).fadeOut('slow');
});

