<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">

  <section id="section-download-investment" class="uk-block">
    <div class="uk-container uk-container-small">
      <?php the_field( 'doifd_landing_page_shortcode' ); ?>
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