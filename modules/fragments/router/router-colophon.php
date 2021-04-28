<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<aside id="nextrouter" class="uk-block">
<?php while ( have_rows( 'colophon_type' ) ) : the_row(); ?>
<?php $bg_colophon = get_sub_field('colophon_background'); ?>
  <figure class="uk-overlay">
    <img src="<?php echo $bg_colophon['url']; ?>" alt="<?php echo (!empty($bg_colophon['alt'])) ? $bg_colophon['alt'] : $bg_colophon['title']; ?>">
    <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-middle">
      <div class="uk-container uk-container-small">
        <?php the_sub_field('colophon_caption'); ?>
      </div>
    </figcaption>
  </figure>
<?php endwhile; ?>
</aside>