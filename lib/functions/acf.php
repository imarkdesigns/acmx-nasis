<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

## Create Option Page
if( function_exists('acf_add_options_page') ) {
  /*
  acf_add_options_page([
    'page_title'  => 'Theme General Settings',
    'menu_title'  => 'Theme Settings',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => true
  ]);

  acf_add_options_sub_page([
    'page_title'  => 'Popup Alert',
    'menu_title'  => 'Notification',
    'parent_slug' => 'theme-general-settings',
  ]);
  */
}

## ACF API
function my_acf_google_map_api( $api ){
    $api['key'] = $_ENV['ACF_GOOGLEMAP'];
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

## ACF Style Overrides
function acf_styles() {

  // Load CSS Icons of Font Awesome
  echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';

  // Load Class
  echo '<link rel="stylesheet" href="'._uri.'/assets/styles/wp-acf-editor.css">'."\n";

}
add_action( 'acf/input/admin_head', 'acf_styles' );