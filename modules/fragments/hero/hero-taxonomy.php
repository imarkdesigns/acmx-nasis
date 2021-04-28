<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$post_glossary_header = new WP_Query([ 'post_type' => 'page', 'page_id' => 1290, 'post__in' => [ 1286 ] ]);
$post_header = new WP_Query([ 'post_type' => 'page', 'page_id' => 1286, 'post__in' => [ 1286 ] ]);

$taxonomyName = get_query_var( 'taxonomy' );

if ( $taxonomyName == 'topic_category' ) :

  while ( $post_glossary_header->have_posts() ) : $post_glossary_header->the_post();  
  $hero_bg = get_field('header_background');
  ?>

  <?php if ( $_COOKIE['backLink'] == 'true' ) { ?>
  <div class="uk-navbar _backlinks">
      <div class="uk-container uk-container-large">
          <div class="uk-navbar-flip">
              <i class="uk-icon-long-arrow-left"></i> <a href="https://www.nasassets.com/" class="backLink"> Back to NASASSETS.Com </a>
          </div>
      </div>
  </div>
  <?php } ?>

  <header class="hero-page _taxonomy">
    <?php get_template_part( _menu ); ?>
    <div class="section-page-wrapper">

      <figure class="uk-overlay">
      <?php echo wp_get_attachment_image( $hero_bg['id'], 'full' ); ?>
        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-bottom">
          <div class="uk-container uk-container-small">
            <h1 class="uk-heading-large"><?php the_title(); ?></h1>
          </div>
        </figcaption>
      </figure>

    </div>
  </header>
  <?php endwhile;

  wp_reset_postdata();
  
else :

  while ( $post_header->have_posts() ) : $post_header->the_post();  
  $hero_bg = get_field('header_background'); ?>

  <?php if ( $_COOKIE['backLink'] == 'true' ) { ?>
  <div class="uk-navbar _backlinks">
      <div class="uk-container uk-container-large">
          <div class="uk-navbar-flip">
              <i class="uk-icon-long-arrow-left"></i> <a href="https://www.nasassets.com/" class="backLink"> Back to NASASSETS.Com </a>
          </div>
      </div>
  </div>
  <?php } ?>

  <header class="hero-page _taxonomy">
    <?php get_template_part( _menu ); ?>
    <div class="section-page-wrapper">

      <figure class="uk-overlay">
      <?php echo wp_get_attachment_image( $hero_bg['id'], 'full' ); ?>
        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-bottom">
          <div class="uk-container uk-container-small">
            <?php
            if ( $taxonomyName == 'topic_category' ) :

            while ( $post_glossary_header->have_posts() ) : $post_glossary_header->the_post(); ?>
            <h1 class="uk-heading-large"><?php the_title(); ?></h1>
            <?php endwhile; wp_reset_postdata();

            elseif ( $taxonomyName == 'article_category' ) : ?>
            <h1 class="uk-heading-large"><small>Articles Topic:</small> <?php single_term_title(); ?></h1>
            <?php else : ?>
            <h1 class="uk-heading-large"><small>Articles Keyword:</small> <?php single_term_title(); ?></h1>
            <?php endif; ?>
          </div>
        </figcaption>
      </figure>

    </div>
  </header>
  <?php endwhile;

  wp_reset_postdata();

endif;

