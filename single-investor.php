<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$featured_image = get_field('featured_property_image'); ?>

<main class="main" role="main">
  
  <section id="section-investments" class="uk-block">
    <div class="uk-container uk-container-large">
      
      <ul class="uk-grid uk-grid-small" data-uk-grid-margin data-uk-grid-match>    
        <li class="uk-width-1-1 uk-flex uk-flex-center">
          
          <figure class="uk-overlay">
            <div class="object-fit-cover">
              <img src="<?php echo $featured_image['url'] ?>" alt="<?php echo (!empty($featured_image['alt'])) ? $featured_image['alt'] : $featured_image['title'] ; ?>">
            </div>
            
            <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-bottom uk-flex-center">
              <div class="section-copy uk-text-center">
                <?php the_field('property_description'); ?>
                
                <div class="uk-button-group">
                  <?php the_field('optin_to_download'); ?>
                </div>
              </div>
            </figcaption>
            
          </figure>
         
        </li>
      </ul>
      
    </div>
  </section>

</main>

<?php 
  $router_page = new WP_Query([ 'post_type' => ['page'], 'pagename' => 'available-investments', 'posts_per_page' => 1 ]);
  
  while ( $router_page->have_posts() ) : $router_page->the_post();
    get_template_part( _router, 'colophon' );
  endwhile; wp_reset_query();
?>