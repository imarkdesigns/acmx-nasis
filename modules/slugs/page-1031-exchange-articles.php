<?php
// Include Local Navigation for 1031 Exchange Information
include( locate_template( _inc.'local-nav.php', false, true ) );

$glance = new WP_Query([ 'post_type' => 'page', 'posts_per_page' => 1, 'page_id' => 1279 ]); ?>

<main class="main" role="main">
<?php
// If page is NOT password protected
if ( ! post_password_required() ) : ?>

  <section class="uk-block section-exchange-articles">
    <div class="uk-container">
      <div id="grid-wrapper" class="uk-grid" data-uk-grid-margin>

        <?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $articles = [ 'post_type' => ['exchange_articles'], 'posts_per_page' => 5, 'paged' => $paged, 'pagination' => true, 'orderby' => 'menu_order', 'order' => 'ASC' ];
        query_posts( $articles ); ?>
        <div class="uk-width-medium-2-3">
          <?php while ( have_posts() ) : the_post(); ?>
          <article <?php post_class('uk-article grid-post'); ?> >
            <a href="<?php the_permalink(); ?>"><h1 class="uk-article-title"><?php the_title(); ?></h1></a>
            <p class="uk-article-lead"><?php the_field( 'lead_paragraph' ); ?></p>
            <figure class="uk-clearfix">
              <?php $featured = get_post_thumbnail_id();
                echo '<a href="'.get_permalink().'" title="'.get_the_title().'">';
                echo wp_get_attachment_image( $featured, 'medium', '', [ 'class' => 'uk-border-rounded uk-align-medium-left' ] );
                echo '</a>'; ?>
              <figcaption>
                <?php echo custom_field_excerpt(); ?>
                <p><a href="<?php the_permalink(); ?>">Read More</a></p>
              </figcaption>
            </figure>
          </article>
          <?php endwhile; ?>
          <div class="uk-grid uk-grid-width-medium-1-2 pagination">
            <div class="prev-more-link">
              <?php previous_posts_link( 'Previous Real Estate investment Articles' ); ?>
            </div>
            <div class="next-more-link uk-text-right">
            <?php if( get_next_posts_link() ) :
              next_posts_link( 'Next Real Estate investment Articles' );
            endif; wp_reset_query(); ?>
            </div>
          </div>
        </div>

        <div class="uk-width-medium-1-3">

          <div class="exchange-recent">

             <?php (!function_exists('dynamic_sidebar')) || !dynamic_sidebar('article_recent') ? null : null ; ?>

          </div>

          <div class="exchange-categories">
            <?php (!function_exists('dynamic_sidebar')) || !dynamic_sidebar('article_category') ? null : null ; ?>
          </div>

          <div class="exchange-tags">
            <?php (!function_exists('dynamic_sidebar')) || !dynamic_sidebar('article_tag') ? null : null ; ?>
          </div>

        </div>

      </div>
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