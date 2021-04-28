<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">

<?php
  // If page is NOT password protected
  if ( ! post_password_required() ) : ?>

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

      <hr class="uk-divider-icon uk-margin">

      <aside class="uk-overlay uk-margin-top uk-border-rounded --books-banner">
        <div class="uk-slidenav-position" data-uk-slideshow="{autoplay: true}">
            <ul class="uk-slideshow">
                <li>
                  <figure>
                    <img src="<?php echo _uri.'/assets/images/nas-guide.png'; ?>" alt="1031 Exchange Investments Guide">
                    <figcaption>
                      <h4><span>Download Free - 1031:</span> A Guide Through the Tax Deferred Real Estate Investment Process</h4>
                      <a href="<?php echo __(site_url('1031-exchange-information#EIG')); ?>" class="uk-button uk-button-secondary __download">Download Free Guide Here</a>
                    </figcaption>
                  </figure>
                </li>
                <li>
                  <figure>
                    <img src="<?php echo _uri.'/assets/images/nas-booklet.png'; ?>" alt="Real Estate Investing with the Lessons of 2020">
                    <figcaption>
                      <h4><span>Free 36-Page Booklet</span> Real Estate Investing with the Lessons of 2020: A Collection of 10 timely Articles</h4>
                      <a href="<?php echo __(site_url('1031-exchange-information?tab=booklet#EIG')); ?>" class="uk-button uk-button-secondary __download">Download Free Booklet</a>
                    </figcaption>
                  </figure>
                </li>
            </ul>
            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
            <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
            <ul class="uk-dotnav uk-dotnav-contrast uk-position-bottom uk-flex-center">
                <li data-uk-slideshow-item="0"><a href=""></a></li>
                <li data-uk-slideshow-item="1"><a href=""></a></li>
            </ul>
        </div>
      </aside>
      
      <?php /*
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
      */ ?>

    </div>
  </section>

<?php else : ?>

  <section id="Protected-Page" class="uk-block uk-block-large">
    <div class="uk-container uk-container-small uk-flex uk-flex-middle uk-flex-center">
      <article class="uk-article">
      <?php
        // Fall back to standard content with password form
        the_content();
      ?>
      </article>
    </div>
  </section>

<?php endif;
  // End password protection ?>

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