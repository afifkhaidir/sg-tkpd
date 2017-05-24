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
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        
        /* ================
         * Pivot Controller
         * ================ */
        var pivotDelay = 200, pivotEnterTimeout, pivotLeaveTimeout;
        var overlay = $('.overlay');
        var pivotContainer = $('.pivot-container');
        
        $('.pivot-button, .pivot-container').hover(function() {
            /* Dont display pivot if mouse enter < delay */
            clearTimeout(pivotLeaveTimeout);
            
            /* Setting delay on mouseenter */
            pivotEnterTimeout = setTimeout(function() {
                pivotContainer.addClass('pivot-container--active');
                overlay.show();
            }, pivotDelay);
        }, function() {
            /* Dont remove pivot if mouse leave < delay */
            clearTimeout(pivotEnterTimeout);
            
            /* Setting delay on mouseleave */
            pivotLeaveTimeout = setTimeout(function() {
                pivotContainer.removeClass('pivot-container--active');
                overlay.hide();
            }, pivotDelay);
        });
        
        /* ================
         * Slider
         * ================ */
        if($('.slider-slide').length > 1) {
          $('.slider-wrapper').slick({
              dots: true,
              arrows: true,
              fade: true,
              autoplay: true,
              autoplaySpeed: 5000,
              prevArrow: '<a class="slick-prev"><img src="https://ecs7.tokopedia.net/assets/images/arrow/banner-arrow-left.png" class="slick-arrow__img" alt="slider left"/></a>',
              nextArrow: '<a class="slick-next"><img src="https://ecs7.tokopedia.net/assets/images/arrow/banner-arrow-right.png" class="slick-arrow__img" alt="slider right"/></a>',
              infinite: true
          });
      	}
        
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
