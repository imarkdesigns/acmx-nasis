<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">

  <section id="section-map" class="uk-block">
    <div class="uk-container uk-container-small">
      <?php $lead_paragraph = get_field('lead_paragraph'); ?>
      <article class="uk-article">
        <?php if (  !empty($lead_paragraph) ) : ?>
        <p class="uk-article-lead"><?php the_field('lead_paragraph'); ?></p>
        <?php endif; ?>
      </article>
    </div>

    <div class="uk-container uk-container-expand">
      <div class="uk-alert" data-uk-alert> <?php the_field('map_text_notification'); ?> </div>
      <figure class="uk-flexx">
        <?php // the_field('wp_google_maps_shortcode_content'); 

	        echo do_shortcode('[elfsight_google_maps id="1"]');
        ?>
      </figure>
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