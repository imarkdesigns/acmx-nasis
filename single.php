<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ 

get_template_part( _base_header );

if ( ! post_password_required() ) :



    if ( $post->post_type == 'nasis_team' ) {

      get_template_part( 'single', 'team' );

    }

    else if ( $post->post_type == 'investor_overview' ) {

      get_template_part( 'single', 'investor' );
      
    }

    else if ( $post->post_type == 'nasis_investments' ) {

      get_template_part( 'single', 'landing-investment' );
      
    }

    else if ( $post->post_type == 'exchange_articles' ) {

      get_template_part( 'single', 'articles' );

      if ( $post->ID == '1798' || $post->ID == '1510' || $post->ID == '1399' ) { 
        include_once( get_template_directory() . '/modules/inc/global-investment-modal.php' );
      }
    }

    else if ( $post->post_type == 'glossary' ) {

      get_template_part( 'single', 'glossaries' );
      
    }

    else {

      get_template_part( 'single', 'news' );

    }

get_template_part( _base_footer );
else : ?>

<style>
    main {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }
</style>

<main class="main" role="main">
    <section class="uk-section uk-section-muted">
        <div class="uk-container uk-container-small uk-height-meidum uk-flex uk-flex-middle uk-flex-center uk-text-center">
            
            <article>
                <?php the_content(); ?>
            </article>

        </div>
    </section>
</main>

<?php endif;


