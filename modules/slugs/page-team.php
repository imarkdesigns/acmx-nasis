<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<section id="section-team" class="uk-block">
  <div class="uk-container uk-container-small">
    <article class="uk-article">
      <p class="uk-article-lead"><?php the_field('lead_paragraph'); ?></p>
    </article>
  </div>
</section>

<section id="section-team-list" class="uk-block uk-block-muted">
  <div class="uk-container uk-container-large">

    <?php $team_list = new WP_Query([ 'post_type' => ['nasis_team'], 'order' => 'ASC', 'posts_per_page' => -1 ]); ?>
    <ul class="uk-grid uk-grid-width-small-1-2 uk-grid-width-medium-1-3 uk-grid-width-large-1-4 uk-grid-medium  uk-flex uk-flex-center" data-uk-grid-margin>
    <?php while ( $team_list->have_posts() ) : $team_list->the_post(); ?>
    <?php
      while ( have_rows('profile_information') ) : the_row();
        $name     = get_sub_field('profile_name');
        $position = get_sub_field('company_position');
      endwhile;

      $featured_image = get_field('featured_profile_photo');
      ?>
      <li>
        <div class="uk-panel">
          <figure class="uk-overlay uk-overlay-hover">
            <img src="<?php echo $featured_image['url']; ?>" alt="<?php the_title(); ?>">
            <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-fade uk-flex uk-flex-bottom">
              <div class="section-copy uk-overlay-slide-bottom">
                <h3><?php echo $name; ?></h3>
                <p><?php echo $position; ?></p>

                <a href="<?php the_permalink(); ?>" class="uk-icon-button uk-icon-arrow-circle-right"></a>
              </div>
            </figcaption>
          </figure>
        </div>
      </li>
    <?php endwhile; wp_reset_query(); ?>
    </ul>

  </div>
</section>

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