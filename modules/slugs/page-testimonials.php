<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<?php if ( get_field('lead_paragraph') ) : ?>
<section id="section-team" class="uk-block">
  <div class="uk-container uk-container-small">
    <article class="uk-articl uk-text-center">
      <p class="uk-article-lead"><?php the_field('lead_paragraph'); ?></p>
    </article>
  </div>
</section>
<?php endif; ?>

<div id="-quotes">
  <section id="section-testimonials" class="uk-block uk-block-muted">

    <div class="uk-container uk-container-small">
      <?php while ( have_rows( 'testimonials_lists' ) ) : the_row(); 
      $photo = get_sub_field('client_photo'); ?>
      <div class="uk-panel uk-panel-box uk-panel-box-secondary">
        <blockquote>
          <?php if ( $photo ) : ?>
          <h4 class="uk-flex uk-flex-middle">
            <div><strong><?php the_sub_field('client_name'); ?></strong> <small><?php the_sub_field('client_details'); ?></small></div>
            <img src="<?php echo $photo['url']; ?>" width="72" height="72" class="uk-thumbnail uk-border-circle" alt="<?php echo $photo['alt']; ?>">
          </h4>
          <?php else : ?>
            <h4><strong><?php the_sub_field('client_name'); ?></strong> <small><?php the_sub_field('client_details'); ?></small></h4>
          <?php endif; ?>
          <p><?php the_sub_field('testimonial'); ?></p>
        </blockquote>
      </div>
      <?php endwhile; ?>
    </div>

  </section>
</div>


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