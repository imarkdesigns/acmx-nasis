<?php /**
 * Template Name: Page
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

global $post;
 
get_template_part( _base_header );
    
    get_template_part( _page, $post->post_name );
    
    if ( $post->ID == '1279' || $post->ID == '14' ) {
        include_once( get_template_directory() . '/modules/inc/global-investment-modal.php' );
    }
    
      
get_template_part( _base_footer );