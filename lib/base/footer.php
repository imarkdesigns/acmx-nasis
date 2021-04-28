<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

if ( !is_page([ 'coming-soon', 'maintenance', 'email-alert' ]) ) :

  get_template_part( _footer );
  get_template_part( _mobile );
  get_template_part( _scrap );

endif;

if ( ! is_page([ 2387, 2, 1279, 14 ]) && $post->post_type != 'nasis_investments' ) {
  get_template_part( _mdlADS.'modal-ad' );
}

wp_footer();


global $post;
?>

<script>
  window.addEventListener('load', function(){
    var timer= setInterval(function(){
      if(jQuery('#wpforms-confirmation-403').is(':visible')){
        var path = window.location.pathname;
        gtag('event', 'submit', {
          'event_category': 'PPM',
          'event_label': path
        });  
        clearInterval(timer)
      }
    },700);
    
    var timer1= setInterval(function(){
      if(window.location.href.indexOf('<?php echo $post->post_name; ?>') != -1){
        if(jQuery('.uk-panel-title:contains("Thank You")').is(':visible')){
          gtag('event', 'submit', {
            'event_category': 'Brochure',
            'event_label': 'Download brochure'
          });  
          clearInterval(timer1)
        }
      }
    },700);

    var timer2= setInterval(function(){
      if(window.location.href.indexOf('1031-exchange-information') != -1){
        if(jQuery('.uk-panel-title:contains("Thank You")').is(':visible')){
          gtag('event', 'submit', {
            'event_category': '1031',
            'event_label': '1031 exchange'
          });  
          clearInterval(timer2)
        }
      }
    },700);
  });
</script>
<script>
  window.addEventListener('load',function(){
    var formTimer = setInterval(function(){
      if(jQuery('#wpforms-confirmation-2268:contains("We have received your registration.")').is(':visible')){
        gtag('event', 'conversion', {'send_to': 'AW-878431571/1RfcCLGVhOIBENOa76ID'});
        clearInterval(formTimer);
      }
    },1000);
    if(window.location.href.indexOf("subscription=success") != -1){
      gtag('event', 'conversion', {'send_to': 'AW-878431571/J0mGCIqMhOIBENOa76ID'}); 
    }
  });
</script>

<?php // Open and Scroll WPForms @ Property from External Link
if ( $_GET['b'] == 'open' ) { ?>
<script>
jQuery(window).on("load", function() {
	jQuery('#brochure-request-form').removeClass('uk-hidden');
    UIkit.Utils.scrollToElement($('#section-request'));
});
</script>
<?php } 

// Download Property Brochure
if ($_GET['dpb'] == 'true') {
	
	if ( ! $_GET['ref'] && ! $_COOKIE['__client-relation'] ) {
		$brochure = get_field('brochure_file');
	} else {
    	$brochure = get_field('CR_brochure_file');
	} ?>
	<script type="text/javascript">
	jQuery(window).on("load",function(){if("true"==function(e){var n,o,t=window.location.search.substring(1).split("&");for(o=0;o<t.length;o++)if((n=t[o].split("="))[0]===e)return void 0===n[1]||decodeURIComponent(n[1])}("dpb")){!function(e,n){if(window.ActiveXObject){if(window.ActiveXObject&&document.execCommand){var o=window.open("fileURL","_blank");o.document.close(),o.document.execCommand("SaveAs",!0,n||e),o.close()}}else{var t=document.createElement("a");t.href=e,t.target="_blank";var i=e.substring(e.lastIndexOf("/")+1);if(t.download=n||i,navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/)&&navigator.userAgent.search("Chrome")<0)document.location=t.href;else{var a=new MouseEvent("click",{view:window,bubbles:!0,cancelable:!1});t.dispatchEvent(a),(window.URL||window.webkitURL).revokeObjectURL(t.href)}}}("<?php echo $brochure['url']; ?>","<?php echo $brochure['filename']; ?>")}});
	  <?php if ( $_GET['m'] == 'open' ) : ?>
	  setTimeout(function() {
		  var modal = UIkit.modal(".responseModal");
		  modal.show();
	  }, 3500);
	  <?php endif; ?>
	</script>
<?php } // end Download Property Brochure

$brochures = [ 'post_type' => ['page'], 'page_id' => '1279' ];
query_posts( $brochures );
// Start 1031 Exchange Download PDF
if ( $post->ID == 2719 ) :
	if ( $_GET['scid'] == 1300 ) :

		if ( $_GET['pdf'] != 'guide' ) {
			echo '<script>alert("Request is Invalid. Please sign the download form again.");</script>';
			echo '<script>window.location.href = "https://nasinvestmentsolutions.com/1031-exchange-information?q='.$_GET['pdf'].'#NASISEIG";</script>';
			return false;
		} else {
			while ( have_posts() ) : the_post();
	
			$brochure = get_field( '1031_exchange_pdf_file' ); ?>
			<script type="text/javascript">
				jQuery(window).on("load",function(){if("true"==function(e){var n,o,t=window.location.search.substring(1).split("&");for(o=0;o<t.length;o++)if((n=t[o].split("="))[0]===e)return void 0===n[1]||decodeURIComponent(n[1])}("dl")){!function(e,n){if(window.ActiveXObject){if(window.ActiveXObject&&document.execCommand){var o=window.open("fileURL","_blank");o.document.close(),o.document.execCommand("SaveAs",!0,n||e),o.close()}}else{var t=document.createElement("a");t.href=e,t.target="_blank";var i=e.substring(e.lastIndexOf("/")+1);if(t.download=n||i,navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/)&&navigator.userAgent.search("Chrome")<0)document.location=t.href;else{var a=new MouseEvent("click",{view:window,bubbles:!0,cancelable:!1});t.dispatchEvent(a),(window.URL||window.webkitURL).revokeObjectURL(t.href)}}}("<?php echo $brochure['url']; ?>","<?php echo $brochure['filename']; ?>")}});
			</script>	
			
			<?php endwhile; wp_reset_query();
		}
  
  endif;
endif;
	
if ( $post->ID == 2772 ) :
  if ( $_GET['scid'] == 2637 ) :

		if ( $_GET['pdf'] != 'booklet' ) {
			echo '<script>alert("Request is Invalid. Please sign the download form again.");</script>';
			echo '<script>window.location.href = "https://nasinvestmentsolutions.com/1031-exchange-information?q='.$_GET['pdf'].'#NASISEIG";</script>';
			return false;
		} else {
			while ( have_posts() ) : the_post();

			$brochure = get_field( 'booklet_pdf_file' ); ?>
			<script type="text/javascript">
				jQuery(window).on("load",function(){if("true"==function(e){var n,o,t=window.location.search.substring(1).split("&");for(o=0;o<t.length;o++)if((n=t[o].split("="))[0]===e)return void 0===n[1]||decodeURIComponent(n[1])}("dl")){!function(e,n){if(window.ActiveXObject){if(window.ActiveXObject&&document.execCommand){var o=window.open("fileURL","_blank");o.document.close(),o.document.execCommand("SaveAs",!0,n||e),o.close()}}else{var t=document.createElement("a");t.href=e,t.target="_blank";var i=e.substring(e.lastIndexOf("/")+1);if(t.download=n||i,navigator.userAgent.toLowerCase().match(/(ipad|iphone|safari)/)&&navigator.userAgent.search("Chrome")<0)document.location=t.href;else{var a=new MouseEvent("click",{view:window,bubbles:!0,cancelable:!1});t.dispatchEvent(a),(window.URL||window.webkitURL).revokeObjectURL(t.href)}}}("<?php echo $brochure['url']; ?>","<?php echo $brochure['filename']; ?>")}});
			</script>

			<?php endwhile; wp_reset_query();
		}

	endif;
endif;
// End of 1031 Exchange Download PDF

if ( $_GET['cta'] == 1 ) :?>
<script>
$(window).load(function(){
  setTimeout(function(){
    $( "a#cta" ).trigger( "click" );
  }, 1000);
});
</script>
<?php elseif ( $_GET['referral'] == 'true' ) : ?>
<script>
$(window).load(function(){
  $('#RequestInvestmentModal').trigger('click');
});
</script>
<?php // Investment Form
  elseif ( $_GET['success'] == 'true' ) : ?>
<script>
$(window).load(function(){
  $('#verifySuccessBtn').trigger('click');
});
</script>
<?php // Contact Form
  elseif ( $_GET['status'] == 'success' ) : ?>
<script>
$(window).load(function(){
	UIkit.notify("Thanks for submitting your message. We'll be in touch as soon as possible.", {status:'success'});
});
</script>
<?php // Client Response Message - Referral Page
  elseif ( $_GET['responseKey'] == '1' ) : ?>
<script>
$(window).load(function() {
    $('.clientResponseMessage').trigger('click');
});
</script>
<?php // Client Response Message - Referral Page
  elseif ( $_GET['responseKey'] == '2' ) : ?>
<script>
$(window).load(function() {
    $('.friendResponseMessage').trigger('click');
});
</script>
<?php endif;

echo '</body>'."\n";
echo '</html>';