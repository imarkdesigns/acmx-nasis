<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

// Disable WordPress Script & Function
function unnecessary_scripts() {
  wp_dequeue_script('jquery');
//   wp_deregister_script('jquery');
  wp_dequeue_style('wp-block-library');
}
add_filter( 'wp_enqueue_scripts', 'unnecessary_scripts', PHP_INT_MAX );

## Styles
function theme_elements() {

  global $post;
  
  // Switch Post Type to Assets
  switch ($post->post_type) {
    case 'nasis_team' :
      $postname = 'members';
      break;

    case 'investor_overview' :
      $postname = 'investors-download';
      break;

    case 'nasis_investments' :
      $postname = 'investment-highlights';
      break;

    case 'post' :
      $postname = 'news';
      break;
  } 

  # Framework - UIKit 2.27.5
  // wp_enqueue_style( 'css/uikit', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/uikit.min.css' );
  // wp_enqueue_style( 'css/uikit-slidenav', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/components/slidenav.min.css' );
  // wp_enqueue_style( 'css/uikit-slideshow', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/components/slideshow.min.css' );
  // wp_enqueue_style( 'css/uikit-slider', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/components/slider.almost-flat.min.css' );
  // wp_enqueue_style( 'css/uikit-tooltip', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/components/tooltip.almost-flat.min.css' );
//   wp_enqueue_style( 'css/uikit-accordion', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/components/accordion.almost-flat.min.css' );
  // wp_enqueue_style( 'css/uikit-notify', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/components/notify.min.css' );
  wp_enqueue_script( 'js/uikit', 'https://cdn.jsdelivr.net/npm/uikit@2.27.4/dist/js/uikit.min.js', ['jquery'], null, false );

  wp_enqueue_style( 'css/gf-prata', 'https://fonts.googleapis.com/css?family=Prata' );

  # Page Not Found
  if ( is_404() ) {
    wp_enqueue_style( 'css/global', _styles.'page-global.css' );
    
  }

  # Coming Soon & Email Alert
  elseif ( is_page( ['coming-soon'] ) ) {    
    wp_enqueue_style( 'css/global', _styles.'page-global.css' );
    wp_enqueue_style( 'css/coming-soon', _styles.'page-coming-soon.css' );
  }
  
  # Email Alert
  elseif ( is_page( ['email-alert'] ) ) {    
    wp_enqueue_style( 'css/global', _styles.'page-global.css' );
    wp_enqueue_style( 'css/coming-soon', _styles.'page-email-alert.css' );
  }
  
  # Maintenance
  elseif ( is_page( 'maintenance' ) ) {
    wp_enqueue_style( 'css/global', _styles.'page-global.css' );
    wp_enqueue_style( 'css/maintenance', _styles.'page-maintenance.css' );
  }

  # Post & Custom Post Type
  elseif ( is_home() || is_single() && !is_front_page() ) {
    
    if ( is_singular( 'nasis_team' ) ) {
      // wp_enqueue_style( 'css/uikit-accordion', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/components/accordion.min.css' );
      // wp_enqueue_style( 'css/font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
    }
   
    wp_enqueue_style( 'css/swiperjs', 'https://cdn.jsdelivr.net/npm/swiper@5.3.0/css/swiper.min.css' );
    wp_enqueue_style( 'css/global', _styles.'page-global.css' );
    
    if ( is_singular( 'exchange_articles' ) ) {
      wp_enqueue_style( 'css/page', _styles.'page-articles.css' );  
    } else if ( is_singular( 'glossary' ) ) {
      wp_enqueue_style( 'css/page', _styles.'page-glossary.css' );  
    } else {
      wp_enqueue_style( 'css/page', _styles.'page-'.$postname.'.css' );  
    }   
  }

  elseif ( is_category() || is_archive() ) {

    wp_enqueue_style( 'css/global', _styles.'page-global.css' );

    switch ( get_query_var( 'taxonomy' ) ) {

      case 'article_category'     : $postName = 'page-1031-exchange'; break;
      case 'article_tag'          : $postName = 'page-1031-exchange'; break;
      case 'topic_category'       : $postName = 'page-glossary'; break;

    }
    wp_enqueue_style( 'css/page', _styles.$postName.'.css' );    
    // if ( taxonomy_exists( 'topic_category' ) ) {
    //   wp_enqueue_style( 'css/page', _styles.'page-glossary.css' ); 
    // } else {
    //   wp_enqueue_style( 'css/page', _styles.'page-1031-exchange.css' );  
    // }
  }  

  # Page Section
  elseif ( is_page() && !is_page([ 'coming-soon', 'maintenance', 'email-alert' ]) ) {
    
    wp_enqueue_style( 'css/global', _styles.'page-global.css' );
    
    if ( is_page([ 'home', 'home-copy' ]) ) {
      // wp_enqueue_style( 'css/uikit-dotnav', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/css/components/dotnav.min.css' );
      wp_enqueue_style( 'css/page', _styles.'page-home.css' );
    } elseif ( is_page([ 'about', 'commercial-real-estate-investments' ]) ) {  
      wp_enqueue_style( 'css/page', _styles.'page-about.css' );
    } elseif ( is_page( 234 ) ) { // Investment Property Highlight Download
      wp_enqueue_style( 'css/page', _styles.'page-download.css' );
    } elseif ( is_page( 743 ) ) {
      wp_enqueue_style( 'css/page', _styles.'page-dst-exchage.css' );
    } elseif ( is_page([ 1279, 1282, 1284, 1286, 1288, 2289 ]) ) {
      wp_enqueue_style( 'css/page', _styles.'page-1031-exchange.css' );
    } elseif ( is_page([ 1290 ]) ) {
      wp_enqueue_style( 'css/page-exchange', _styles.'page-1031-exchange.css' );
      wp_enqueue_style( 'css/page-glossary', _styles.'page-glossary.css' );
    } elseif ( is_page([ 16, 2100 ]) ) {
      wp_enqueue_style( 'css/page', _styles.'page-contact.css' );
    } elseif ( is_page([ 'download-guide', 'download-booklet' ]) ) {
      wp_enqueue_style( 'css/page', _styles.'page-thankyou.css' );
    } else {
      wp_enqueue_style( 'css/page', _styles.'page-'.$post->post_name.'.css' );
    }


    
  }

}
add_action( 'wp_enqueue_scripts', 'theme_elements', 1 );


## Scripts
function main_script() {

  // wp_enqueue_script( 'js/uikit-slidset', 'https://cdnjs.cloudflare.com/ajax/libs/uikit/2.27.5/js/components/slideset.min.js', null, null, true );
  wp_enqueue_script( 'js/script', _scripts.'main.min.js', ['jquery'], null, true );
  
  if ( is_singular('nasis_investments') ) {
    
    if ( isset($_COOKIE['MCPopupClosed']) == "yes" ) {
      wp_enqueue_script( 'js/bioep', _scripts.'plugins/bioep.min.js', null, null, true );
      wp_enqueue_script( 'js/bioep-init', _scripts.'plugins/bioep.init.js', null, null, true );
    }    
    
    wp_enqueue_script( 'js/google-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAvkz_1vSXzaGB03fPw50jSpNQzjCOhTTc', null, null, true );
    wp_enqueue_script( 'js/acf-map', _scripts.'plugins/acf-map.js', ['jquery'], null, true );
    // wp_enqueue_script( 'js/recaptcha', 'https://www.google.com/recaptcha/api.js', null, null, true );  
  }

}
add_action( 'wp_enqueue_scripts', 'main_script', 2 );
