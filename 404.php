<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

get_template_part( _base_header ); ?>

<main class="main" role="main">

  <section id="section-investments" class="uk-block">
    <div class="uk-container">
      
      <article class="uk-article uk-text-center">
        <h2><?php _e( 'Oops! That page can\'t be found.' ); ?></h2>
        <p><?php _e( 'It looks like nothing was found at this location. <br> Please use the top <strong>Menu</strong>' ); ?></p>
      </article>  
      
    </div>
  </section>

</main>

<?php 
  $router_page = new WP_Query([ 'post_type' => ['page'], 'pagename' => 'available-investments', 'posts_per_page' => 1 ]);
  
  while ( $router_page->have_posts() ) : $router_page->the_post();
    get_template_part( _router, 'colophon' );
  endwhile; wp_reset_query();
  
  get_template_part( _base_footer );
