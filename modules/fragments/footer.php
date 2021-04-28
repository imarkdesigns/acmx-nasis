<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$footer_menu = [
  'theme_location'  => 'footer_menu',
  'menu_class'      => 'uk-subnav uk-subnav-pill uk-margin-remove',
  'container'       => '',
  'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
  'depth'           => 2
]; ?>

<footer id="GlobalFooter" class="globalfooter" role="contentinfo">
  <div class="uk-container uk-container-large">

    <div class="uk-grid uk-flex uk-flex-space-between uk-flex-middle _mailchimp">
      <div class="uk-width-large-1-1">
        <div>
          <h4 class="uk-text-uppercase uk-margin-remove">Subscribe to Property Alerts</h4>
          <p class="uk-margin-remove">Join our mailing list to be among the first to know about new investment offerings.</p>
        </div>
      </div>
      <div class="uk-width-large-1-1 uk-margin-top">
        <?php echo do_shortcode( '[wpforms id="937" title="false" description="false"]' ); ?>
        <p class="uk-text-small uk-text-muted uk-margin-remove">*An accredited investor, (a) earned income that exceeded $200,000 (or $300,000 household income) in each of the prior two years, and reasonably expects the same for the current year, OR (b) has a net worth over $1 million, either alone or together with a spouse (excluding the value of the person’s primary residence).</p>
      </div>
    </div>

    <hr>

    <div class="uk-grid uk-flex uk-flex-middle uk-flex-space-between">
      <div class="column uk-width-large-1-2">
        <ul>
          <li>&copy; Copyright <?php echo date('Y'); ?>.</li>
          <li><?php echo bloginfo(); ?>.</li>
          <li>All rights reserved.</li>
        </ul>
      </div>
      <div class="column uk-width-large-1-2 uk-visible-large">
        <nav class="gf-menu-wrapper">
          <?php wp_nav_menu( $footer_menu ); ?>
        </nav>
      </div>
    </div>
  </div>
</footer>