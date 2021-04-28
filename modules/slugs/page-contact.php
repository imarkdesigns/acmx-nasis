<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$request = $_GET['request'];

$property = $_GET['property'];
$_GET['property'] = str_replace("-", " ", $property);

// If Reference Contact is Empty
if ( $_GET['cid'] == 'mark' ) {
  $_GET['cid'] = 'Mark Paul';
} else {
  $_GET['cid'] = 'Karen E. Kennedy';
}
?>

<main class="main" role="main" data-reference="<?php echo $_SESSION['reference']; ?>">

  <section id="section-contact" class="uk-block">
    <div class="uk-container uk-container-small">

    <?php if ( $request != 'true' ) : ?>
      <ul class="uk-grid uk-grid-width-medium-1-2 uk-text-center" data-uk-grid-margin data-uk-grid-match>
      <?php while ( have_rows('contact_details') ) : the_row(); ?>
      <?php
        $icon_building = get_sub_field('corporate_address_icon');
        $icon_phone    = get_sub_field('phone_fax_number_icon');
        ?>
        <li>
          <div class="uk-panel">
            <img src="<?php echo $icon_building['url']; ?>" alt="Corporate Address">
            <h4>Corporate Address</h4>
            <p><?php the_sub_field('corporate_address'); ?></p>
          </div>
        </li>
        <li>
          <div class="uk-panel">
            <img src="<?php echo $icon_phone['url']; ?>" alt="Phone & Fax Number">
            <h4>Phone &amp; Fax Number</h4>
            <p><?php the_sub_field('phone_fax_number'); ?></p>
          </div>
        </li>
      <?php endwhile; ?>
      </ul>

      <hr class="uk-divider-icon">
      <?php endif; ?>

      <figure class="uk-text-center uk-margin-large-bottom">
        <img src="<?php echo _uri.'/assets/images/icon-contact-mail.png'; ?>" alt="Send Us a Message">
      </figure>

      <?php
      if ( $request == 'true' ) :
        echo do_shortcode( '[wpforms id="403"]' );
      else :
        the_field('wpforms_shortcode_content');
      endif;
      ?>

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