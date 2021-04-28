<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$post_article = new WP_Query([ 'post_type' => ['post'], 'posts_per_page' => -1, 'orderby' => 'date' ]); ?>

<main class="main" role="main">

  <section id="section-about" class="uk-block">
    <div class="uk-container">

      <?php if ( $post_article->have_posts() ) : ?>

      <div class="uk-grid uk-grid-width-medium-1-2 uk-grid-small uk-grid-match" data-uk-grid-margin>
        <?php while ( $post_article->have_posts() ) : $post_article->the_post();
         $hero = get_field('news_featured_image'); ?>
        <div <?php post_class(); ?>>

          <figure class="uk-overlay">
            <?php echo wp_get_attachment_image( $hero['id'], [ 1280, 720, true ] ); ?>

            <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-bottom uk-text-center">
              <article>
                <h3><?php the_title(); ?></h3>
                <button type="button" class="uk-button uk-button-default">Read More</button>
              </article>
              <a href="<?php the_permalink(); ?>" class="uk-position-cover"></a>
            </figcaption>
          </figure>

        </div>
        <?php endwhile; ?>
      </div>

      <?php else : ?>

      <article class="uk-article uk-text-center">

        <h1 class="uk-article-title"> No Current Post Yet </h1>
        <p class="uk-article-lead"> Please check back soon! </p>

      </article>

      <?php endif; wp_reset_query(); ?>

    </div>
  </section>

</main>

<?php $news_router = new WP_Query([ 'post_type' => 'page', 'page_id' => '788', 'post__in' => [ 788 ], 'posts_per_page' => 1 ]);
  while ( $news_router->have_posts() ) : $news_router->the_post();

    get_template_part( _router, 'colophon' );

  endwhile; wp_reset_postdata();
?>