<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">

<?php
  // If page is NOT password protected
  if ( ! post_password_required() ) : ?>

  <section id="section-introduction" class="uk-block">
    <div class="uk-container uk-container-small">
      <div class="section-copy">
        <?php the_field('introduction_content'); ?>
      </div>

      <ul class="uk-grid uk-grid-width-small-1-1 uk-grid-width-medium-1-2" data-uk-grid-match data-uk-grid-margin>
      <?php while ( have_rows( 'blurb_content' ) ) : the_row(); ?>
      <?php $icon_svg = get_sub_field('blurb_icon'); ?>
        <li><div class="uk-panel">
          <figure class="uk-flex uk-flex-middle uk-flex-center">
            <img src="<?php echo $icon_svg['url']; ?>" alt="<?php the_sub_field( 'blurb_title' ); ?>">
          </figure>
          <h3 class="uk-panel-title"><?php the_sub_field( 'blurb_title' ); ?></h3>
          <p><?php the_sub_field( 'blurb_content' ); ?></p>
        </div></li>
      <?php endwhile; ?>
      </ul>
    </div>
  </section>

  <section id="section-available-investments" class="uk-block">
    <div class="uk-container">
      <div class="section-copy">
        <?php the_field('available_investments_content'); ?>
      </div>

      <?php $investment = new WP_Query([ 'post_type' => ['nasis_investments'], 'posts_per_page' => 4, 'post__not_in' => [ 1702 ], 'has_password' => false, 'post_status' => 'publish' ]); ?>
      <div class="uk-grid uk-grid-small uk-grid-match" data-uk-grid-margin data-uk-grid-match>
      <?php while ( $investment->have_posts() ) : $investment->the_post();

          $featuredIMG        = get_field('header_background');
          $propertyStatus     = get_field('property_status');
          $propertyHeading    = get_field('property_heading');
          $propertySubHeading = get_field('property_subheading');
          $propertyButton     = get_field('property_button');

          $propertyContext1   = get_field('banner_context1');
          $propertyContext2   = get_field('banner_context2');
          $propertyContext3   = get_field('banner_context3');

          if ( get_field('property_status') == 'Sold Out' ) {
            $spanClass = 'uk-badge-danger';
          } else {
            $spanClass = 'uk-badge-success';
          }

        ?>
        <div class="uk-width-medium-1-1 uk-width-large-1-2">
          <figure class="uk-overlay">
            <?php echo wp_get_attachment_image( $featuredIMG['id'], [ 640, 360 ] ); ?>
            <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-bottom">
              <div class="section-copy">
                <?php
	            // Disable this for selected Banner Highlights only
	            if ( get_field('disable_banner') != 1 ) :
	            		// Activate overlay banner for all properties
		            if ( get_field('activate_banner') ) : ?>
	                <div class="uk-panel">
	                  <h4><?php echo $propertyContext1; ?></h4>
	                  <p><?php 
	                    if ( get_field('banner_anchor_tag') ) {
	                      echo '<a href="'.site_url( '/ppm?property=' . str_replace(" ", "-", get_the_title()) ) .'">' .$propertyContext2. '</a>';
	                    } else {
	                      echo $propertyContext2;
	                    }
	                  ?></p>
	                </div>
	                <?php endif; 
	            endif; ?>

                <span class="uk-badge <?php echo $spanClass; ?>"><?php echo $propertyStatus; ?></span>

                <h3> <?php echo $propertyHeading; ?> <?php echo ( $propertySubHeading ) ? '<br> <small>'. $propertySubHeading .'</small>' : ''; ?> </h3>
                <p class="uk-text-capitalize"><?php echo $propertyButton; ?></p>
              </div>
            </figcaption>
            <a href="<?php the_permalink(); ?>" class="uk-position-cover"></a>
          </figure>
        </div>
        <?php endwhile; wp_reset_query(); ?>
      </div>

    </div>
  </section>

  <section id="CompanyVideo" role="presentation">
    <div class="uk-container">
      <hgroup>
        <h2><?php the_field('youtube_heading'); ?></h2>
      </hgroup>
      <?php $ytID = get_field('youtube_iframe_source'); ?>
	  <?php $ytIDs = explode("/", $ytID); ?>
      <iframe id="ytplayer" type="text/html" width="100%" height="405" src="https://www.youtube-nocookie.com/embed/<?php echo $ytIDs[3]; ?>?controls=0&enablejsapi=1&fs=0&modestbranding=1&playsinline=1&rel=0" frameborder="0" allowfullscreen></iframe>
    </div>
  </section>

  <?php ## if ( current_user_can('editor') || current_user_can('administrator') ) :
  $testimonials = new WP_Query([ 'post_type' => 'page', 'page_id' => 1201 ]);
  while ( $testimonials->have_posts() ) : $testimonials->the_post(); ?>

  <section id="section-testimonials" class="uk-block">
    <div class="uk-container uk-container-small">
      <h3 class="uk-heading-line uk-text-center"><span>NASIS Client Testimonials</span></h3>

      <?php while ( have_rows( 'testimonials_lists' ) ) : the_row();
      $photo = get_sub_field('client_photo'); ?>
      <blockquote class="featured-quote">
        <?php if ( $photo ) : ?>
        <h4 class="uk-flex uk-flex-middle">
          <div><strong><?php the_sub_field('client_name'); ?></strong> <small><?php the_sub_field('client_details'); ?></small></div>
          <img src="<?php echo $photo['url']; ?>" width="72" height="72" class="uk-thumbnail uk-border-circle" alt="<?php echo $photo['alt']; ?>">
        </h4>
        <?php else : ?>
          <h4><strong><?php the_sub_field('client_name'); ?></strong> <small><?php the_sub_field('client_details'); ?></small></h4>
        <?php endif; ?>

        <p><?php the_sub_field('testimonial'); ?></p>
      </blockquote>
      <?php break;
      endwhile; ?>

      <div class="uk-accordion" data-uk-accordion="showfirst: false">
        <h3 class="uk-accordion-title"> Read More Testimonials </h3>
        <div class="uk-accordion-content">

          <div class="uk-grid uk-grid-width-medium-1-2">
            <?php while ( have_rows( 'testimonials_lists' ) ) :
            the_row(); ?>
            <div>
              <blockquote>
                <h4><strong><?php the_sub_field('client_name'); ?></strong> <small><?php the_sub_field('client_details'); ?></small></h4>
                <p><?php the_sub_field('testimonial'); ?></p>
              </blockquote>
            </div>
            <?php endwhile; ?>
          </div>

        </div>
      </div>

    </div>
  </section>

  <?php endwhile; wp_reset_query();
  ## endif; ?>

<?php else : ?>

  <section id="Protected-Page" class="uk-block uk-block-large">
    <div class="uk-container uk-container-small uk-flex uk-flex-middle uk-flex-center">
      <article class="uk-article">
      <?php
        // Fall back to standard content with password form
        the_content();
      ?>
      </article>
    </div>
  </section>

<?php endif;
  // End password protection ?>

</main>

<?php

  // Router Selection
  $router = get_field('theme_router');

  switch($router) :

    case 'team' :
      get_template_part( _router, 'team' );
      break;

    default :
      get_template_part( _router, 'colophon' );
      break;

  endswitch;

?>