var $, $uri, $plugin, $vendor, $modal, theme;

//* Create Root Path
$uri    = window.location.origin;
$plugin = $uri + '/wp-content/themes/acmx-nasis/assets/scripts/inc/';
$vendor = $uri + '/wp-content/themes/acmx-nasis/vendor/';

//* Convert jQuery $
$ = jQuery;

//* Set Routes
theme = {

    'common': {
        init:function() { $.getScript($plugin + 'common.js') }
    },

    'home': {
        init:function() { $.getScript($plugin + 'home.js') }
    },
    
    // Commercial Real Estate Investments
    'page_id_2390': {
        init:function() { $.getScript($plugin + 'about.js') }
    },

    // Our NAS Work Has Put Us On The Map
    'page_id_10': {
        init:function() { $.getScript($plugin + 'map.js') }
    },

    // 1031 Exchange Information
    'page_id_1279': {
        init:function() { $.getScript($plugin + 'exchange.js') }
    },

    // Real Estate Investment Articles
    'page_id_1286': {
        init:function() { $.getScript($plugin + 'article.js') }
    },

    // Glossary
    'page_id_1290': {
        init:function() { $.getScript($plugin + 'glossary.js') }
    },

    // Webinar
    'page_id_2289': {
        init:function() { $.getScript($plugin + 'webinar.js') }
    },

    // Team
    'single_nasis_team': {
        init:function() { $.getScript($plugin + 'team.js') }
    },

    // NASIS Invesment
    'single_nasis_investments': {
        init:function() { $.getScript($plugin + 'property.js') }
    },

}

var UTIL = {
    fire: function (func, funcname, args) {
        var fire;
        var namespace = theme;
        funcname = (funcname === undefined) ? 'init' : funcname;
        fire = func !== '';
        fire = fire && namespace[func];
        fire = fire && typeof namespace[func][funcname] === 'function';

        if (fire) {
            namespace[func][funcname](args);
        }
    },
    loadEvents: function () {
        //* Fire common init JS
        UTIL.fire('common');

        //* Fire page-specific init JS, and then finalize JS
        $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
            UTIL.fire(classnm);
            UTIL.fire(classnm, 'finalize');
        });

        //* Fire common finalize JS
        UTIL.fire('common', 'finalize');
    }
};

// Load Events
$(document).ready(UTIL.loadEvents);

//*
// Add event listener offline to detect network loss.
window.addEventListener("offline", function(e) {
    showPopForOfflineConnection();
});

// Add event listener online to detect network recovery.
window.addEventListener("online", function(e) {
    hidePopAfterOnlineInternetConnection();
});

function hidePopAfterOnlineInternetConnection(){
    // Set your alert here...
}

function showPopForOfflineConnection(){
    alert("Ooppss! There's something wrong about your internet. Please check!");
}