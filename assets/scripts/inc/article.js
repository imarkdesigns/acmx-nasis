(function($) {

    // Import Infinit Ajax Scroll
    $.getScript( window.location.origin + '/wp-content/themes/nasis/assets/scripts/plugins/jquery-ias.min.js' , function() {
        var ias = jQuery.ias({
            container:  '#grid-wrapper',
            item:       '.grid-post',
            pagination: '.pagination',
            next:       '.next-more-link a',
            delay:      2500,
        });

        ias.extension(new IASSpinnerExtension({
            html: '<div class="uk-width-1-1 uk-flex uk-flex-center uk-flex-middle uk-text-muted"><div class="uk-margin-small-right" uk-spinner></div> Loading, please wait... </div>', 
        });

        ias.extension(new IASTriggerExtension({ offset: 100, htmlPrev: '<div class="uk-width-1-1 uk-flex uk-flex-center uk-flex-middle uk-text-small"> <a class="uk-text-muted"><span class="uk-margin-small-right" uk-icon="icon: history"></span> Load Previous Contents</a> </div>' }));
        ias.extension(new IASPagingExtension());
        ias.extension(new IASHistoryExtension({ prev: '.prev-more-link a', }));
    }); 

}) (jQuery);

