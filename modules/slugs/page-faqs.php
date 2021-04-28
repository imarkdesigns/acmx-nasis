<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<nav class="uk-navbar local-nav uk-visible-large">
  <div class="uk-container">
    <div class="uk-navbar-flip">
      <ul class="uk-navbar-nav">
        <li><a href="<?php echo __(site_url('1031-exchange-information')); ?>">1031 Exchange Information</a></li>
        <li><a href="<?php echo __(site_url('webinar')); ?>">Webinars</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information#TaxRates')); ?>">Tax Rates by State</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/1031-exchange-articles')); ?>">Real Estate investment Articles</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information#EIG')); ?>">Download 1031 Guide</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/glossary')); ?>">Glossary</a></li>
      </ul>
    </div>
  </div>
</nav>

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