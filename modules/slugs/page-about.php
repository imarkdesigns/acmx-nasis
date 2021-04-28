<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">

  <section id="section-about" class="uk-block">
    <div class="uk-container uk-container-small">

      <figure class="uk-border-circle">
        <img src="<?php echo $featured_photo['url']; ?>" alt="<?php echo (!empty($featured_photo['alt'])) ? $featured_photo['alt'] : $featured_photo['title']; ?>">
      </figure>

      <?php $lead_paragraph = get_field('lead_paragraph'); ?>
      <article class="uk-article">
        <?php if (  !empty($lead_paragraph) ) : ?>
        <p class="uk-article-lead"><?php the_field('lead_paragraph'); ?></p>
        <hr class="uk-divider-icon" role="presentation">
        <?php endif; ?>
        <?php the_field('content'); ?>
      </article>

      <figure class="uk-overlay referral-program">
        <img src="https://nasassets.com/nasinvestmentsolutions/wp-content/uploads/2018/12/Referral-Quote.jpg" alt="Refer A Friend">

        <figcaption class="uk-overlay-panel uk-overlay-background">
            <div class="referral-program-content">
                <h4>Refer a Friend, Help a Neighbor</h4>
                <p>$500 will be donated to charity when referrals become clients.</p>
            </div>
            <a href="<?php echo __(site_url('referral-program')); ?>" class="uk-button uk-button-primary uk-button-large">Click Here To Learn More</a>
        </figcaption>

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