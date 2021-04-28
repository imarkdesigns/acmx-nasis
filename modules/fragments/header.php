<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/


## News + Archives
if ( is_home() && !is_archive() ) {
  get_template_part( _hero, 'news' );
}

elseif ( is_archive() ) {
  get_template_part( _hero, 'taxonomy' );
}

## Home Header
elseif ( is_page([ 'home', 'home-copy' ]) ) {
  get_template_part( _hero, 'home' );
}

## Page Header
elseif ( is_404() || is_page() || is_singular(['investor_overview']) && !is_page([ 'home' ]) ) {
  get_template_part( _hero, 'page' );
}

## Glossary
elseif ( is_singular(['glossary']) ) {
  get_template_part( _hero, 'glossary' );
}

## Custom Post Types -  NASIS Team
elseif ( is_singular(['nasis_team']) ) {
  get_template_part( _hero, 'members' );
}