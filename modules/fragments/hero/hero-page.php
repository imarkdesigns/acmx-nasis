<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$request = $_GET['request'];

$hero_bg = get_field('header_background');

if ( $post->ID == '1031' ) {
    $class = 'referral';
}

// 1031 Exchange Information Page
if ( wp_is_mobile() ) {
  // return empty
} else {
if ( $post->ID == '1279' || $post->ID == '1282' || $post->ID == '2289' ) { ?>
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
<?php } 

} ?>

<header class="hero-page <?php echo $class; ?>">
  <?php get_template_part( _menu ); ?>
  <div class="section-page-wrapper" data-post="<?php echo $post->post_name; ?>">

    <figure class="uk-overlay">
    <?php echo wp_get_attachment_image( $hero_bg['id'], 'full' ); ?>
      <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-bottom">
        <div class="uk-container uk-container-small">
          <h1 class="uk-heading-large">
            <?php if ( $request == true ) {

              echo 'Submit Request for PPM';

            } elseif ( $hero_bg['description'] != '' ) {

              echo $hero_bg['description'];

            } else {

              the_title();

            } ?>
          </h1>
        </div>
      </figcaption>
    </figure>

  </div>

    <div class="hero-breadcrumbs">
        <div class="uk-container uk-container-expand">
            <?php echo do_shortcode( '[wpseo_breadcrumb]' ); ?>
        </div>
    </div>
</header>