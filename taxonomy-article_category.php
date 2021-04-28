<?php get_template_part( _base_header ); ?>

<?php if ( $_COOKIE['backLink'] == 'true' ) { ?>
<div class="uk-navbar _backlinks">
    <div class="uk-container uk-container-large">
        <div class="uk-navbar-flip">
            <i class="uk-icon-long-arrow-left"></i> <a href="https://www.nasassets.com/" class="backLink"> Back to NASASSETS.Com </a>
        </div>
    </div>
</div>
<?php } ?>

<?php // get_template_part( _menu ); ?>

<main class="main" role="main">

    <section class="uk-block section-exchange-articles">
        <div class="uk-container">
            <div class="uk-grid" data-uk-grid-margin>

        <div class="uk-width-medium-2-3">
          <?php while ( have_posts() ) : the_post(); ?>
          <article <?php post_class('uk-article'); ?> >

            <a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>"><h1 class="uk-article-title"><?php the_title(); ?></h1></a>
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
              <?php previous_posts_link( 'View Previous 1031 Exchange Articles' ); ?>
            </div>
            <div class="next-more-link uk-text-right">
            <?php if( get_next_posts_link() ) :
              next_posts_link( 'View Next 1031 Exchange Articles' );
            endif; ?>
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

</main>



<?php
get_template_part( _router, 'team' );

get_template_part( _base_footer );