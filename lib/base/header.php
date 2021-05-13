<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<?php wp_head(); ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131372472-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-131372472-1');
</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-878431571"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'AW-878431571');
</script>
</head>
<body <?php body_class( $pagename ) . body_schema(); ?>>
<?php if ( !is_page([ 'coming-soon', 'maintenance', 'email-alert' ]) ) :
    get_template_part( _header );
endif; ?>