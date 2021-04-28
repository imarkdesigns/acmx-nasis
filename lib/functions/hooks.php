<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

## Add Schema.org to the site
function body_schema() {
  if (is_single()) :
    $type = 'Article';

  elseif (is_author()) :
    $type = 'ProfilePage';

  elseif (is_search()) :
    $type = 'SearchResultsPage';

  else :
    $type = 'WebPage';
  endif;

  $schema = 'http://schema.org/';
  echo 'itemscope="itemscope" itemtype="'.$schema.$type.'"';
}



## Removes or edits the 'Protected:' part from posts titles
function remove_protected_text() {
  return __('%s');
}
add_filter( 'protected_title_format', 'remove_protected_text' );

## Disallow Plugin Editor | Disallow update & installation of themes & plugins
define('DISALLOW_FILE_EDIT', true);
// define('DISALLOW_FILE_MODS',true);

## Hide Admin Bar
// add_filter('show_admin_bar', '__return_false');

## Remove //s.w.org/ dns-prefetch
add_filter('emoji_svg_url', '__return_false');

## Disable Post and Comments
function remove_menus(){
  // remove_menu_page( 'edit.php' );
  remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'remove_menus' );

## Disable Post and Media access Link WP Admin Bar
function remove_wp_nodes() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_node( 'new-post' );
  $wp_admin_bar->remove_node( 'new-link' );
  // $wp_admin_bar->remove_node( 'new-media' );
}
add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );

## Remove Comments & Tags Column
add_filter( 'manage_posts_columns', 'custom_post_columns', 10, 2 );
function custom_post_columns( $columns, $post_type ) {
  switch ( $post_type ) {
    case 'post':
    unset(
      $columns['tags'],
      $columns['comments']
    );
    break;
  }
  return $columns;
}

## Add `async` Attributes to all scripts
// function add_async_attribute($tag, $handle) {
//   // add script handles to the array below
//   $scripts_to_async = array('js/script');

//   foreach($scripts_to_async as $async_script) {
//     if ($async_script === $handle) {
//        return str_replace(' src', ' defer src', $tag);
//     }
//   }
//   return $tag;
// }
// add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

## Display Popular Post
function observePostViews($postID) {
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count=='') {
    $count = 0;
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
  } else {
    $count++;
    update_post_meta($postID, $count_key, $count);
  }
}
function fetchPostViews($postID) {
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count=='') {
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '0');
  return "0 View";
  }
  return $count.' Views';
}

// Custom Excerpt function for Advanced Custom Fields
function custom_field_excerpt() {
  global $post;
  $text = get_field('content'); //Replace 'your_field_name'
  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]&gt;', ']]&gt;', $text);
    $excerpt_length = 60; // 20 words
    $excerpt_more = apply_filters('excerpt_more', '' . '...');
    $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  }
  return apply_filters('the_excerpt', $text);
}

function custom_glossary() {
  global $post;
  $text = get_field('content'); //Replace 'your_field_name'
  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]&gt;', ']]&gt;', $text);
    $excerpt_length = 40; // 20 words
    $excerpt_more = apply_filters('excerpt_more', '' . '...');
    $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  }
  return apply_filters('the_excerpt', $text);
}


## Replace <p> to <figure> wrapping image tag
function img_caption_shortcode_filter($val, $attr, $content = null) {
  extract(shortcode_atts(array(
    'id'      => '',
    'align'   => 'aligncenter',
    'width'   => '',
    'caption' => ''
  ), $attr));

  // No caption, no dice... But why width?
  if ( 1 > (int) $width || empty($caption) )
    return $val;

  if ( $id )
    $id = esc_attr( $id );

  // Add itemprop="contentURL" to image - Ugly hack
  $content = str_replace('<img', '<img itemprop="contentURL"', $content);
  return '<figure id="' . $id . '" aria-describedby="figcaption_' . $id . '" class="wp-caption ' . esc_attr($align) . '" itemscope itemtype="http://schema.org/ImageObject">' . do_shortcode( $content ) . '<figcaption id="figcaption_'. $id . '" class="wp-caption-text uk-text-small" itemprop="description">' . $caption . '</figcaption></figure>';
}
add_filter( 'img_caption_shortcode', 'img_caption_shortcode_filter', 10, 3 );

## Format textarea for display
$filters = array('term_description');
foreach ( $filters as $filter ) {
  add_filter( $filter, 'wptexturize' );
  add_filter( $filter, 'convert_chars' );
  remove_filter( $filter, 'wpautop' );
}

## Remove empty <p> tags
function remove_empty_p( $content ) {
  $content = force_balance_tags( $content );
  $content = preg_replace( '#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content );
  $content = preg_replace( '~\s?<p>(\s|&nbsp;)+</p>\s?~', '', $content );
  return $content;
}
add_filter('the_content', 'remove_empty_p', 20, 1);

## Allow VCard Uploading
function vcard_upload($mimes) {
  $mimes['vcf'] = 'text/x-vcard';
  return $mimes;
}
add_filter( 'upload_mimes', 'vcard_upload' );

## Allow SVG Uploading
function svg_upload($mimes) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'svg_upload', 99);

## Modify Title Placeholder of certain Post
function wpb_change_title_text( $title ){
  $screen = get_current_screen();
  if  ( 'nasis_investments' == $screen->post_type ) {
    $title = 'Enter property title here';
  }

  elseif ( 'nasis_team' == $screen->post_type ) {
    $title = 'Enter name here';
  }
  return $title;
}
add_filter( 'enter_title_here', 'wpb_change_title_text' );


function wpb_image_editor_default_to_gd( $editors ) {
    $gd_editor = 'WP_Image_Editor_GD';
    $editors = array_diff( $editors, array( $gd_editor ) );
    array_unshift( $editors, $gd_editor );
    return $editors;
}
add_filter( 'wp_image_editors', 'wpb_image_editor_default_to_gd' );

## Add New Field @ General Settings
// $new_general_setting = new new_general_setting();

// class new_general_setting {
//   function new_general_setting( ) {
//     add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
//   }
//   function register_fields() {
//       register_setting( 'general', 'mod_to_email', 'esc_attr' );
//       register_setting( 'general', 'mod_cc1_email', 'esc_attr' );
//       register_setting( 'general', 'mod_cc2_email', 'esc_attr' );
//       add_settings_field('mod_to_email', '<label for="mod_to_email">'.__('Moderator Email Address' , 'mod_to_email' ).'</label>' , array(&$this, 'fields_html') , 'general');
//   }
//   function fields_html() {
//       $modToEmail = get_option( 'mod_to_email', '' );
//       $modCC1Email = get_option( 'mod_cc1_email', '' );
//       $modCC2Email = get_option( 'mod_cc2_email', '' );
//       echo '<div><input type="email" id="mod_to_email" name="mod_to_email" value="' . $modToEmail . '" placeholder="To:" class="regular-text ltr" aria-describedby="moderator-email-description"></div>';
//       echo '<div><input type="email" id="mod_cc1_email" name="mod_cc1_email" value="' . $modCC1Email . '" placeholder="Cc:" class="regular-text ltr" aria-describedby="moderator-email-description"></div>';
//       echo '<div><input type="email" id="mod_cc2_email" name="mod_cc2_email" value="' . $modCC2Email . '" placeholder="Cc:" class="regular-text ltr" aria-describedby="moderator-email-description"></div>';
//       echo '<p class="description" id="moderator-email-description">This address is used for download purposes, like new user downloading Investment Highlight Property.</p>';
//   }
// }

// add_action( 'admin_footer-options-general.php', function() {
  /* ?>
  <script type="text/javascript">
  jQuery(document).ready( function($) {
    var mod_to_email = $("label[for='mod_to_email']").parent().parent();
    var admin_email = $("label[for='admin_email']").parent().parent();
    mod_to_email.insertAfter(admin_email);
  });
  </script>
  <?php */
// });

add_action( 'after_setup_theme', 'wpse_74735_replace_wp_caption_shortcode' );

/**
 * Replace the default caption shortcode handler.
 *
 * @return void
 */
function wpse_74735_replace_wp_caption_shortcode() {
    remove_shortcode( 'caption', 'img_caption_shortcode' );
    remove_shortcode( 'wp_caption', 'img_caption_shortcode' );
    add_shortcode( 'caption', 'wpse_74735_caption_shortcode' );
    add_shortcode( 'wp_caption', 'wpse_74735_caption_shortcode' );
}

/**
 * Add the new class to the caption.
 *
 * @param  array  $attr    Shortcode attributes
 * @param  string $content Caption text
 * @return string
 */
function wpse_74735_caption_shortcode( $attr, $content = NULL )
{
    $caption = img_caption_shortcode( $attr, $content );
    $caption = str_replace( 'class="wp-caption', 'class="wp-caption uk-width-medium', $caption );
    return $caption;
}


// add_action( 'wp_enqueue_scripts', 'theme_register_scripts', 1 );
// function theme_register_scripts() {
//   wp_register_script( 'functions-js', esc_url( trailingslashit( get_template_directory_uri() ) . 'functions.js' ), ['jquery'], time(), true );

//   $php_array = array( 'admin_ajax' => admin_url( 'admin-ajax.php' ) );
//   wp_localize_script( 'functions-js', 'php_array', $php_array );
// }

// add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );
// function theme_enqueue_scripts() {
//   wp_enqueue_script( 'functions-js' );
// }

// add_action( "wp_ajax_single", "get_single" );
// add_action( "wp_ajax_nopriv_single", "get_single" );

// function get_single() {

//   global $post;
//   $post_id = $_REQUEST['id'];

//   if ( $post_id ) {
//     $post = get_post($post_id);
//     setup_postdata($post);
//     get_template_part( _page, 'ajax' );
//     die();
//   }


// }


add_filter('widget_posts_args', 'widget_posts_args_add_custom_type');
function widget_posts_args_add_custom_type($params) {
   $params['exchange_articles'] = array('post','custom_type');
   return $params;
}

/**
 * Show values in Dropdown, checkboxes and Multiple Choice.
 *
 * @link https://wpforms.com/developers/add-field-values-for-dropdown-checkboxes-and-multiple-choice-fields/
 *
 */
add_action( 'wpforms_fields_show_options_setting', '__return_true' );


//* Create sub-navigation to main menu
class subMenuWrap extends Walker_Nav_Menu {
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class=\"uk-dropdown uk-dropdown-navbar uk-dropdown-bottom\"><ul class=\"uk-nav uk-nav-dropdown\">\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}