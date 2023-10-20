(function($) {
    
    var cryptohousescripts = {

        menu: function() {
            // Mobile Menu
            $(".h-menu li ul").parent('li').append('<i class="icofont-simple-up"></i>').addClass('has-child');
            $(".h-menu li .megamenu").parent('li').addClass('has-megamenu');
            $(".h-menu li .megamenu").parent('li').children('a').append('<i class="icofont-simple-up"></i>');
            $(".h-menu li .megamenu").parent('li').append('<i class="icofont-simple-up"></i>');

            $('.h-menu').clone().prependTo('.mobile-menu');

            $('.menu-trigger, .menu-close').on('click', function (e) {
                e.stopPropagation()
                $('.menu-trigger').toggleClass('active')
                $('.mobile-menu-wrap').toggleClass('active-menu')
                $('body, .header-area').toggleClass('active-mobile-menu')
            })
            $('.mobile-menu-wrap').on('click', function (e) {
                e.stopPropagation()
            })
            $(".mobile-menu .h-menu li i").click(function(e){
                $(this).parent('li').toggleClass("active").children('ul').slideToggle();
                $(this).parent('li').children('.megamenu').slideToggle();
            });

            function mobileMenu() {
                $('.menu-trigger').removeClass('active')
                $('.mobile-menu-wrap').removeClass('active-menu')
                $('body, .header-area').removeClass('active-mobile-menu')
            }

            $(document).on('click', function () {
                mobileMenu()
            })
        },
        gotop: function(){
            // go-to-top
            $("body").prepend('<div id="top"><i class="icofont-simple-up"></i></div>');
            $(window).scroll(function(){
                if( $(window).scrollTop() > 300 ){
                    $("#top").fadeIn();
                }else{
                    $("#top").fadeOut();
                }
            });
            $("#top").click(function(){
                $("body, html").animate({scrollTop: 0});
            });
        },
        accordion: function() {
            // accordion
            $(".accordion-content").hide();
            $(".accordion-item").first().addClass("active").children(".accordion-content").show();
            $(".accordion-title").click(function(){
                $(this).parent().siblings().removeClass("active").children(".accordion-content").slideUp();
                $(this).parent().toggleClass("active").children(".accordion-content").slideToggle();
            });
        },
        countdown: function(){
            // jQuery CountDown
            if( $(".countdown-clock").length ){
                $('.countdown-clock').countdown('2021/10/10', function(event) {
                    $('.clock-days').html(event.strftime('%D'));
                    $('.clock-hours').html(event.strftime('%H'));
                    $('.clock-minutes').html(event.strftime('%M'));
                    $('.clock-seconds').html(event.strftime('%S'));
                });
            }
        },
        videopopup: function(){
            // video popup lightbox
            if($('.vid-play').length){
                $('.vid-play').magnificPopup({
                    disableOn: 700,
                    type: 'iframe',
                    mainClass: 'mfp-fade',
                    removalDelay: 160,
                    preloader: false,
            
                    fixedContentPos: false
                });     
            }
        },
        counterup: function(){
            // counter-up
            if( $(".counter-wrap").length ){
                var a = 0;
                $(window).scroll(function() {
                    var oTop = $('.counter-wrap').offset().top - window.innerHeight;
                    if (a == 0 && $(window).scrollTop() > oTop) {
                        $('.counter-value').each(function() {
                            var $this = $(this),
                            countTo = $this.attr('data-count');
                            $({
                                countNum: $this.text()
                            }).animate({
                                countNum: countTo
                            },

                            {
                                duration: 2000,
                                easing: 'swing',
                                step: function() {
                                    $this.text(Math.floor(this.countNum));
                                },
                                complete: function() {
                                    $this.text(this.countNum);
                                }
                            });
                        });
                        a = 1;
                    }
                });
            }
        },
        carousel: function() {
            // Owl-carousel
            var hero = $(".hero-slider");
            if(hero.length){
                hero.owlCarousel({
                    items: 1,
                    smartSpeed: 600,
                    animateOut: 'fadeOut',
                    nav: true,
                    onInitialized  : counter,
                    onTranslated : counter,
                    navText: ['<i class="icofont-simple-left"></i>','<i class="icofont-simple-right"></i>']
                });
        
                function counter(event) {
                    var element   = event.target; 
                    var items     = event.item.count;     // Number of items
                    var item      = event.item.index + 1; // Position of the current item
                    $(".hero-slider-sec .owl-dot").css('width',100/items+'%');        
                }   
            }

            $(".comment-carousel").owlCarousel({
                items: 1,
                smartSpeed: 600
            });
        },
        polygone_particles: function(){
            // polygone particles
            if( $("#particles").length ){
                var nodesjs = new NodesJs({
                    id: 'particles',
                    width: window.innerWidth,
                    height: window.innerHeight,
                    particleSize: 4,
                    lineSize: 1,
                    particleColor: [255, 255, 255, 0.3],
                    lineColor: [255, 255, 255],
                    backgroundFrom: [0, 3, 73],
                    backgroundTo: [0, 91, 142],
                    backgroundDuration: 4000,
                    nobg: true,
                    number: window.hasOwnProperty('orientation') ? 30: 100,
                    speed: 20
                });        
            }
        },
        animation: function(){
            AOS.init({
                duration: 700
            });
        },
        imgToSvg: function(){
            // Replace all SVG images with inline SVG
            jQuery('img').each(function(){
                var $img = jQuery(this);
                var imgID = $img.attr('id');
                var imgClass = $img.attr('class');
                var imgURL = $img.attr('src');
            
                jQuery.get(imgURL, function(data) {
                    // Get the SVG tag, ignore the rest
                    var $svg = jQuery(data).find('svg');
            
                    // Add replaced image's ID to the new SVG
                    if(typeof imgID !== 'undefined') {
                        $svg = $svg.attr('id', imgID);
                    }
                    // Add replaced image's classes to the new SVG
                    if(typeof imgClass !== 'undefined') {
                        $svg = $svg.attr('class', imgClass+' replaced-svg');
                    }
            
                    // Remove any invalid XML tags as per http://validator.w3.org
                    $svg = $svg.removeAttr('xmlns:a');
            
                    // Replace image with new SVG
                    $img.replaceWith($svg);
            
                }, 'xml');
            
            });
        },

        init: function(){
            cryptohousescripts.menu();
            cryptohousescripts.gotop();
            cryptohousescripts.accordion();
            cryptohousescripts.countdown();
            cryptohousescripts.videopopup();
            cryptohousescripts.counterup();
            cryptohousescripts.carousel();
            cryptohousescripts.polygone_particles();
            cryptohousescripts.animation();
            cryptohousescripts.imgToSvg();
        }



    }
    
    $(document).ready(function() {
        cryptohousescripts.init();
    });


})(jQuery);



// Site Preloader
$(window).load(function() {
    $(".ch-preloader-sec").delay(200).fadeOut('slow');
})
 


