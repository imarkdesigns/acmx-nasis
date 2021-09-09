<?php
// Declare global $post
global $post;

if ( !is_page([ 'coming-soon', 'maintenance', 'email-alert' ]) ) :
  get_template_part( _footer );
  get_template_part( _mobile );
  get_template_part( _scrap );
endif;

if ( ! is_page([ 2387, 2, 1279, 14 ]) && $post->post_type != 'nasis_investments' ) {
  get_template_part( _mdlADS.'modal-ad' );
}

wp_footer(); ?>
<script type="text/javascript">
window.addEventListener('load', function() {
// jQuery(window).on('load', function() {

    // PPM
    var timer = setInterval(function() {
        if ( jQuery('#wpforms-confirmation-403').is(':visible') ) {
            var path = window.location.pathname;
            gtag('event', 'submit', {
                'event_category' : 'PPM',
                'event_label'    : path
            });
            clearInterval(timer);
        }
    }, 700);

    <?php if ( $post->post_type == 'nasis_investments' ) : ?>
    // Property Landing Page
    var timer1 = setInterval(function() {
        if ( window.location.href.indexOf('<?php echo $post->post_name; ?>') != -1 ) {
            if ( jQuery('.uk-panel-title:container("Thank You")').is(':visible') ) {
                gtag('event', 'submit', {
                    'event_category' : 'Brochure',
                    'event_label'    : 'Download brochure'
                });
                clearInterval(timer1);
            }
        }
    }, 700);
    <?php endif; ?>

    // Download Guide
    var timer2 = setInterval(function() {
        if ( window.location.href.indexOf('1031-exchange-information') != -1 ) {
            if ( jQuery('.uk-panel-title:contains("Thank You")').is(':visible') ) {
                gtag('event', 'submit', {
                    'event_category' : '1031',
                    'event_label'    : '1031 exchange'
                });
                clearInterval(timer2);
            }
        }
    }, 700);

    // Webinar
    var formTimer = setInterval(function() {
        if ( jQuery('#wpforms-confirmation-2268:contains("We have received your registration.")').is(':visible') ) {
            gtag('event', 'conversion', {
                'sent_to' : 'AW-878431571/1RfcCLGVhOIBENOa76ID'
            });
            clearInterval(formTimer);
        }
    }, 1000);

    if ( window.location.href.indexOf('subscription = success') != -1 ) {
        gtag('event', 'conversion', {
            'sent_to' : 'AW-878431571/1RfcCLGVhOIBENOa76ID'
        });
    }
    // End of Google Tag Manager

    <?php 
    // Scroll & open WPForms section (external link only)
    if ( $_GET['b'] == 'open' ) : ?>
        jQuery('#brochure-request-form').removeClass('uk-hidden');
        UIkit.Utils.scrollElement(jQuery('#section-request'));
    <?php endif; ?>

    <?php
                
    // Download Property Brochure
    if ( $_GET['dpb'] == 'true' ) :

        if ( !empty($_GET['ref']) || isset($_COOKIE['__client-relation']) == 'active' ) {
            $brochure = get_field( 'CR_brochure_file' );
        } else {
            $brochure = get_field( 'brochure_file' );
        } 
        
        ?>

        // minified script
        jQuery(window).on("load",function(){if("true"==function(e){var n,o,t=window.location.search.substring(1).split("&");for(o=0;o<t.length;o++)if((n=t[o].split("="))[0]===e)return void 0===n[1]||decodeURIComponent(n[1])}("dpb")){!function(e,n){if(window.ActiveXObject){if(window.ActiveXObject&&document.execCommand){var o=window.open("fileURL","_blank");o.document.close(),o.document.execCommand("SaveAs",!0,n||e),o.close()}}else{var t=document.createElement("a");t.href=e,t.target="_blank";var i=e.substring(e.lastIndexOf("/")+1);if(t.download=n||i,navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/)&&navigator.userAgent.search("Chrome")<0)document.location=t.href;else{var a=new MouseEvent("click",{view:window,bubbles:!0,cancelable:!1});t.dispatchEvent(a),(window.URL||window.webkitURL).revokeObjectURL(t.href)}}}("<?php echo $brochure['url']; ?>","<?php echo $brochure['filename']; ?>")}});

        // activate modal
        <?php if ( $_GET['m'] == 'open' ) : ?>

            setTimeout(function() {
                var modal = UIkit.modal(".responseModal");
                modal.show();
            }, 3500);
        
        <?php endif;

    endif;
    // End download property brochure ?>

    <?php
    // Booklet & 1031 Exchange Download PDF
    $brochures = ['post_type'=>['page'],'page_id'=>'1279'];
    query_posts( $brochures );

    // Trigger for 1031 Guide
    if ( $post->ID == 2719 ) :

        if ( $_GET['pdf'] != 'guide' || $_GET['scid'] != 1300 ) {
            echo 'window.location.href = "'.site_url().'/1031-exchange-information?dlpdf=invalid&q='.$_GET['pdf'].'#NASISEIG";';
            return false;
        } else {
            while ( have_posts() ) : the_post();
                $brochure = get_field( '1031_exchange_pdf_file' ); ?>
                jQuery(window).on("load",function(){if("true"==function(e){var n,o,t=window.location.search.substring(1).split("&");for(o=0;o<t.length;o++)if((n=t[o].split("="))[0]===e)return void 0===n[1]||decodeURIComponent(n[1])}("dl")){!function(e,n){if(window.ActiveXObject){if(window.ActiveXObject&&document.execCommand){var o=window.open("fileURL","_blank");o.document.close(),o.document.execCommand("SaveAs",!0,n||e),o.close()}}else{var t=document.createElement("a");t.href=e,t.target="_blank";var i=e.substring(e.lastIndexOf("/")+1);if(t.download=n||i,navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/)&&navigator.userAgent.search("Chrome")<0)document.location=t.href;else{var a=new MouseEvent("click",{view:window,bubbles:!0,cancelable:!1});t.dispatchEvent(a),(window.URL||window.webkitURL).revokeObjectURL(t.href)}}}("<?php echo $brochure['url']; ?>","<?php echo $brochure['filename']; ?>")}});
            <?php endwhile; wp_reset_query(); 
        }

    // Trigger for Booklet
    elseif ( $post->ID == 2772 ) :

        if ( $_GET['pdf'] != 'booklet' || $_GET['scid'] != 2637 ) {
            // echo 'alert("Request is Invalid. Please sign the download form again.");';
            echo 'window.location.href = "'.site_url().'/1031-exchange-information?dlpdf=invalid&q='.$_GET['pdf'].'#NASISEIG";';
            return false;
        } else {
            while ( have_posts() ) : the_post();
                $brochure = get_field( 'booklet_pdf_file' ); ?>
                jQuery(window).on("load",function(){if("true"==function(e){var n,o,t=window.location.search.substring(1).split("&");for(o=0;o<t.length;o++)if((n=t[o].split("="))[0]===e)return void 0===n[1]||decodeURIComponent(n[1])}("dl")){!function(e,n){if(window.ActiveXObject){if(window.ActiveXObject&&document.execCommand){var o=window.open("fileURL","_blank");o.document.close(),o.document.execCommand("SaveAs",!0,n||e),o.close()}}else{var t=document.createElement("a");t.href=e,t.target="_blank";var i=e.substring(e.lastIndexOf("/")+1);if(t.download=n||i,navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/)&&navigator.userAgent.search("Chrome")<0)document.location=t.href;else{var a=new MouseEvent("click",{view:window,bubbles:!0,cancelable:!1});t.dispatchEvent(a),(window.URL||window.webkitURL).revokeObjectURL(t.href)}}}("<?php echo $brochure['url']; ?>","<?php echo $brochure['filename']; ?>")}});
            <?php endwhile; wp_reset_query();
        }

    // Echo Alert for Invalid Booklet & Guide Download
    elseif ( $post->ID == 1279 ) :

        if ( $_GET['dlpdf'] == 'invalid' ) { ?>
            setTimeout(function() {
                alert("Request Download is Invalid. Please sign the download form again.");
            }, 1000);
        <?php }

    endif;
    // End downwload for booklet & guide ?>

    <?php
    // Click to action
    if ( $_GET['cta'] == 1 ) : ?>

        setTimeout(function() {
            jQuery('a#cta').trigger('click');
        }, 1000);

    <?php
    // Client Response Message 
    elseif ( $_GET['responseKey'] == '1' ) : ?>

        setTimeout(function() {
            jQuery('.clientResponseMessage').trigger('click');
        }, 1000);

    <?php
    // Client Response Message 
    elseif ( $_GET['responseKey'] == '2' ) : ?>

        setTimeout(function() {
            jQuery('.friendResponseMessage').trigger('click');
        }, 1000);

    <?php endif; ?>
});
</script>
<?php
echo '</body>'."\n";
echo '</html>';