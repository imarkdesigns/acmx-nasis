(function($) {

    // States Percentage Graph
    $(window).on('load', function() {
        var forEach = function (array, callback, scope) {
            for (var i = 0; i < array.length; i++) {
               callback.call(scope, i, array[i]);
            }
        };

        var max = "-219.99078369140625";
        forEach(document.querySelectorAll('.progress'), function (index, value) {
            var percent = value.getAttribute('data-progress');
            value.querySelector('.fill').setAttribute('style', 'stroke-dashoffset: ' + ((100 - percent) / 100) * max);
            value.querySelector('.value').innerHTML = percent + '%';
        });

        $('#dynamic-states').on('change', function() {
            var str = "";
            var percentage = "";
            var combined = "";

            $('#dynamic-states option:selected').each(function() {
                str += $( this ).text() + '';
                percentage = $(this).data('percent');
                combined = $(this).data('combined');
            });

            $('h2 span.state-name').text( str );
            $('h2 span.scp-value').text( combined );
            $('.svg-wrapper svg.green').attr( 'data-progress', percentage );
            $('.svg-wrapper svg.orange').attr( 'data-progress', combined );

            var max = "-219.99078369140625";
            forEach(document.querySelectorAll('.progress'), function(index, value) {
                var percent = value.getAttribute('data-progress');
                value.querySelector('.fill').setAttribute('style', 'stroke-dashoffset: ' + ((100 - percent) / 100) * max);
                value.querySelector('.value').innerHTML = percent + '%';
            });
        });
    });

    // 1031 Exchange Download Response
    // $(window).on('load', function() {
    //     $.urlParam = function(name){
    //         var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    //         if ( results == null ) {
    //             return null;
    //         } else {
    //             return results[1] || 0;
    //         }
    //     }

    //     setTimeout(function() {
    //         if( $.urlParam('dl') === 'guide' ) {
    //             var modal = UIkit.modal('.setBanner', { bgclose:false });
    //             modal.show();
    //         } else if ( $.urlParam('dl') === 'booklet' ) {
    //             var modal = UIkit.modal('.--setBanner', { bgclose:false });
    //             modal.show();
    //         }
    //     }, 3500);

    // });

}) (jQuery);