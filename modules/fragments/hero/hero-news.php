<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$post_header = new WP_Query([ 'post_type' => 'page', 'page_id' => 788, 'post__in' => [ 788 ] ]);

while ( $post_header->have_posts() ) : $post_header->the_post();
$hero_bg = get_field('header_background'); ?>

<?php if ( $_COOKIE['backLink'] == 'true' ) { ?>
<div class="uk-navbar _backlinks">
    <div class="uk-container uk-container-large">
        <div class="uk-navbar-flip">
            <i class="uk-icon-long-arrow-left"></i> <a href="https://www.nasassets.com/" class="backLink"> Back to NASASSETS.Com </a>
        </div>
    </div>
</div>
<?php } ?>

<header class="hero-page">
  <?php get_template_part( _menu ); ?>
  <div class="section-page-wrapper">

    <figure class="uk-overlay">
    <?php echo wp_get_attachment_image( $hero_bg['id'], 'full' );
      /*
      if ( $hero_bg ) :
        echo '<img src="'.$hero_bg['url'].'" alt="'.get_the_title().'">';
      else :
        echo '<img src="https://nasassets.com/nasinvestmentsolutions/wp-content/uploads/2017/08/background-image.jpg" alt="'.get_the_title().'">';
      endif;
      */
      ?>
      <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-bottom">
        <div class="uk-container uk-container-small">
          <h1 class="uk-heading-large"><?php the_title(); ?></h1>
        </div>
      </figcaption>
    </figure>

  </div>
</header>
<?php endwhile;

wp_reset_postdata();