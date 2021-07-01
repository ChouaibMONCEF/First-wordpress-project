/**** Dogcare Custom Js ****/
/* Main-Menu Js */
/* Deafult js */
(function ($) {
    $.fn.menumaker = function (options) {
        var cssmenu = $(this),
            settings = $.extend({
                format: "dropdown",
                sticky: false
            }, options);
        return this.each(function () {
            $(this).find(".button").on('click', function () {
                $(this).toggleClass('menu-opened');
                var mainmenu = $(this).next('ul');
                if (mainmenu.hasClass('open')) {
                    mainmenu.slideToggle().removeClass('open');
                } else {
                    mainmenu.slideToggle().addClass('open');
                    if (settings.format === "dropdown") {
                        mainmenu.find('ul').show();
                    }
                }
            });
            
            keepFocusInModal = function () {
                var _doc = document;
                var select = document.querySelector('#cssmenu');
                var focusableEls = select.querySelectorAll('a,button,input');
                var firstFocusableEl = focusableEls[0];  
                var lastFocusableEl = focusableEls[focusableEls.length - 1];
                var KEYCODE_TAB = 9;
                _doc.addEventListener('keydown', function(e) {
                    if (e.key === 'Tab' || e.keyCode === KEYCODE_TAB) {
                        if ( e.shiftKey ) /* shift + tab */ {
                            if (document.activeElement === firstFocusableEl) {
                                lastFocusableEl.focus();
                                e.preventDefault();
                            }
                        } else /* tab */ {
                            if (document.activeElement === lastFocusableEl) {
                                firstFocusableEl.focus();
                                e.preventDefault();
                            }
                        }
                    }
                });
            };
            mouseEnterModal= function(){
                jQuery('#cssmenu li').mouseenter(function () {
                    jQuery(this).find('.sub-menu').show();
                });
            };
            cssmenu.find('li ul').parent().addClass('has-sub');
            multiTg = function () {
                cssmenu.find(".has-sub").prepend('<button class="submenu-button"></button>');
                cssmenu.find('.submenu-button').on('click', function () {
                    $(this).toggleClass('submenu-opened');
                    if ($(this).siblings('ul').hasClass('open')) {
                        $(this).siblings('ul').removeClass('open');
                    } else {
                        $(this).siblings('ul').addClass('open');
                    }
                });
            };
            if (settings.format === 'multitoggle') multiTg();
            else cssmenu.addClass('dropdown');
            if (settings.sticky === true) cssmenu.css('position', 'fixed');
            resizeFix = function () {
                var mediasize = 1024;
                if ($(window).width() > mediasize) {
                    cssmenu.find('ul.sub-menu').hide();
                    $('#main-menu-nav').show();
                    mouseEnterModal();
                }
                if ($(window).width() <= mediasize) {
                    cssmenu.find('ul').hide().removeClass('open');
                    keepFocusInModal();
                }
            };
            resizeFix();
            return $(window).on('resize', resizeFix);
        });
    };
})(jQuery);
/** Set Position of Sub-Menu **/
var wapoMainWindowWidth = jQuery(window).width();


jQuery('#cssmenu ul ul li').mouseenter(function () {
    var subMenuExist = jQuery(this).find('.sub-menu').length;
    if (subMenuExist > 0) {
        var subMenuWidth = jQuery(this).find('.sub-menu').width();
        var subMenuOffset = jQuery(this).find('.sub-menu').parent().offset().left + subMenuWidth;
        if ((subMenuWidth + subMenuOffset) > wapoMainWindowWidth) {
            jQuery(this).find('.sub-menu').removeClass('submenu-left');
            jQuery(this).find('.sub-menu').addClass('submenu-right');
        } else {
            jQuery(this).find('.sub-menu').removeClass('submenu-right');
            jQuery(this).find('.sub-menu').addClass('submenu-left');
        }
    }
});

(function ($) {
    $(document).ready(function() { $("#cssmenu").menumaker({ format: "multitoggle"  });  
        if(jQuery('.page-numbers').length > 0){
        jQuery('.page-numbers').addClass('pagination');
        jQuery('nav.navigation').removeClass('pagination');
         
    }
    jQuery('#main-slider').owlCarousel({
            items:1,
            loop:true,
            autoplay:true,
            autoplayTimeout:4000,
            autoplayHoverPause:true,
            margin:0,
            nav:false,
            dots:true
     });
});  
    $(window).load(function() {
      if(jQuery('#ms-container').length > 0){
          var container = document.querySelector('#ms-container');
          var msnry = new Masonry( container, {
            itemSelector: '.ms-item',
            columnWidth: '.ms-item',                
          });        
      }
     });   
})(jQuery);

jQuery(window).load(function(){   jQuery('.preloader').delay(400).fadeOut(500);   });
/* Main-Menu Js End */

/*Testimonials*/


/*Testimonials*/
jQuery('#testimonials-carousel').owlCarousel({
    items:1,
    loop:true,
    margin:10,
    autoplay:true,
    autoplayTimeout:4000,
    autoplayHoverPause:true,
    margin:10,
    nav:false
})