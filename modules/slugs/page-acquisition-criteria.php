<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">

  <section id="section-acquisition-criteria" class="uk-block">
    <div class="uk-container uk-container-small">

      <?php $lead_paragraph = get_field('lead_paragraph'); ?>
      <article class="uk-article">
        <?php if (  !empty($lead_paragraph) ) : ?>
        <p class="uk-article-lead"><?php the_field('lead_paragraph'); ?></p>
        <hr class="uk-divider-icon" role="presentation">
        <?php endif; ?>
        <?php the_field('content'); ?>
      </article>

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