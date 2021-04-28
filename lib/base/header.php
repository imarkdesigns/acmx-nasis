<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php wp_head(); ?>
<?php /*
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo _site.'/apple-touch-icon.png'; ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo _site.'/favicon-32x32.png'; ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo _site.'/favicon-16x16.png'; ?>">
<link rel="manifest" href="<?php echo _site.'/manifest.json'; ?>">
<link rel="mask-icon" href="<?php echo _site.'/safari-pinned-tab.svg'; ?>" color="#90C43D">
*/ ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="publisher" href="//plus.google.com/112877813887887359821/about">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131372472-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131372472-1');
</script>

<?php /*
// <!-- Global site tag (gtag.js) - Google Ads: 878431571 -->
// This tag is for global settings of Google Ads
*/ ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-878431571"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-878431571');
</script>

<?php
	// Google Tag for Webinar
	if ( is_page([ 2289 ]) ) : ?>
	
		
	
	<?php endif;
	// End Google Tag
?>

</head>
<body <?php body_class( $pagename ) . body_schema(); ?>>

<?php if ( !is_page([ 'coming-soon', 'maintenance', 'email-alert' ]) ) :
  // get_template_part( _menu );
  get_template_part( _header );
endif; ?>