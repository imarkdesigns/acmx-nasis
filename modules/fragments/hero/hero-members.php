<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$hero_bg = get_field('header_background'); ?>

<?php if ( $_COOKIE['backLink'] == 'true' ) { ?>
<div class="uk-navbar _backlinks">
    <div class="uk-container uk-container-large">
        <div class="uk-navbar-flip">
            <i class="uk-icon-long-arrow-left"></i> <a href="https://www.nasassets.com/" class="backLink"> Back to NASASSETS.Com </a>
        </div>
    </div>
</div>
<?php } ?>

<header class="hero-page">
  <?php get_template_part( _menu ); ?>
  <div class="section-page-wrapper">

    <figure class="uk-overlay">
    <?php
      if ( !empty($hero_bg) ) :
        echo '<img src="'.$hero_bg['url'].'" alt="'.get_the_title().'">';
      else :
        echo '<img src="https://placem.at/places?w=2880&h=1800&txt=0&random=1" alt="'.get_the_title().'">';
      endif;
    ?>
    </figure>

  </div>
</header>