<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$functions_includes = [
  'lib/functions/assets.php',
  'lib/functions/hooks.php',
  'lib/functions/editor.php',
  'lib/functions/theme.php',

  // ACF Plugin
  'lib/functions/acf.php',
];

foreach ( $functions_includes as $file ) {
  if ( !$filepath = locate_template($file) ) {
    trigger_error( sprintf(_( 'Error location %s for inclusion', 'nasis' ), $file), E_USER_ERROR );
  }
  require_once $filepath;
}
unset($file, $filepath);

## Template Definitions

# URI Path
define( '_uri', get_template_directory_uri() );
define( '_site', site_url() );

// Page, Post Path Patterns
define( '_page',        'modules/slugs/page' );
define( '_post',        'modules/slugs/post' );
define( '_search',      'modules/slugs/search' );

define( '_prelaunch',   'modules/maintenance/coming-soon' );
define( '_maintenance', 'modules/maintenance/maintenance' );

# Fragments Path Patterns
define( '_menu',        'modules/fragments/menu' );
define( '_header',      'modules/fragments/header' );
define( '_footer',      'modules/fragments/footer' );
define( '_mobile',      'modules/fragments/mobile' );
define( '_dropdown',    'modules/fragments/dropdown' );

define( '_hero',        'modules/fragments/hero/hero' );
define( '_router',      'modules/fragments/router/router' );

# Scrap Path Patterns
define( '_scrap',       'lib/base/scrap' );

# Base Path Patterns
define( '_base_header', 'lib/base/header' );
define( '_base_footer', 'lib/base/footer' );

# Modal Ad
define( '_mdlADS', 'modules/inc/' );
define( '_inc',    'modules/inc/' );

# Assets Path Patterns
define( '_styles',      _uri.'/assets/styles/' );
define( '_scripts',     _uri.'/assets/scripts/' );
define( '_plugins',     _uri );

/**
 * Debug Pending Updates
 *
 * Crude debugging method that will spit out all pending plugin
 * and theme updates for admin level users when ?debug_updates is
 * added to a /wp-admin/ URL.
 */
function debug_pending_updates() {

    // Rough safety nets
    if ( ! is_user_logged_in() || ! current_user_can( 'manage_options' ) ) return;
    if ( ! isset( $_GET['debug_updates'] ) ) return;

    $output = "";

    // Check plugins
    $plugin_updates = get_site_transient( 'update_plugins' );
    if ( $plugin_updates && ! empty( $plugin_updates->response ) ) {
        foreach ( $plugin_updates->response as $plugin => $details ) {
            $output .= "<p><strong>Plugin</strong> <u>$plugin</u> is reporting an available update.</p>";
        }
    }

    // Check themes
    wp_update_themes();
    $theme_updates = get_site_transient( 'update_themes' );
    if ( $theme_updates && ! empty( $theme_updates->response ) ) {
        foreach ( $theme_updates->response as $theme => $details ) {
            $output .= "<p><strong>Theme</strong> <u>$theme</u> is reporting an available update.</p>";
        }
    }

    if ( empty( $output ) ) $output = "No pending updates found in the database.";

    wp_die( $output );
}
add_action( 'init', 'debug_pending_updates' );

function remove_img_title($atts) {
    unset($atts['title']);
    return $atts;
}
add_filter('wp_get_attachment_image_attributes','remove_img_title', 10, 4);

function ah_get_attachment_link_filter( $content ) {       

        $new_content = preg_replace('/title=\'(.*?)\'/', '', $content );
        return $new_content;
}
add_filter('wp_get_attachment_link', 'ah_get_attachment_link_filter', 10, 4);

// Filter to hide protected posts
/*
function exclude_protected($where) {
	global $wpdb;
	return $where .= " AND {$wpdb->posts}.post_password = '' ";
}

// Decide where to display them
function exclude_protected_action($query) {
	if( !is_single() && !is_page() && !is_admin() ) {
		add_filter( 'posts_where', 'exclude_protected' );
	}
}

// Action to queue the filter at the right time
add_action('pre_get_posts', 'exclude_protected_action');
*/
/**
 * Add a redirect field for password protect forms when
 * HTTP_REFERER isn't set
 *
 * @access public
 * @param string $form_html
 * @return string
function wpa_add__wp_http_referer( $form_html ) {
 if ( empty( $_SERVER['HTTP_REFERER'] ) ) {
     $form_html = str_ireplace( '</form>', '<input type="hidden" name="_wp_http_referer" value="' . esc_url( get_the_permalink() ) . '"></form>', $form_html );
 }
 
 return $form_html;
}
add_filter( 'the_password_form', array( $this, 'wpa_add__wp_http_referer' ), 10, 1 );
 */


// WP Video Popup
/*
function prefix_your_custom_embed_url_attributes( $video_url ) {
    $video_url .= '&modestbranding=1&rel=0&showinfo=0&playsinline=1&list=search&listType=search&enablejsapi=1';
    return $video_url;
}
add_filter( 'wp_video_popup', 'prefix_your_custom_embed_url_attributes' );
*/


// SDM Hook
/*
add_filter('sdm_download_shortcode_output', 'custom_download_output', 10, 2);

function custom_download_output($output, $args){
    $download_id = $args['id'];
    $button_text = $args['button_text'];
    $homepage = get_bloginfo( 'url' );
    $download_url = $homepage . '/?smd_process_download=1&download_id=' . $download_id ;

    //Just as a test lets show the download URL of the item.
    $output = 'My Test Download URL: ' . $download_url;
    return $output;
}
*/


// Convert all URLs to Absolute Path
function getFullPath($url){
    return realpath(str_replace(get_bloginfo('url'), '.', $url));
}

// Fill-in the WPForms isCR
// parameter to activate: ?ref=324d8a1d3f81e730d5099a48cee0c5b6
// Set Cookie Session if Client Relation is Passive
if ( isset($_GET['ref']) || isset($_COOKIE['__client-relation']) ) {
	$_GET['isCR'] = 'Yes, User is Client Relation Contact';
}
