(function($) {

    // Import Grid & Lightbox
    $.getScript('https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/grid.min.js');
    $.getScript('https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/lightbox.min.js');

    // Enable Map Legend
    if ( $(window).width() >= 959 ) {
        $('.section-map .legend').addClass('uk-open');
    }

    $(window).on('resize', function() {
        if ( $(window).width() >= 959 ) {
            $('.section-map .legend').addClass('uk-open');
        } else if ( $(window).width() <= 959 ) {
            $('.section-map .legend').removeClass('uk-open');
        }
    }).resize();

    // Smooth Scroll to WPForms
    $('.uk-button-danger, .uk-button-green').on('click', function() {
        $('#brochure-request-form').removeClass('uk-hidden');
        UIkit.Utils.scrollToElement(UIkit.$('#section-request'));
    });

    $('.uk-button-danger').on('click', function() {
      $('#ppm-alert a.uk-alert-close').trigger( 'click' );
    });

    // Show Accredited Disclaimer
    $("#accredited-disclaimer").hide();

    $("#wpforms-2193-field_7").change(function() {
        var val = $(this).val();
        console.log(val);
        if(val === "Accredited Investor Seeking Info") {
            $("#accredited-disclaimer").fadeIn();
        } else {
            $("#accredited-disclaimer").fadeOut();
        }
    });

    $('#ppm-alert').delay( 7500 ).slideDown( 500 ).fadeIn( 500 );

    $(window).on('load', function() {
        $('#LightBoxControl li.--first').trigger('click');
        $('#LightBoxControl li.--first').addClass('uk-active');
    });

    // $('#ppm-alert').animate({
    //     opacity: 1
    // }, {
    //     duration: 1200,
    //     queue: false
    // });

    // $('#ppm-alert').animate({
    //     "bottom": "0"
    // }, {
    //     duration: 3200,
    //     specialEasing: {
    //         "margin-top": "easeOutCirc"
    //     },
    //     queue: false
    // });

    // LightBox
    $(window).on('load', function() {

        if ( $('#LightBoxControl li').first().hasClass('uk-active') ) {
            $('.--lb-list div a').attr( 'data-uk-lightbox', '{group: "All"}' );
        }

        $('#LightBoxControl li').siblings().not(":first").click(function() {
            $('.--lb-list > div').each(function() {
               $(this).find('a').attr( 'data-uk-lightbox', '{group: "'+$(this).data('filter')+'"}' );
            });
        });

        $('#LightBoxControl li').first().click(function() {
            $('.--lb-list div a').attr( 'data-uk-lightbox', '{group: "All"}' );
        });

    });


}) (jQuery);