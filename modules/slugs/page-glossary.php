<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ 

$post_sidebar = new WP_Query([ 'post_type' => 'page', 'page_id' => 1279 ]); ?>

<nav class="uk-navbar local-nav uk-visible-large">
  <div class="uk-container">
    <div class="uk-navbar-flip">
      <ul class="uk-navbar-nav">
        <li><a href="<?php echo __(site_url('1031-exchange-information')); ?>">1031 Exchange Information</a></li>
        <li><a href="<?php echo __(site_url('webinar')); ?>">Webinars</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information#TaxRates')); ?>">Tax Rates by State</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/1031-exchange-articles')); ?>">Real Estate investment Articles</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/faqs')); ?>">FAQ’s</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information?q=guide#NASISEIG')); ?>">Download 1031 Guide</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="main" role="main">

  <section class="uk-block section-glossary-single">
  	<div class="uk-container">

        <nav class="glossary-wrapper">
          <?php
          $taxonomy = 'topic_category';
          $terms = get_terms($taxonomy); // Get all terms of a taxonomy

          if ( $terms && !is_wp_error( $terms ) ) : ?>
              <ul class="list-inline uk-list menu">
                  <li data-id="all" class="selected"><a href="<?php echo __(site_url('1031-exchange-information/glossary'));?>">All</a></li>
                  <?php foreach ( $terms as $term ) { ?>
                      <li><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>"><?php echo $term->name; ?></a></li>
                  <?php } ?>
              </ul>
          <?php endif;?>
        </nav>
        <!-- glossary-wrapper -->

        <div class="uk-grid" data-uk-grid-margin>
          
          <div class="uk-width-medium-2-3">
            <div>
              <?php 
              // $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
              // $glossaries = new WP_Query([ 'post_type' => ['glossary'], 'posts_per_page' => 5, 'paged' => $paged, 'orderby' => 'title', 'order' => 'ASC' ]);

              $temp = $wp_query; 
              $wp_query = null; 
              $wp_query = new WP_Query(); 
              $wp_query->query('showposts=10&post_type=glossary&orderby=title&order=ASC'.'&paged='.$paged); 

              while ($wp_query->have_posts()) : $wp_query->the_post();  ?>
              <article class="uk-article">
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php echo custom_glossary();
                $word_count = str_word_count( strip_tags( get_field('content') ) );

                if ($word_count > 39) {
                    echo '<p><a href="'.get_permalink().'">Read More</a></p>';
                } ?>
              </article>
              <?php endwhile; ?>
            </div>
            <!-- end of div -->

            <div class="uk-grid uk-grid-width-medium-1-2 uk-margin-large-top pagination">
              <div class="prev-more-link">
                <?php previous_posts_link('Previous Glossary of Terms') ?>
              </div>
              <div class="next-more-link uk-text-right">
                <?php next_posts_link('Next Glossary of Terms') ?>
              </div>
            </div>
            <?php 
              $wp_query = null; 
              $wp_query = $temp;  // Reset
            ?>

          </div>

          <div class="uk-width-medium-1-3">
            <div class="at-glance">
              <?php while ( $post_sidebar->have_posts() ) : $post_sidebar->the_post(); ?>
              <?php the_field( 'at_a_glance' ); ?>
            <?php endwhile; wp_reset_postdata(); ?>
            </div>            
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

?>