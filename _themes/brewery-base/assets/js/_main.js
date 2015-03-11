/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 * ======================================================================== */


var Roots = {
    // All pages
    common: {
        init: function() {
            $ = jQuery;
            function userIsBot() { return navigator.userAgent.match(/bot|googlebot|crawler|spider|robot|crawling/i); }
            function checkAgeCookie() {
                if($.cookie('age-verified') || userIsBot()) {
                    $("#age-verification-overlay-wrap").hide();
                } else {
                    $("#age-verification-overlay-wrap").show();
                }
            }
            checkAgeCookie();


            $("#age-verification-form").submit(function() {
                var birthday = new Date($("#age-verification-year").val(), $("#age-verification-month").val(), $("#age-verification-day").val());
                var ageInMs = new Date() - birthday;

                if(ageInMs > (21 * 365.25 * 24 * 60 * 60 * 1000) /* 21 years, in ms */) {
                    $.cookie('age-verified', true);
                    checkAgeCookie();
                } else {
                    $("#age-verification-error").show();
                }

                return false;
            });
        }
    },
    // Home page
    home: {
        init: function() {
            // JavaScript to be fired on the home page
        }
    },
    // About page
    about: {
        init: function() {
            // JavaScript to be fired on the about page
        }
    }
};

var UTIL = {
    fire: function(func, funcname, args) {
        var namespace = Roots;
        funcname = (funcname === undefined) ? 'init' : funcname;
        if(func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
            namespace[func][funcname](args);
        }
    },
    loadEvents: function() {
        UTIL.fire('common');

        jQuery.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
            UTIL.fire(classnm);
        });
    }
};

jQuery(document).ready(UTIL.loadEvents);
