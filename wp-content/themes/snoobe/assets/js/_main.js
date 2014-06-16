/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

var map;
var win = $(window);
var windowWidth = win.width();
var windowHeight = win.height();
var parallax;

(function($) {

  /* **************** */
  /* Home page slider */
  /* **************** */

  var mySwiper = new Swiper('.swiper-container',{
    pagination: '.pagination',
    speed : 1000,
    autoplay: 3000,
    loop: false,
    paginationClickable: true
  });

  $('.arrow-left').on('click', function(e){
    e.preventDefault();
    mySwiper.swipePrev();
  });
  $('.arrow-right').on('click', function(e){
    e.preventDefault();
    mySwiper.swipeNext();
  });

  $('.popup').hover(function(){
      $(this).toggleClass("move");
  });

  /*--- Custom select boxes ---*/
  $('.stylized').customSelect();

  /*--- Adding class-active on pager ---*/
  var sections = $('.slide'),
  nav = $('.homepage-fixed-footer>ul');

  $(window).on('scroll', function () {
    var cur_pos = $(this).scrollLeft();

    sections.each(function() {
      var left = $(this).offset().left,
          right = left + $(this).windowWidth;
   
      if (cur_pos >= left) {
        nav.find('a').removeClass('active');
        sections.removeClass('active');
   
        $(this).addClass('active');
        nav.find('a[href="#'+$(this).attr('id')+'"]').addClass('active');
      }
    });
  });
  /* -end- */

  /*--- Add class to home html ---*/
  if($('body').hasClass('home')) {
    $('html').addClass('home-html');
  }
  /* -end- */

  /*--- Call for parallax function (defined in parallax.js) ---*/
  if ('.home') {
    parallax = new Parallax();
  }
  /* -end- */
  


// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

/***** GOOGLE MAP ****/
if ($("#contact-map").length > 0) {
  initialize = function() {
    var myLatlng = new google.maps.LatLng(45.509385,-73.675071);
    var mapOptions = {
      zoom: 16,
      scrollwheel: false,
      navigationControl: false,
      mapTypeControl: false,
      scaleControl: false,
      draggable: false,
      disableDefaultUI: true,
      center: myLatlng
    };
    map = new google.maps.Map(document.getElementById("contact-map"), mapOptions);

    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'Hello World!'
    });
  };
  google.maps.event.addDomListener(window, "load", initialize);
}

$(document).ready(UTIL.loadEvents);

// FAQ Dropdown
$('.panel-heading').click(function(){
  if($('.collapse').hasClass('in')) {
    $('.panel-heading').addClass('minus');
  } else {
    $('.panel-heading').removeClass('minus');
  }
});


})(jQuery); // Fully reference jQuery after this point.
