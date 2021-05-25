<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$post_header = new WP_Query([ 'post_type' => 'page', 'page_id' => 1290 ]);

while ( $post_header->have_posts() ) : $post_header->the_post();
$hero_bg = get_field('header_background');
endwhile;

wp_reset_postdata(); ?>

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
      <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-bottom" data-post="<?php echo $post->post_name; ?>">
        <div class="uk-container uk-container-small">
          <h1 class="uk-heading-large"><?php 	            
		        echo 'Glossary of Terms: ' . get_the_title(); 
          ?></h1>
        </div>
      </figcaption>
    </figure>

  </div>
</header>
