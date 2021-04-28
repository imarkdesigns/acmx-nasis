(function($) {

    // Import Accordion
    $.getScript('https://cdn.jsdelivr.net/npm/uikit@2.27.4/dist/js/components/accordion.min.js');

    // Available Investments Grid
    $(document).ready(function(){
        $('#section-available-investments').find('.uk-grid li:nth-child(3)').toggleClass('uk-width-medium-1-1 uk-width-large-1-2 uk-width-1-1');
    });

}) (jQuery);