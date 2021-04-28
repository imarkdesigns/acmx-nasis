<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">

  <section id="section-investments" class="uk-block">
    <div class="uk-container">

      <?php $investment = new WP_Query([ 'post_type' => ['nasis_investments'], 'posts_per_page' => -1, 'post__not_in' => [ 1702 ], 'has_password' => false, 'post_status' => 'publish' ]); ?>
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
                <?php if ( get_field('activate_banner') ) : ?>
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
                <?php endif; ?>

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