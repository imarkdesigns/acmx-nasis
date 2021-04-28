<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ 
get_template_part( _base_header );
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

<?php # get_template_part( _menu ); ?>

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

      <div class="uk-grid"  data-uk-grid-margin>
        
        <div class="uk-width-medium-2-3">
          <div>
            <?php while ( have_posts() ) : the_post(); ?>
            <article class="uk-article">
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php echo custom_glossary();
              $word_count = str_word_count( strip_tags( get_field('content') ) );

              if ($word_count > 39) {
                  echo '<p><a href="'.get_permalink().'">Read More</a></p>';
              } ?>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
          </div>
        </div>
        <div class="uk-width-medium-1-3">
          <div class="at-glance">
            <?php while ( $post_sidebar->have_posts() ) : $post_sidebar->the_post(); ?>
            <?php the_field( 'at_a_glance' ); ?>
          <?php endwhile; wp_reset_postdata(); ?>
          </div>            
        </div>

      </div>

      <hr class="uk-divider-icon">

      <aside class="uk-overlay uk-margin-top uk-border-rounded">
        <img src="<?php echo _uri.'/assets/images/1031-exchange-download.jpg'; ?>" alt="">
        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-right uk-flex-middle">
          <article>
            <img src="<?php echo _uri.'/assets/images/book-cover-1031EIG.jpg'; ?>" alt="">
            <h3>Download Free - 1031: A Guide Through the Tax Deferred Real Estate Investment Process.</h3>
            <a href="<?php echo __(site_url('1031-exchange-information#EIG')); ?>" class="uk-button">Download Free Guide Here</a>
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

get_template_part( _base_footer );