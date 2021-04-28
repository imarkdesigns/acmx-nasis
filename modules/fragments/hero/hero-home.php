<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$slides = get_field('header_gallery'); 

if ( wp_is_mobile() ) {
  // return empty
} else { ?>
<div class="uk-hidden-small EIG1031">
  <a href="#" class="uk-close"></a>

  <div class="uk-container uk-container-large">
    <div class="uk-grid uk-flex uk-flex-middle" data-uk-grid-match>
      <div class="uk-width-medium-1-2 cover-guide">
        <figure class="uk-flex uk-flex-middle">
          <img src="<?php echo _uri.'/assets/images/book-cover-1031EIG.jpg'; ?>" alt="1031 Exchange Info Guide">
          <figcaption>
            <h4><span>Download Free 28-Page Booklet - 1031:</span> A Guide Through the Tax Deferred Real Estate Investment Process.</h4>
            <a href="<?php echo __(site_url( '/1031-exchange-information?q=guide#NASISEIG' )); ?>">Download Free Guide Here</a>
          </figcaption>
        </figure>
      </div>
      <div class="uk-width-medium-1-2 cover-booklet">
        <figure class="uk-flex uk-flex-middle">
          <img src="<?php echo _uri.'/assets/images/book-cover-booklet.jpg'; ?>" alt="Free 36-Page Booklet Real Estate Investing with the Lessons of 2020">
          <figcaption>
              <h4><span>Download Free 36-Page:</span> Real Estate Investing with the Lessons of 2020</h4>
              <a href="<?php echo __(site_url( '/1031-exchange-information?q=booklet#NASISEIG' )); ?>">Download Free Booklet Here</a>
          </figcaption>
        </figure>
      </div>
    </div>
  </div>

</div>
<?php } ?>

<?php if ( $_COOKIE['backLink'] == 'true' ) { ?>
<div class="uk-navbar _backlinks">
    <div class="uk-container uk-container-large">
        <div class="uk-navbar-flip">
            <i class="uk-icon-long-arrow-left"></i> <a href="https://www.nasassets.com/" class="backLink"> Back to NASASSETS.Com </a>
        </div>
    </div>
</div>
<?php } ?>

<header class="hero-gallery">
  <?php get_template_part( _menu ); ?>

  <?php foreach ( $slides as $slide ) : ?>
  <figure class="uk-overlay">
    <?php /* <img src="<?php echo $slide['url']; ?>" alt="<?php echo (!empty($slide['alt'])) ? $slide['alt'] : $slide['title']; ?>"> */ ?>
    <?php echo wp_get_attachment_image( $slide['id'], 'full' ); ?>
    <canvas width="1920" height="800"></canvas>
    <div class="uk-overlay-panel uk-overlay-background">
      <div class="uk-container uk-container-large uk-flex uk-flex-middle uk-height-1-1">
        <article>
          <?php the_field('header_overlay'); ?>
        </article>
      </div>
    </div>
  </figure>
  <?php endforeach; ?>

</header>