(function($) {

    // Import Slider
    $.getScript('https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/slider.min.js');
    $.getScript('https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/slideset.min.js');
    $.getScript('https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/slideshow.min.js');


    // Import Global Sticky
    $.getScript('https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/sticky.min.js');

    // Menu Navigation
    $('.uk-main-navbar').find('.menu-item-has-children').attr('data-uk-dropdown', '{mode: \'click\'}');
    $('.uk-main-navbar').find('.menu-item-has-children > a').append('<i class="uk-icon-caret-down"></i>');
    $('.uk-main-navbar').find('.menu-item-1825 a').addClass('uk-button uk-button-danger');
    $('.uk-main-navbar').find('.uk-nav-header').html('Recently Closed');

    // Toggle Header Banner
    $('.EIG1031 .uk-close, .property-alert-banner .uk-close').on('click', function() {
        $(this).parent().animate({
            height: 'toggle'
        }, 'fast');
    });

    // Set Cookie for Modals & Banners
    $.getScript('https://cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.min.js', function() {

        // Referral
        $.getScript('https://cdn.jsdelivr.net/npm/blueimp-md5@2.18.0/js/md5.min.js', function() {
            // Get Value of Parameter
            $.urlParam = function(name){
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                if ( results == null ) {
                    return null;
                } else {
                    return results[1] || 0;
                }
            }

            // Setup global cookie to PHP
            if ( $.urlParam('ref') === md5('cr') ) {
                Cookies.set('__client-relation', 'active', { sameSite: 'strict', secure: true, expires: 7  });
            }
        });
        // End Referral
        
        // Modal Banner (1031 Exchange Guide Download)
        $('.modal-ad').find('.uk-close, .__download').on('click', function() {
            Cookies.set('__modalADS', 'true', { expires: 7 });
        });

        if ( Cookies.get('__modalADS') == 'true' ) {
            $('.modal-ad').addClass('uk-hidden').removeAttr('data-uk-scrollspy');
        }

        // Modal Banner (Investment Modal)
        $('#global-investment-modal').find('.uk-modal-close').on('click', function() {
            Cookies.set('__modalINVT', 'true', { expires: 7 });
        });

        $(window).on('load', function() {
            var modalINVT = UIkit.modal('#global-investment-modal', { center: true, bgclose: false });
            if ( Cookies.get('__modalINVT') == 'true' ) {
                modalINVT.hide();
            } else {
                setTimeout(function() {
                    modalINVT.show();
                }, 5000); // Init display to 5 secs
            }
        });

    });

    // Globalize Smooth Scroll
    $.getScript('https://cdn.jsdelivr.net/npm/jquery-smooth-scroll@2.1.2/jquery.smooth-scroll.min.js', function() {
        // var origins = window.location.origin;
        // $('a[href="'+ origins +'/#-CompanyVideo"]').attr('href', function() {
        //     var hrefParts = this.href.split(/#/);
        //     hrefParts[1] = 'NASIS' + hrefParts[1];
        //     return hrefParts.join('#');
        // });

        var reSmooth = /^#NASIS/;
        var id;
        if ( reSmooth.test(location.hash) ) {
            id = '#' + location.hash.replace(reSmooth, '');
            $.smoothScroll({
                scrollTarget: id,
                offset: -62,
                speed: 1000
            });
        }
    });    


}) (jQuery);