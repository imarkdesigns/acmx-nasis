<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ 

// Include Local Navigation for 1031 Exchange Information
include( locate_template( _inc.'local-nav.php', false, true ) );
?>

<main class="main" role="main">

  <section class="uk-block faqs-list">
  	<div class="uk-container">

  		<?php $faq = get_field( 'faq_shortcode' );
          echo do_shortcode( $faq );
      ?>
      <hr class="uk-margin">

      <div class="disclaimer">
        <?php the_field('disclaimer'); ?>
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