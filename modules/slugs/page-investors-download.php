<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">
  
  <section id="section-investments" class="uk-block">
    <div class="uk-container uk-container-large">
      
      <article class="uk-article uk-text-center">
        <h3 class="uk-article-title"> Investors Download is available only from Email Blast </h3>
        <p class="uk-article-lead"> Please <a href="<?php echo __(site_url( '/contact' )) ?>">contact us</a> if you are having problem viewing the download page. </p>
      </article>
      
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