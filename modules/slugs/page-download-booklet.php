<?php 
//! Get Parameter Info
$brochureType = $_GET['pdf'];

$firstname = $_GET['recipient'];
$firstname = explode(" ", $firstname);
?>

<main class="main" role="main">

<section class="uk-block section-exchange">
    <div class="uk-container">

      <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-large-2-3">
          <article class="uk-article --thank-you">
            <?php if ( $brochureType == 'guide' ) : ?>
            
                <h3> Thank You, <?php echo $firstname[0]; ?>. </h3>
                <?php the_field( 'msg_guide' ); ?>
            
            <?php elseif ( $brochureType == 'booklet' ) : ?>

                <h3> Thank You, <?php echo $firstname[0]; ?>. </h3>
                <?php the_field( 'msg_booklet' ); ?>

            <?php endif; ?>
          </article>
        </div>
        <div class="uk-width-large-1-3">
	    <?php if ( ! wp_is_mobile() ) : ?>
        <div class="uk-visible-large featured-property-panel">
          <?php $sidebar = [ 'post_type' => ['page'], 'page_id' => '1286' ];
          query_posts( $sidebar );
          
          while ( have_posts() ) : the_post();
            // Fetch ACF Content
            while ( have_rows('sidebar_property') ) : the_row(); ?>
                <div class="uk-panel uk-panel-box featured-property uk-text-center">
                <?php if ( get_sub_field('property_title') ) : 
                    $webiPhoto = get_sub_field('property_photo'); ?>
                    <div class="uk-panel-teaser">
                        <img src="<?php echo $webiPhoto['url']; ?>" alt="<?php the_sub_field('property_title'); ?>">
                    </div>
                    <?php endif; ?>
                    
                    <?php if ( get_sub_field('property_title') ) : ?>
                        <h3><?php the_sub_field('property_title'); ?></h3>
                    <?php endif; ?>
                    <div class="uk-panel-body">
                        <?php the_sub_field('property_details'); ?>  
                    </div>
                    
                    <?php if ( get_sub_field('property_button_link') ) : ?>
                    <div class="uk-panel-footer uk-text-center">
                        <a href="<?php echo esc_url( get_sub_field('property_button_link') ); ?>" class="uk-button uk-button-default">
                            <?php the_sub_field('property_button_label'); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; // End of ACF
	                      
            // Fetch ACF Content
            while ( have_rows('sidebar_webinar') ) : the_row(); ?>
                <div class="uk-panel uk-panel-box featured-property uk-text-center">
                <?php if ( get_sub_field('webinar_photo') ) : 
                    $webiPhoto = get_sub_field('webinar_photo'); ?>
                    <div class="uk-panel-teaser">
                        <img src="<?php echo $webiPhoto['url']; ?>" alt="<?php the_sub_field('webinar_title'); ?>">
                    </div>
                    <?php endif; ?>
                    
                    <?php if ( get_sub_field('webinar_title') ) : ?>
                        <h3><?php the_sub_field('webinar_title'); ?></h3>
                    <?php endif; ?>
                    <div class="uk-panel-body">
                        <?php the_sub_field('webinar_details'); ?>	
                    </div>
                    
                    <?php if ( get_sub_field('webinar_button_link') ) : ?>
                    <div class="uk-panel-footer uk-text-center">
                        <a href="<?php echo esc_url( get_sub_field('webinar_button_link') ); ?>" class="uk-button uk-button-default">
                            <?php the_sub_field('webinar_button_label'); ?>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; // End of ACF
	            
            // Fetch ACF Content
            if ( have_rows('sidebar_download') ) :
            while ( have_rows('sidebar_download') ) : the_row(); ?>
            <div class="uk-panel uk-panel-box uk-text-center --download-ads">
                <div class="uk-panel-teaser">
	                <?php $bannerPhoto = get_sub_field( 'banner_cover' ); ?>
                    <div class="uk-overlay-panel">
                        <h3><?php the_sub_field( 'banner_title' ); ?></h3>                        
                    </div>
                    <img src="<?php echo $bannerPhoto['url']; ?>" alt="<?php echo $bannerPhoto['alt']; ?>">
                </div>
                <div class="uk-panel-footer uk-text-center">
                    <a href="<?php the_sub_field( 'banner_link' ); ?>" class="uk-button uk-button-default">
                        	<?php the_sub_field( 'banner_button' ); ?>
                    </a>
                </div>
            </div>
            <?php endwhile; // End of ACF
	        endif;
	            	            
          endwhile; wp_reset_query(); ?>       
          </div>
          <?php endif; ?>

        </div>
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

