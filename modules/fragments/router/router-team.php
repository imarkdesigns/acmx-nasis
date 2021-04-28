<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ 

$team_list  = new WP_Query([ 'post_type' => ['nasis_team'], 'orderby' => 'rand', 'posts_per_page' => -1 ]);
$team_title = new WP_Query([ 'post_type' => ['page'], 'pagename' => 'team', 'posts_per_page' => 1 ]);
?>

<aside id="nextrouter" class="uk-block __team">
  <div class="uk-container uk-container-large">
    
    <?php while ( $team_title->have_posts() ) : $team_title->the_post(); ?>
    <h4 class="uk-heading-line"> <span><?php the_field('post_random_team_title'); ?></span> </h4>
    <?php endwhile; wp_reset_query(); ?>
    
    <div class="uk-slidenav-position" data-uk-slider="{ infinite: true }">
      <div class="uk-slider-container">
        <ul class="uk-slider uk-grid uk-grid-small uk-grid-width-small-1-3 uk-grid-width-medium-1-4 uk-grid-width-xlarge-1-6">
        <?php while ( $team_list->have_posts() ) : $team_list->the_post(); ?>
        <?php $featured_image = get_field('featured_profile_photo'); ?>
          <li>
            <figure class="uk-overlay uk-overlay-hover">
              <img src="<?php echo $featured_image['url']; ?>" alt="<?php the_title(); ?>">
              <figcaption class="uk-overlay-panel uk-overlay-fade uk-overlay-background uk-flex uk-flex-bottom uk-flex-center">
                <?php the_title(); ?>
              </figcaption>
              <a href="<?php the_permalink(); ?>" class="uk-position-cover"></a>
            </figure>
          </li>
        <?php endwhile; wp_reset_query(); ?>
        </ul>
      </div>
      <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
      <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>      
    </div>
    
  </div>
</aside>