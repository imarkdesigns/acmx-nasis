<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

if ( ! function_exists( 'theme_nasis' ) ) :

  function theme_nasis() {

    add_theme_support('title-tag');
    add_theme_support('html5', ['caption', 'gallery', 'search-form']);
    add_theme_support('post-thumbnails');

    add_theme_support('soil-clean-up');
    add_theme_support('soil-disable-asset-versioning');
    add_theme_support('soil-disable-trackbacks');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    // add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-js-to-footer');

    // add_theme_support('soil-google-analytics', 'UA-131372472-1');
    // add_theme_support('soil-relative-urls');
    add_image_size( 'small', 360, 640 );

    add_editor_style(  _styles.'wp-editor.css' );

  }
  add_action( 'after_setup_theme', 'theme_nasis' );

endif;

## Theme Content Width
function theme_width_content() {
  $GLOBALS['content_width'] = apply_filters( 'theme_width_content', 980 );
}
add_action( 'after_setup_theme', 'theme_width_content', 0 );

## Activate Menu
function wp_menu() {
  $locations = array(
    'header_menu' => __( 'Main Menu Navigation', 'text_domain' ),
    'footer_menu' => __( 'Footer Menu Navigation', 'text_domain' ),
    'mobile_menu' => __( 'Mobile Menu Navigation', 'text_domain' ),
  );
  register_nav_menus( $locations );
}
add_action( 'init', 'wp_menu' );

// Register Sidebars
function custom_sidebars() {

  $args = array(
    'id'            => 'pageviews',
    'class'         => 'pageviews',
    'name'          => __( 'pageViews', 'text_domain' ),
  );
  register_sidebar( $args );

  $aCat = array(
    'id'            => 'article_category',
    'class'         => 'article_category',
    'name'          => __( 'Article Category', 'text_domain' ),
  );
  register_sidebar( $aCat );

  $aTag = array(
    'id'            => 'article_tag',
    'class'         => 'article_tag',
    'name'          => __( 'Article Tag', 'text_domain' ),
  );
  register_sidebar( $aTag );

  $aRecent = array(
    'id'            => 'article_recent',
    'class'         => 'article_recent',
    'name'          => __( 'Article Recent Post', 'text_domain' ),
  );
  register_sidebar( $aRecent );

}
add_action( 'widgets_init', 'custom_sidebars' );