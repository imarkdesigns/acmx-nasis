(function($) {

    // Import Sticky & Slideshow
    $.getScript('https://cdn.jsdelivr.net/npm/uikit@2.27.4/dist/js/components/sticky.min.js');
    $.getScript('https://cdn.jsdelivr.net/npm/uikit@2.27.4/dist/js/components/slideshow.min.js');

    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if ( results == null ) {
            return null;
        } else {
            return results[1] || 0;
        }
    }

    setTimeout(function() {
        if( $.urlParam('evaluation') ) {
            var modal = UIkit.modal('#evaluation', { bgclose:false });
            modal.show();
        }
    }, 3500);

})(jQuery);