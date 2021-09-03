(function( $ ) {

/**
 * initMap
 *
 * Renders a Google Map onto the selected jQuery element
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @return  object The map instance.
 */
function initMap( $el ) {

    // Find marker elements within map.
    var $markers = $el.find('.marker');

    // Set data zoom
    var $zoom = $('.acf-map');

    // Create gerenic map.
    var mapArgs = {
        // zoom        : $el.data('zoom') || 15,
        // zoom  		: $el.attr('data-zoom'),
        zoom 		: 10,
        mapTypeId   : google.maps.MapTypeId.ROADMAP,
        scrollwheel	: false
    };
    var map = new google.maps.Map( $el[0], mapArgs );

    // Add markers.
    map.markers = [];
    $markers.each(function(){
        initMarker( $(this), map );
    });

    // Center map based on markers.
    centerMap( map );

    // Return map instance.
    return map;
}

/**
 * initMarker
 *
 * Creates a marker for the given jQuery element and map.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   jQuery $el The jQuery element.
 * @param   object The map instance.
 * @return  object The marker instance.
 */
function initMarker( $marker, map ) {

    // Get position from marker.
    var lat = $marker.data('lat');
    var lng = $marker.data('lng');
    var latLng = {
        lat: parseFloat( lat ),
        lng: parseFloat( lng )
    };
    
    var $origin1 = window.location.pathname;
    var $origin2 = window.location.href;
    
    var url = new URL($origin2);
    var p = url.searchParams.get("p");

    console.log(url);

    var $setPath   = url['pathname'].split('/'),
        $setName   = $setPath[2].split('-'),
        $imgMarker = $setName[0] +'-'+ $setName[1],
        $default   = 'nasis-marker';


    var $assets   = '/wp-content/themes/acmx-nasis/assets/markers/',
        $extName  = '.png',
        $pathName = url['origin'] + $assets + $imgMarker + $extName,
        $callback = url['origin'] + $assets + $default + $extName;

    function doesFileExist(urlToFile) {
        var xhr = new XMLHttpRequest();
        xhr.open('HEAD', urlToFile, false);
        xhr.send();
         
        return xhr.status !== 404;
    }
        
    if ( doesFileExist($pathName) === true ) {
        $mapIcon = $pathName;
    } else {
        var $mapMarker = url['origin'] + $assets + $default + $extName;
        $mapIcon = $mapMarker;
    }

    var marker = new google.maps.Marker({
        position : latLng,
        map: map,
        icon: $mapIcon
        // icon: 'https://www.nasinvestmentsolutions.com/wp-content/uploads/2017/08/nasis-marker.png',
    });

    // Append to reference for later use.
    map.markers.push( marker );

    // If marker contains HTML, add it to an infoWindow.
    if( $marker.html() ){

        // Create info window.
        var infowindow = new google.maps.InfoWindow({
            content: $marker.html()
        });

        // Show info window when marker is clicked.
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open( map, marker );
        });
    }
}

/**
 * centerMap
 *
 * Centers the map showing all markers in view.
 *
 * @date    22/10/19
 * @since   5.8.6
 *
 * @param   object The map instance.
 * @return  void
 */
function centerMap( map ) {

    // Create map boundaries from all map markers.
    var bounds = new google.maps.LatLngBounds();
    map.markers.forEach(function( marker ){
        bounds.extend({
            lat: marker.position.lat(),
            lng: marker.position.lng()
        });
    });

    // Case: Single marker.
    if( map.markers.length == 1 ){
        map.setCenter( bounds.getCenter() );

    // Case: Multiple markers.
    } else{
        map.fitBounds( bounds );
    }
}

// Render maps on page load.
$(document).ready(function(){
    $('.acf-map').each(function(){
        var map = initMap( $(this) );
    });
});

})(jQuery);