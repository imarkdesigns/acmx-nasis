<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">

  <section class="section-email-alert uk-flex uk-flex-middle uk-flex-column">
    <div class="uk-container uk-container-expand">
      <div class="section-copy">
        <?php the_field('overlay_content'); ?>
        <form class="uk-form">
          <button data-uk-modal="{target: '#subscription',center: true,bgclose: false}" type="button" class="uk-button uk-button-default uk-text-uppercase"><?php the_field('button_alert_label'); ?></button>
        </form>
      </div>
    </div>
    <footer>
      <p>copyright <?php echo date('Y'); ?> <br> <?php bloginfo( title ); ?></p>
    </footer>
  </section>

  <?/* Background Intro Slideshow */?>
  <?php $images = get_field('background_slideshow'); ?>
  <figure class="hero-slideshow__intro">
    <ul class="uk-slideshow" data-uk-slideshow="{autoplay: true, autoplayInterval: '5000', pauseOnHover: false}">
    <?php foreach ( $images as $image ) : ?>
      <li><img src="<?php echo $image['url'] ?>" alt="<?php echo (!empty($image['alt'])) ? $image['alt'] : $image['title'] ; ?>"></li>
    <?php endforeach; ?>
    </ul>
  </figure>

</main>

<div id="weather">weather</div>

<?/* Start Modal Control */?>

<div id="subscription" class="uk-modal">
  <div class="uk-modal-dialog uk-modal-dialog-large">
    <a class="uk-modal-close uk-close"></a>
    <div class="uk-modal-header">
      Request OnDemand Account
    </div>
    <div class="uk-modal-body">
      <?php echo do_shortcode('[wpforms id="403" title="false" description="false"]'); ?>
    </div>
  </div>
</div>

<div id="unsubscribe" class="uk-modal">
  <div class="uk-modal-dialog">
    <a class="uk-modal-close uk-close"></a>
    <h2 class="uk-modal-title">NAS Investment Solutions</h2>
    <h3>Unsubscribe</h3>
    <p>To continue unsubscribe, <a href="http://nasassets.us11.list-manage2.com/unsubscribe?u=cad31c7c15509f04446d9eb46&id=c7ece447b9" target="_blank" class="uk-link uk-text-warning">here</a> to opens new window/tab.</p>
  </div>
</div>

<?/* End Modal Control */?>
