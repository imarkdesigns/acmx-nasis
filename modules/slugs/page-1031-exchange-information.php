<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ 

$firstname = $_GET['recipient'];
$firstname = explode(" ", $firstname);

// Include Local Navigation for 1031 Exchange Information
include( locate_template( _inc.'local-nav.php', false, true ) );
?>

<main class="main" role="main">

<?php
  // If page is NOT password protected
  if ( ! post_password_required() ) : ?>

  <?php if ( wp_is_mobile() ) : ?>
  <div class="uk-block uk-padding-bottom-remove uk-hidden-large">
    <div class="uk-container uk-container-small">

          <div class="featured-property-panel">
          <?php $sidebar = [ 'post_type' => ['page'], 'page_id' => '1286' ];
          query_posts( $sidebar );
          
          while ( have_posts() ) : the_post();
            // Fetch ACF Content
            while ( have_rows('sidebar_webinar') ) : the_row(); ?>
                <div class="uk-panel uk-panel-box featured-property uk-text-center">
                <?php if ( get_sub_field('webinar_photo') ) : 
                    $webiPhoto = get_sub_field('webinar_photo'); ?>
                    <div class="uk-panel-teaser">
                        <img src="<?php echo $webiPhoto['url']; ?>" alt="<?php echo strip_tags(get_sub_field('property_title')) ?>">
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
          endwhile; wp_reset_query(); ?>       
          </div>      
      
    </div>
  </div>
  <?php endif; ?>

  <section class="uk-block section-exchange">
    <div class="uk-container">

      <div class="uk-grid" data-uk-grid-margin>
        <div class="uk-width-large-2-3">
          <article class="uk-article">

            <?php the_field( 'intro_content' ); ?>

          </article>

          <?php // $LandingPageGallery = [ 'post_type' => ['nasis_investments'], 'p' => '2854' ];
          // query_posts( $LandingPageGallery ); 
          
          while ( have_rows('gallery_section') ) : the_row(); ?>

          <hr class="uk-divider-icon">

          <section id="LightBox" class="uk-block section-gallery">

                <h3><?php the_sub_field('lightbox_heading'); ?></h3>
                <p><a href="<?php echo __(get_sub_field('lightbox_link')); ?>"><?php the_sub_field('lightbox_link_label'); ?></a></p>

                <?php 
                    // Categories
                    $categories = get_sub_field('lightbox_category');
                    $categories = explode( ",", $categories);

                    // Gallery
                    $LBPhotos = get_sub_field('lightbox_photos');
                ?>

                <ul id="LightBoxControl" class="uk-subnav uk-subnav-pill">
                    <?php if ( $post->ID != '2700' ) :
                        echo '<li data-uk-filter="" class="uk-active"><a href="#">All</a></li>';
                    endif; ?>
                    <?php foreach ( $categories as $category ) { 
                    $category = trim($category); ?>
                    <li data-uk-filter="<?php echo $category; ?>" class="<?php echo ( $category == 'All' ) ? '--first' : (($category == 'Other Arkansas Acquisitions') ? '--last' : ''); ?>"><a href=""><?php echo $category; ?></a></li>
                    <?php } ?>
                </ul>

                <div class="uk-grid-width-1-1 uk-grid-width-small-1-2 uk-grid-width-medium-1-2 --lb-list" data-uk-grid="{controls:'#LightBoxControl', gutter: 10}">
                    <?php foreach ( $LBPhotos as $LBPhoto ) { ?>
                    <div data-filter="<?php echo $LBPhoto['description']; ?>" data-uk-filter="<?php echo $LBPhoto['description']; ?>">
                        <a class="uk-thumbnail" href="<?php echo $LBPhoto['url']; ?>" data-uk-lightbox="{group: '<?php echo $LBPhoto['description']; ?>'}" title="<?php echo $LBPhoto['title']; ?>">
                            <?php echo wp_get_attachment_image( $LBPhoto['id'], 'full' ); ?>
                            <div class="uk-thumbnail-caption"><?php echo $LBPhoto['title']; ?></div>
                        </a>
                    </div>
                    <?php } ?>
                </div>

          </section>

          <?php endwhile; // end gallery section ?>

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
                        <img src="<?php echo $webiPhoto['url']; ?>" alt="<?php echo strip_tags(get_sub_field('property_title')) ?>">
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

          <div class="at-glance">

            <?php the_field( 'at_a_glance' ); ?>

          </div>

          <div class="faqs">
            <form action="" method="post" class="uk-form uk-form-icon uk-form-icon-flip uk-hidden">
              <i class="uk-icon-search"></i>
              <input type="text" placeholder="Type your Frequently Asked Questions" class="uk-form-large uk-form-width-large">
            </form>
            <h3>Frequently Asked Questions</h3>
            <?php echo do_shortcode( '[candy-faq mrg_top="0px" mrg_bot="0px" limit_width="true" width="100%" filter_on="false" tggl_on="false" categories="912" chld_on="false" cat_on="false" count_on="false" custom_preset="false" preset="theme1"]' ); ?>
            <hr>
            <div class="uk-margin-top">
              <a href="<?php echo __(site_url('1031-exchange-information/faqs')); ?>" class="uk-button uk-button-success">Browse All FAQ's</a>
            </div>
          </div>

          <div class="articles-wrapper">
            <h3>Real Estate Investment Articles</h3>
            <div class="uk-grid uk-grid-match uk-grid-width-small-1-2 uk-grid-width-medium-1-1">
              <?php $articles = new WP_Query([ 'post_type' => 'exchange_articles', 'orderby' => 'menu_order', 'order' => 'ASC', 'posts_per_page' => 2 ]); ?>
              <?php while ( $articles->have_posts() ) : $articles->the_post(); ?>
              <div>
                <div <?php post_class('uk-article'); ?>>
                  <h4><?php the_title(); ?></h4>
                  <p><?php the_field( 'lead_paragraph' ); ?></p>
                  <p><a href="<?php the_permalink(); ?>">Read More</a></p>
                </div>
              </div>
              <?php endwhile; wp_reset_query(); ?>
            </div>

            <div class="uk-margin-large-top">
              <a href="<?php echo __(site_url('1031-exchange-information/1031-exchange-articles')); ?>" class="uk-button uk-button-success">More Articles</a>
            </div>
          </div>

        </div>
      </div>

    </div>
  </section>

  <section id="TaxRates" class="uk-block uk-block-secondary section-tax-rates">
    <div class="uk-container">
    <a href="#TaxRates" id="TaxAnimateScroll" data-uk-smooth-scroll="{offset: 70}"></a>
    <?php
      $stateID    = $_GET['id'];
      $permalink  = get_permalink();
      $disclaimer = get_field( 'disclaimer' );
      $taxes      = new WP_Query([ 'post_type' => 'page', 'page_id' => 1282, 'posts_per_page' => -1 ]);

      // Tax Rates
      $tr_heading = get_field( 'heading_label' );
      $tr_button  = get_field( 'button_label' );
      $tr_content = get_field( 'taxrates_content' );

      while ( $taxes->have_posts() ) : $taxes->the_post(); ?>
      <div class="uk-grid uk-grid-large" data-uk-grid-margin>
        <div class="uk-width-medium-2-3">
          <h3><?php echo $tr_heading; ?></h3>

          <select id="dynamic-states" name="states" class="uk-select">
            <option value="">Search Your 2021 State's Rate</option>

            <?php $rowCount = 0;
            $rows = get_field('tax_table_list');
            foreach( $rows as $row ) {

              $rowCount++;
              $selected = ( isset($stateID) && $rowCount == $stateID ) ? 'selected' : '';
              // echo '<option '.$selected.' value="'.$permalink .'?id='. $rowCount.'"> '.$row['state'].' </option>';
              echo '<option '.$selected.' value="'.$rowCount.'" data-percent="'.$row['state_percent'].'" data-combined="'.$row['combined_percent'].'"> '.$row['state'].' </option>';

            } ?>
          </select>

          <?php echo $tr_content; ?>
          <p><a href="<?php echo __(site_url('1031-exchange-information/tax-rates-by-state')); ?>" class="uk-button uk-button-default"><?php echo $tr_button; ?></a></p>
          <?php if ( $disclaimer != '' ) : ?>
          <aside class="disclaimer">
            <?php echo $disclaimer; ?>
          </aside>
          <?php endif; ?>

        </div>
        <div class="uk-width-medium-1-3">
        <?php
          if ( empty($stateID) ) {
            $rowID = $rows[4];
          } else {
            $rowsID = $stateID - 1;
            $rowID = $rows[$rowsID];
          }

          $stateName    = $rowID['state'];
          $statePercent = $rowID['state_percent'];
          $combinedPercent = $rowID['combined_percent'];
          ?>

          <h2>
            <span class="state-name"><?php echo $stateName; ?></span>
            <span class="state-combined-percentage">Top Marginal Tax Rate on Capital Gains <span class="scp-value"><?php echo $combinedPercent; ?></span>%</span>
          </h2>
          <div class="uk-grid uk-grid-width-small-1-2">
            <div>
                <div class="svg-wrapper">
                  <?php /* <svg class="progress green noselect" data-progress="<?php echo $statePercent; ?>" x="0px" y="0px" viewBox="0 0 80 80"> */ ?>
                  <svg class="progress green noselect" data-progress="<?php echo $statePercent; ?>" x="0px" y="0px" viewBox="0 0 80 80">
                    <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                    <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                    <text class="value" x="50%" y="57.5%" fill="#92C800">0%</text>
                  </svg>
                </div>
                <h4>State Rate <small>2021</small></h4>
            </div>
            <div>
                <div class="svg-wrapper">
                  <?php /* <svg class="progress orange noselect" data-progress="<?php echo $combinedPercent; ?>" x="0px" y="0px" viewBox="0 0 80 80"> */ ?>
                  <svg class="progress orange noselect" data-progress="<?php echo $combinedPercent; ?>" x="0px" y="0px" viewBox="0 0 80 80">
                    <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                    <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                    <text class="value" x="50%" y="57.5%" fill="#F37021">0%</text>
                  </svg>
                </div>
                <h4>Combined Rate <small>2021</small></h4>
            </div>
          </div>
        </div>
      </div>
      <?php endwhile;

    // Reset Query
    wp_reset_query(); ?>

    </div>
  </section>

  <section id="EIG" class="uk-block section-articles">
    <div class="uk-container">

        <?php
	        $tab = $_GET['tab'];
			$switch = $_GET['q'];
	    ?>

        <ul class="uk-tab" data-uk-tab="{connect:'#my-id', animation: 'uk-animation-fade'}">
            <li class="<?php echo ( $tab == 'guide' || $switch == 'guide' ) ? 'uk-active' : ''; ?>"><a href="#">Download Our Free 1031 Exchange Guides</a></li>
            <li class="<?php echo ( $tab == 'booklet' || $switch == 'booklet' ) ? 'uk-active' : ''; ?>"><a href="#">Download FREE Investment White Papers</a></li>
        </ul>

        <ul id="my-id" class="uk-switcher">
            <li>
                <!-- 1031 Exchange Guide -->
                <div class="uk-grid uk-grid-collapse uk-flex uk-flex-middle">
                    <div class="uk-width-medium-1-3 uk-position-relative">
                        <div class="banner-container">
                            <div class="banner">
                                <?php the_field('floating_banner'); ?>
                            </div>
                        </div>
                        <?php
                            $cover = get_field('1031_exchange_booklet_cover');
                            echo wp_get_attachment_image( $cover['id'], 'full' );
                        ?>
                    </div>
                    <div class="uk-width-medium-2-3">
                        <div class="uk-contrast">
                            <?php the_field( 'form_content' ); ?>
                            <div class="form-wrapper">
                                <?php echo do_shortcode( '[wpforms id="1300" title="false" description="false"]' ); ?>
                            </div>
                            <p class="uk-text-small"><?php the_field( 'form_text_reference' ); ?></p>
                        </div>
                    </div>
                </div>
                <!-- 1031 Exchange Guide -->
            </li>
            <li>
                <!-- Booklet Guide -->
                <div class="uk-grid uk-grid-collapse uk-flex uk-flex-middle">
                    <div class="uk-width-medium-1-3 uk-position-relative">
                        <div class="banner-container">
                            <div class="banner">
                                <?php the_field('floating_banner_booklet'); ?>
                            </div>
                        </div>
                        <?php
                            $cover = get_field('booklet_cover');
                            echo wp_get_attachment_image( $cover['id'], 'full' );
                        ?>
                    </div>
                    <div class="uk-width-medium-2-3">
                        <div class="uk-contrast">
                            <?php the_field( 'form_content_booklet' ); ?>
                            <div class="form-wrapper">
                                <?php echo do_shortcode( '[wpforms id="2637" title="false" description="false"]' ); ?>
                            </div>
                            <p class="uk-text-small"><?php the_field( 'form_text_reference_booklet' ); ?></p>
                        </div>
                    </div>
                </div>
                <!-- Booklet Guide -->
            </li>
        </ul>


    </div>
  </section>

  <section class="uk-block section-router">
    <div class="uk-grid uk-grid-collapse uk-grid-match" data-uk-grid-match>

      <?php
      $classNum = -1;
      $classList = [ 'uk-width-medium-1-2', 'uk-width-medium-1-2', 'uk-width-medium-1-1' ];
      while ( have_rows( 'router_wrapper' ) ) : the_row();
      $classNum++;
      $icon = get_sub_field( 'router_icon' ); ?>
      <div class="<?php echo $classList[$classNum]; ?> uk-width-xlarge-1-3 uk-flex uk-flex-middle">
        <div class="uk-panel">
          <?php echo wp_get_attachment_image( $icon['id'], [ 50, 50, true ] ); ?>
          <h3><?php the_sub_field( 'router_title' ); ?></h3>
          <p><?php the_sub_field( 'router_content' ); ?></p>
          <p><a href="<?php the_sub_field( 'router_link' ); ?>" class="uk-button uk-button-default">Click Here</a></p>
        </div>
      </div>
      <?php endwhile; ?>

    </div>
  </section>

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

<div id="guide-response" class="uk-modal setBanner">
    <div class="uk-modal-dialog">
      <button type="button" class="uk-modal-close uk-close"></button>
      <div class="uk-modal-header"> Thank you for downloading 1031 Exchange Guide </div>
      <div class="uk-panel">
        <h3 class="uk-panel-title"> Thank You, <?php echo $firstname[0]; ?>. </h3>
        <p>Whether you are an investor unfamiliar with the process or have extensive experience with tax-deferred investments, we hope the following guide serves as a valuable educational and reference tool for you.</p>
        <p>Please feel free to reach out to us with any questions you may have or suggestions on how we can improve upon this guide and our website.</p>
        <p>Karen E. Kennedy <br> President & Founder <br> NAS Investment Solutions, LLC.</p>
      </div>
    </div>
</div>

<div id="booklet-response" class="uk-modal --setBanner">
    <div class="uk-modal-dialog">
      <div class="uk-modal-header"> <button type="button" class="uk-modal-close uk-close"></button> </div>
      <div class="uk-panel">
        <h3 class="uk-panel-title"> Thank You, <?php echo $firstname[0]; ?>. </h3>
        <p>Whether you are a new investor or a seasoned pro, we hope these articles are educational and useful in your endeavors. We believe well-informed investors are the best members of our client family.</p>
        <p>Please feel free to reach out to us with any questions you may have or suggestions on how we can improve upon our website.</p>
        <p>Karen E. Kennedy <br> President & Founder <br> NAS Investment Solutions, LLC.</p>
      </div>
    </div>
</div>

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