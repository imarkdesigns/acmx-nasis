<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

session_set_cookie_params(0);
session_start();
$_SESSION['reference'] = $contact;

$header_img = get_field('news_featured_image');
$content_section = get_field('news_content'); ?>

<?php get_template_part( _menu ); ?>

<main class="main" role="main" data-page-type="single">

  <header class="hero-post">
    <div class="section-page-wrapper">

      <figure class="uk-overlay">
      <?php
        if ( !empty($header_img) ) :
          echo wp_get_attachment_image( $header_img['id'], [ 1600, 900, true ] );
        else :
          echo '<img src="https://nasassets.com/nasinvestmentsolutions/wp-content/uploads/2017/08/background-image.jpg" alt="'.get_the_title().'">';
        endif;
        ?>
        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-bottom">
          <div class="uk-container uk-container-small">
            <h1 class="uk-heading-large"><?php the_title(); ?></h1>
          </div>
        </figcaption>
      </figure>

    </div>
  </header>

  <section class="sectionNews uk-block">
    <div class="uk-container uk-container-large">

        <div class="uk-grid uk-grid-large" data-uk-grid-margin>
          
          <div class="uk-width-medium-1-1 uk-width-large-3-4">
            <article id="id-<?php the_ID(); ?>" <?php post_class('uk-article'); ?>>
              <?php echo $content_section; ?>
            </article>
          </div>
          <div class="uk-visible-large uk-width-large-1-4 featured-property-panel">

            <?php /*
            <h3>Available Investments<br>1031 Exchange Eligible<br>Qualifies for Self-Directed IRA</h3>
            <hr class="uk-margin">

            <?php $investments = new WP_Query([ 'post_type' => ['nasis_investments'], 'posts_per_page' => 4, 'post__not_in' => [ 1702 ], 'has_password' => false, 'post_status' => 'publish' ]); ?>
            <?php while ( $investments->have_posts() ) : $investments->the_post();

          // Count how many are published
          $count = $investments->post_count;

            if ( $count == 1 ) {
              $ClassColumn = 'uk-width-1-1';
            } else {
              $ClassColumn = 'uk-width-medium-1-1 uk-width-large-1-2';
            }

            if ( isset($_COOKIE["MPaul_Referral"]) == 'true' ) :

              $status = get_field('property_investment_status');
              $MP = true;

              if ( $status == 'Sold Out' ) {
                $hideSold = 'uk-hidden';
              }

            endif;

          // Fetch Sidebar Data
          $status = get_field('property_investment_status');
          $featured_image = get_field('property_featured_image');

          if ( $status == 'Sold Out' ) {
            $hideSold = 'uk-hidden';
          }
          ?>
          <div class="<?php echo $hideSold; ?>">
            <figure class="uk-panel uk-panel-box featured-property">
              <div class="uk-panel-teaser">
                <a href="<?php the_permalink(); ?><?php echo ( $MP ) ? '?contact=mark' : ''; ?>" title="<?php the_title(); ?>">
                  <?php echo wp_get_attachment_image( $featured_image['id'], 'full' ); ?>
                </a>
              </div>
              <div class="uk-panel-footer uk-text-center">
                <?php echo get_the_title(); ?>
              </div>
            </figure>
          </div>
          <?php endwhile; wp_reset_query(); ?>            
          </div>
          */ ?>
          <?php $sidebar = [ 'post_type' => ['page'], 'page_id' => '1286' ];
          query_posts( $sidebar );
          
          while ( have_posts() ) : the_post();
            // Fetch ACF Content
            while ( have_rows('sidebar_property') ) : the_row(); ?>
                <div class="uk-panel uk-panel-box featured-property uk-text-center">
                <?php if ( get_sub_field('property_title') ) : 
                    $webiPhoto = get_sub_field('property_photo'); ?>
                    <div class="uk-panel-teaser">
                        <img src="<?php echo $webiPhoto['url']; ?>" alt="<?php echo strip_tags(get_sub_field('property_title')); ?>">
                    </div>
                    <?php endif; ?>
                    
                    <?php if ( get_sub_field('property_title') ) : ?>
                        <h3><?php the_sub_field('property_title'); ?></h3>
                    <?php endif; ?>
                    <div class="uk-panel-body" style="font-size:16px;">
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
                        <img src="<?php echo $webiPhoto['url']; ?>" alt="<?php echo strip_tags(get_sub_field('webinar_title')); ?>">
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

    </div>
  </section>

</main>

<?php $home = new WP_Query([ 'post_type' => 'page', 'page_id' => 788, 'posts_per_page' => 1 ]);
  while ( $home->have_posts() ) {

    $home->the_post();
    get_template_part( _router, 'colophon' );
    wp_reset_postdata();

  }
?>