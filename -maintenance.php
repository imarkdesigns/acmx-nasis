<?php /**
 * Template Name: Maintenance
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

get_template_part( _base_header );

  if ( $post->post_name == 'coming-soon' ) {
    get_template_part( _prelaunch );
  } elseif ( $post->post_name == 'email-alert' ) {
    get_template_part( _page, 'email-alert' );
  } else {
    get_template_part( _maintenance );
  }

get_template_part( _base_footer );