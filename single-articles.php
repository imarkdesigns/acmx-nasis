<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<?php if ( $_COOKIE['backLink'] == 'true' ) { ?>
<div class="uk-navbar _backlinks">
    <div class="uk-container uk-container-large">
        <div class="uk-navbar-flip">
            <i class="uk-icon-long-arrow-left"></i> <a href="https://www.nasassets.com/" class="backLink"> Back to NASASSETS.Com </a>
        </div>
    </div>
</div>
<?php } ?>

<?php // 1031 Exchange Information Page
if ( wp_is_mobile() ) {
  // return empty
} else { ?>
<div class="uk-hidden-small EIG1031">
  <a href="#" class="uk-close"></a>

  <div class="uk-container uk-container-large">
    <div class="uk-grid uk-flex uk-flex-middle" data-uk-grid-match>
      <div class="uk-width-medium-1-2 cover-guide">
        <figure class="uk-flex uk-flex-middle">
          <img src="<?php echo _uri.'/assets/images/book-cover-1031EIG.jpg'; ?>" alt="1031 Exchange Info Guide">
          <figcaption>
            <h4><span>Download Free 28-Page Booklet - 1031:</span> A Guide Through the Tax Deferred Real Estate Investment Process.</h4>
            <a href="<?php echo __(site_url( '/1031-exchange-information#EIG' )); ?>">Download Free Guide Here</a>
          </figcaption>
        </figure>
      </div>
      <div class="uk-width-medium-1-2 cover-booklet">
        <figure class="uk-flex uk-flex-middle">
          <img src="<?php echo _uri.'/assets/images/book-cover-booklet.jpg'; ?>" alt="Free 36-Page Booklet Real Estate Investing with the Lessons of 2020">
          <figcaption>
              <h4><span>Download Free 36-Page:</span> Real Estate Investing with the Lessons of 2020</h4>
              <a href="<?php echo __(site_url( '/1031-exchange-information?tab=booklet#EIG' )); ?>">Download Free Booklet Here</a>
          </figcaption>
        </figure>
      </div>
    </div>
  </div>

</div>
<?php } ?>

<?php get_template_part( _menu ); ?>

<main class="main " role="main">
  <?php if ( wp_is_mobile() ) : ?>
  <div class="uk-block uk-padding-bottom-remove uk-hidden-large">
    <div class="uk-container uk-container-small">

          <div class="featured-property-panel">
          <?php $sidebar = [ 'post_type' => ['page'], 'page_id' => '1286' ];
          query_posts( $sidebar );
          
          while ( have_posts() ) : the_post();
            // Fetch ACF Content
            while ( have_rows('sidebar_property') ) : the_row(); ?>
                <div class="uk-panel uk-panel-box featured-property uk-text-center uk-margin-bottom">
                <?php if ( get_sub_field('property_photo') ) : 
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
                	<!-- End of loop -->
            <?php endwhile; // End of ACF
	        	            
          endwhile; wp_reset_query(); ?>       
          </div>            
      
    </div>
  </div>
  <?php endif; ?>

  <section class="uk-block section-news-single">
    <div class="uk-container uk-container-large">

      <article class="uk-article">

        <h3><?php the_field('sub-headline') ?></h3>
        <h1><?php the_field('main-headline'); ?></h1>
        <div class="uk-article-meta">
          <hr class="uk-divider-small">
          <span><?php the_author(); ?></span> &bull; <time><?php the_time('l, F jS, Y'); ?></time>
        </div>

        <figure class="alignnone uk-text-center">
          <?php $thumb_id = get_post_thumbnail_id();
          echo wp_get_attachment_image( $thumb_id , [ 960, 540, true ], '', [ 'class' => 'uk-border-rounded uk-box-shadow-medium' ] ); ?>
          <!-- <img src="https://nasis.sb/wp-content/uploads/2018/09/2200-Bentonville.jpg" class="uk-border-rounded uk-box-shadow-medium" alt=""> -->
        </figure>

        <div class="uk-grid uk-grid-large" data-uk-grid-margin>
          
          <div class="uk-width-medium-1-1 uk-width-large-3-4">
            <?php the_field('content'); ?>    
          </div>
          
          <!-- Sidebar -->
          <?php if ( ! wp_is_mobile() ) : ?>
          <div class="uk-visible-large uk-width-large-1-4 featured-property-panel">
          <?php $sidebar = [ 'post_type' => ['page'], 'page_id' => '1286' ];
          query_posts( $sidebar );
          
          while ( have_posts() ) : the_post();
            // Fetch ACF Content
            while ( have_rows('sidebar_property') ) : the_row(); ?>
                <div class="uk-panel uk-panel-box featured-property uk-text-center uk-margin-bottom">
                <?php if ( get_sub_field('property_photo') ) : 
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
      </article>

      <aside class="uk-overlay uk-margin-top uk-border-rounded --books-banner">
        <div class="uk-slidenav-position" data-uk-slideshow>
            <ul class="uk-slideshow">
                <li>
                  <figure>
                    <img src="<?php echo _uri.'/assets/images/nas-guide.png'; ?>" alt="1031 Exchange Investments Guide">
                    <figcaption>
                      <h4><span>Download Free - 1031:</span> A Guide Through the Tax Deferred Real Estate Investment Process</h4>
                      <a href="<?php echo __(site_url('1031-exchange-information#EIG')); ?>" class="uk-button uk-button-secondary __download">Download Free Guide Here</a>
                    </figcaption>
                  </figure>
                </li>
                <li>
                  <figure>
                    <img src="<?php echo _uri.'/assets/images/nas-booklet.png'; ?>" alt="Real Estate Investing with the Lessons of 2020">
                    <figcaption>
                      <h4><span>Free 36-Page Booklet</span> Real Estate Investing with the Lessons of 2020: A Collection of 10 timely Articles</h4>
                      <a href="<?php echo __(site_url('1031-exchange-information?tab=booklet#EIG')); ?>" class="uk-button uk-button-secondary __download">Download Free Booklet</a>
                    </figcaption>
                  </figure>
                </li>
            </ul>
            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
            <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
                <li data-uk-slideshow-item="0"><a href=""></a></li>
                <li data-uk-slideshow-item="1"><a href=""></a></li>
            </ul>
        </div>
      </aside>

      <aside class="uk-author uk-margin">
        <header class="uk-comment-header">
          <?php $curauth = get_userdata( get_the_author_meta('ID') );
          echo get_avatar( get_the_author_meta('ID'), 44, '', get_the_author(), [ 'class' => 'uk-comment-avatar' ] ); ?>
          <h4 class="uk-comment-title"> About Author: <?php the_field( 'author_name', 'user_'.get_the_author_meta('ID') ); ?> </h4>
          <div class="uk-comment-meta"> <?php the_field( 'company_position', 'user_'.get_the_author_meta('ID') ); ?> <span>&bull;</span> <a href="<?php the_field( 'company_website_url', 'user_'.get_the_author_meta('ID') ) ?>" target="_blank"><?php the_field( 'company_name', 'user_'.get_the_author_meta('ID') ) ?></a> </div>
        </header>
        <div class="uk-comment-body">
        <?php echo wpautop( get_the_author_meta('description') ); ?>
        </div>
      </aside>

      <aside class="uk-grid uk-grid-match uk-grid-small related-articles" data-uk-margin data-uk-grid-match>
        <?php global $post;

        $terms = get_the_terms( get_the_ID(), 'article_category' );
        if ( $terms && ! is_wp_error( $terms ) ) :
            $xchange_arr = array();

            foreach ( $terms as $term ) {
                $post_count = $term->count;
                $xchange_arr[] = $term->name;
            }

            $xchange_cat = join( ", ", $xchange_arr );
            $xchange_cat = strtolower ( str_replace("-", " ", $xchange_cat) );
        endif;

        if ( $post_count < 1 ) {
          $articles = [
            'post_type' => ['exchange_articles'],
            'post__not_in' => [ $post->ID ],
            'no_found_rows'  => true,
            'posts_per_page' => 3,
            'orderby' => 'rand',
            'order' => 'ASC',
            'tax_query' => [ [ 'taxonomy' => 'article_category', 'field' => 'slug', 'terms' => $xchange_cat ] ]
          ];
        } else {
          $articles = [
            'post_type' => ['exchange_articles'],
            'post__not_in' => [ $post->ID ],
            'no_found_rows'  => true,
            'posts_per_page' => 3,
            'orderby' => 'rand',
            'order' => 'ASC',
          ];
        }

        query_posts( $articles ); ?>
        <div class="uk-width-medium-1-1 uk-margin-bottom">
          <?php if ( $post_count > 1 ) { ?>
          <h3>You Might Be Interested in These Related Articles</h3>
          <?php } else { ?>
          <h3>You Might Be Interested in These Related Articles</h3>
          <?php } ?>
        </div>
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="uk-width-medium-1-3">
          <div class="uk-panel uk-panel-box">
            <div class="uk-panel-teaser">
              <?php $featured = get_post_thumbnail_id();
              echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
              echo wp_get_attachment_image( $featured, [ 1280, 720, true ] );
              echo '</a>'; ?>
            </div>
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          </div>
        </div>
        <?php endwhile;
        wp_reset_query(); ?>
      </aside>

      <hr>

      <footer class="uk-text-small uk-text-justify uk-margin-top">
        <?php the_field( 'article_footer' ); ?>
      </footer>

    </div>
  </section>

</main>
