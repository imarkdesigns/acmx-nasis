<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ 

$post_sidebar = new WP_Query([ 'post_type' => 'page', 'page_id' => 1279 ]);

if ( $_COOKIE['backLink'] == 'true' ) { ?>
<div class="uk-navbar _backlinks">
    <div class="uk-container uk-container-large">
        <div class="uk-navbar-flip">
            <i class="uk-icon-long-arrow-left"></i> <a href="https://www.nasassets.com/" class="backLink"> Back to NASASSETS.Com </a>
        </div>
    </div>
</div>
<?php } ?>

<?php get_template_part( _menu ); ?>

<main class="main " role="main">

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

      <article class="uk-article">
        <h2><?php the_title(); ?></h2>
        <?php the_field('content'); ?>
      </article>
    
      <aside class="uk-grid uk-grid-match uk-grid-small uk-margin-large-top related-articles" data-uk-margin data-uk-grid-match>
        <div class="uk-width-medium-1-1 uk-margin-bottom">
          <h3>You Might Be Interested in These Related Articles</h3>
        </div>
        <?php $articles = [ 'post_type' => ['exchange_articles'], 'posts_per_page' => 3, 'orderby' => 'rand', 'order' => 'ASC' ];
        query_posts( $articles ); 

        while ( have_posts() ) : the_post(); ?>
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
        <?php endwhile; wp_reset_query(); ?>
      </aside>

      <hr class="uk-divider-icon">

      <aside class="uk-overlay uk-margin-top uk-border-rounded">
        <img src="<?php echo _uri.'/assets/images/1031-exchange-download.jpg'; ?>" alt="">
        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-right uk-flex-middle">
          <article>
            <img src="<?php echo _uri.'/assets/images/book-cover-1031EIG.jpg'; ?>" alt="">
            <h3>Download Free - 1031: A Guide Through the Tax Deferred Real Estate Investment Process.</h3>
            <a href="<?php echo __(site_url('1031-exchange-information?q=guide#NASISEIG')); ?>" class="uk-button">Download Free Guide Here</a>
          </article>
        </figcaption>
      </aside>

    </div>
  </section>

</main>

<?php
$post_colophon = new WP_Query([ 'post_type' => 'page', 'page_id' => 1290 ]);

while ( $post_colophon->have_posts() ) : $post_colophon->the_post();

  get_template_part( _router, 'colophon' );

endwhile;

wp_reset_postdata();