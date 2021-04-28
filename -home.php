<?php /**
 * Template Name: Home
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

get_template_part( _base_header );

    switch ( $post->post_name ) {
        
        case 'home': 
            $postName = 'home'; 
            break;
        
        case 'home-copy':
            $postName = 'home-copy';
            break;
        
    }

    get_template_part( _page, $postName );
    include_once( get_template_directory() . '/modules/inc/global-investment-modal.php' );

get_template_part( _base_footer );