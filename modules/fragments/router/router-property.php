<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<aside id="nextrouter" class="uk-block __property">
  <div class="uk-container uk-container-large">
    
    <?php $investment_list = new WP_Query([ 'post_type' => ['nasis_investments'], 'order' => 'ASC', 'orderby' => 'rand', 'posts_per_page' => -1 ]); ?>    
    <div class="uk-slidenav-position" data-uk-slider="{ infinite: true, center: true, }">
      <div class="uk-slider-container">
        <ul class="uk-slider uk-grid uk-grid-small uk-grid-width-medium-1-1">
        <?php while ( $investment_list->have_posts() ) : $investment_list->the_post(); ?>
        <?php $count = wp_count_posts( 'nasis_investments' )->publish; 
          
          global $post;

          if ( $count <= 1 ) {
            $class_column = 'uk-width-1-1';
          } else {
            $class_column = 'uk-width-medium-1-1 uk-width-large-1-2';
          }
                    
          $featured_image = get_field('featured_property_image'); ?>
          <li class="uk-flex uk-flex-center">
            <figure class="uk-overlay uk-overlay-hover">
              <img src="<?php echo $featured_image['url'] ?>" alt="<?php echo (!empty($featured_image['alt'])) ? $featured_image['alt'] : $featured_image['title'] ; ?>">
              <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-bottom">
                <div class="section-copy">
                  <h3><?php the_title(); ?></h3>
                  <?php the_field('property_description'); ?>
                  <div class="uk-button-group">
                  <?php if ( $_GET['key'] != 1 ) : ?>
                    <a data-uk-modal="{target: '#isLoggedIn-<?php echo $post->ID; ?>',bgclose: false, center: true}" class="uk-button uk-button-danger">Download Property PPM</a>
                  <?php else : ?>
                    <a href="<?php  ?>" class="uk-button uk-button-danger">Download Property PPM</a>
                  <?php endif; ?>
                  </div>
                  <small class="uk-form-help-block"><i class="uk-icon-exclamation-circle"></i> Requires NAS OnDemand account & completion of confidentiality agreement.</small>
    
                  <div class="button-floating">
                    <a data-uk-modal="{target: '#investmentHighlight-<?php echo $post->ID; ?>',bgclose: false, center: true}" class="uk-icon-button uk-icon-file-pdf-o"></a>
                    <span>Click to Download <br> Investment Highlights</span>
                  </div>
                </div>
              </figcaption>
            </figure>

            <?php # Init Modal ?>
            <div id="investmentHighlight-<?php echo $post->ID; ?>" class="uk-modal">
              <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                <button type="button" class="uk-modal-close uk-close uk-close-alt"></button>
                <div class="uk-modal-body">
                  <?php the_field('optin_to_download'); ?>
                </div>
              </div>
            </div>

            <?php # Init Modal for OnDemand ?>
            <div id="isLoggedIn-<?php echo $post->ID; ?>" class="uk-modal">
              <div class="uk-modal-dialog">
                <button type="button" class="uk-modal-close uk-close"></button>
                <div class="uk-modal-header">
                  <?php the_title(); ?> 
                </div>
                <div class="uk-modal-body">
                  <p>In order to view property details please read and agree to the terms of the confidentiality agreement for this property.</p>
                  <p><a href="<?php echo __('https://www.nasassets.com/ondemand'); ?>" target="_self">Click here to Login to OnDemand</a></p>
                </div>
                <div class="uk-modal-footer uk-text-small">
                  <p>In order to view details of available properties from NAS Investment Solutions you must first request that a NAS OnDemand account be created for you.</p>
                  <p><a href="<?php echo __(site_url( 'email-alert' )); ?>" class="uk-button uk-button-small">Click here to request your OnDemand account</a></p>
                </div>
              </div>
            </div>

          </li>
        <?php endwhile; wp_reset_query(); ?>
        </ul>
      </div>
      <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
      <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>      
    </div>

  </div>
</aside>
