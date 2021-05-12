<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ 

$firstname = $_GET['recipient'];
$firstname = explode(" ", $firstname); ?>

<nav class="uk-navbar local-nav uk-visible-large">
  <div class="uk-container">
    <div class="uk-navbar-flip">
      <ul class="uk-navbar-nav">
        <li><a href="<?php echo __(site_url('webinar')); ?>">Webinars</a></li>
        <li><a href="#TaxRates" data-uk-smooth-scroll="{offset: 70}">Tax Rates by State</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/1031-exchange-articles')); ?>">Real Estate investment Articles</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/faqs')); ?>">FAQ’s</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information#EIG')); ?>" data-uk-smooth-scroll="{offset: 70}">Download 1031 Guide</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/glossary')); ?>">Glossary</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="main" role="main">

<?php
  // If page is NOT password protected
  if ( ! post_password_required() ) : 

    $webinar = [ 'post_type' => ['webinar_event'], 'posts_per_page' => -1, 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'ASC' ];
    query_posts( $webinar );
  ?>

  <section class="uk-block section-webinar">
    <div class="uk-container">
      
      <?php the_field('introduction_content'); ?>

      <div class="uk-grid uk-grid-match" data-uk-grid-margin>

        <div class="uk-width-large-2-3">
          <?php if ( have_posts() ) : ?>
          <div class="uk-article">
            <?php

            $i = 0;
            while ( have_posts() ) : the_post();
            $i++;
            
            // if ( $wp_query->post_count >= 1 ) {
                
            //     if ( $i != "1" ) {
            //         echo '<hr class="uk-margin-large">';
            //     }
                
            // }

            while ( have_rows('webinar_schedule') ) : the_row();

              $wdate = get_sub_field('date');
              $st_gmt = date_create($wdate);
              $webinar_date = date_format($st_gmt, 'Ymd');
              
              // for scrolldown id
              $webinarSID = date_format($st_gmt, 'M');

            endwhile;

            $date_now = date("Ymd");
            

            if ($date_now > $webinar_date ) {
              $hidden = 'uk-hidden';
            } else {
              $hidden = '';
            } ?>
            <div id="webinar<?php echo $webinarSID; ?>" class="uk-panel uk-panel-box <?php echo $hidden; ?>">
              <div class="uk-panel-badge uk-badge"><?php the_field('webinar_badge'); ?></div>
              <h3 class="uk-panel-title"><?php the_title(); ?></h3>
              <dl>
                <dt>Hosted By:</dt>
                <?php while ( have_rows('webinar_host') ) : the_row(); ?>
                <dd>
                  <?php $avatar = get_sub_field('host_avatar');
                  if ( get_sub_field('host_avatar') ) :
                    echo wp_get_attachment_image( $avatar['id'], [ 54, 54, true], '', [ 'class' => 'avatar uk-border-circle' ] );
                  else : ?>
                    <img src="<?php echo 'https://secure.gravatar.com/avatar/8f9ea0d48a2c16f76ae5903c422381aa?s=54&d=mm&f=y&r=g'; ?>" class="avatar uk-border-circle" alt="">
                  <?php endif; ?>
                  <p><?php the_sub_field('host_name') ?>, <span><?php the_sub_field('host_position'); ?></span>
                  <small><?php the_sub_field('host_company'); ?></small></p>
                </dd>
                <?php endwhile; ?>
                <dt>Special Guest Presenter:</dt>
                <?php while ( have_rows('webinar_presenter') ) : the_row(); ?>
                <dd>
                  <?php $avatar = get_sub_field('presenter_avatar');
                  if ( get_sub_field('presenter_avatar') ) :
                    echo wp_get_attachment_image( $avatar['id'], [ 54, 54, true], '', [ 'class' => 'avatar uk-border-circle' ] );
                  else : ?>
                    <img src="<?php echo 'https://secure.gravatar.com/avatar/8f9ea0d48a2c16f76ae5903c422381aa?s=54&d=mm&f=y&r=g'; ?>" class="avatar uk-border-circle" alt="">
                  <?php endif; ?>
                  <p><?php the_sub_field('presenter_name') ?><?php echo ( !empty(get_sub_field('presenter_position')) ) ? ', ' : ''; ?><span><?php the_sub_field('presenter_position'); ?></span>
                  <small><?php the_sub_field('presenter_company'); ?></small></p>
                </dd>
                <?php endwhile; ?>
              </dl>

              <time>
                <?php while ( have_rows('webinar_schedule') ) : the_row();
                  $wdate = get_sub_field('date');
                  $stime = get_sub_field('start_time');
                  $etime = get_sub_field('end_time');
                ?>
                <?php the_sub_field('date'); ?> <br>
                <?php the_sub_field('start_time') ?> - <?php the_sub_field('end_time') ?> PST.
                <?php endwhile;

                while ( have_rows('webinar_calendar') ) : the_row();
                  $aTitle = get_sub_field('add_title');
                  $aURL = get_sub_field('add_url');
                  $aLocation = get_sub_field('add_location');
                  $aDescription = get_sub_field('add_description');
                endwhile;

                $st_gmt = date_create($wdate .' '. $stime);
                $st = date_format($st_gmt, 'Ymd\THis');

                $et_gmt = date_create($wdate .' '. $etime);
                $et = date_format($et_gmt, 'Ymd\THis');
                ?>
                <br>
                <form method="post" action="<?php echo esc_html( site_url( '/nasis-ics.php' ) ); ?>" target="_blank">
                  <input type="hidden" name="date_start" value="<?php echo $st; ?>">
                  <input type="hidden" name="date_end" value="<?php echo $et; ?>">
                  <input type="hidden" name="location" value="<?php echo $aLocation; ?>">
                  <input type="hidden" name="description" value="<?php echo $aDescription; ?>">
                  <input type="hidden" name="summary" value="<?php echo ( !empty($aTitle) ) ? $aTitle : get_the_title(); ?>">
                  <input type="hidden" name="url" value="<?php echo $aURL; ?>">
                  <div class="uk-button-group">
                    <a href="#webinar-form" class="uk-button uk-hidden-large" data-uk-smooth-scroll="{offset: 70}">Register</a>
                    <input type="submit" name="add2calendar" class="uk-button uk-button-primary" value="Add to Calendar">
                  </div>
                </form>
                
              </time>

              <?php the_field('topic_discussion'); ?>
            </div>
            <?php endwhile; wp_reset_query(); ?>
          </div>
          <?php else : ?>
          <div class="uk-article">
            <h1>No Webinar Schedule</h1>
          </div>
          <?php endif; ?>
        </div>
        
        <div id="webinar-form" class="uk-width-large-1-3">
          <div>
      			<?php if ( !empty( get_field('presentation_slides')) ) : ?>
      			<div class="uk-panel uk-panel-box uk-panel-box-secondary uk-text-center uk-margin-bottom">
      				<p><small>click here to view</small> Presentation Slides</p>
      				<a href="#webinar-slider" class="uk-position-cover" data-uk-modal="{center:true}"></a>
      			</div>
      			<?php endif; ?>
			
			<?php if ( get_field('activate_regform') ) : ?>
            <div class="uk-panel uk-panel-box" data-uk-sticky="{top:60,boundary:true}">
              <?php echo do_shortcode( '[wpforms id="2790" title="true" description="false"]' ); ?>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>
  </section>

  <section id="webinarArchives" class="uk-block uk-block-muted section-webinar">
    <div class="uk-container">
    
      <h2>Past Real Estate Investing Webinars</h2>

      <div class="uk-grid uk-grid-match uk-grid-width-1-2 uk-grid-width-medium-1-3" data-uk-grid-margin>
        <?php $webinar_archive = [ 'post_type' => ['webinar_event'], 'posts_per_page' => -1, 'post_status' => 'publish', 'orderby' => 'menu_order', 'order' => 'DESC' ];
        query_posts( $webinar_archive );

        $vid = 0;
        while ( have_posts() ) : the_post(); 
        $vid++;

        if ( empty(get_field('webinar_youtube_url')) ) {
          $hidden = 'uk-hidden';
        } else {
          $hidden = '';
        }

        ?>
        <div class="<?php echo $hidden; ?>">
          <?php echo do_shortcode( '[wp-video-popup id="webinarVideo'.$vid.'" hide-related="1" video="'.get_field('webinar_youtube_url').'"]' ); ?>
          <div class="uk-panel uk-panel-box _archives">
            <div class="uk-panel-teaser">
              <a href="#" class="wp-video-popup webinarVideo<?php echo $vid; ?>"></a>
              <?php $bg_cover = get_field( 'webinar_bg_cover' );
	              
	          if ( get_field( 'webinar_bg_cover' ) ) :
	          	echo wp_get_attachment_image( $bg_cover['id'], [ 640, 360, true ] );
			  else : ?>
              <img src="<?php echo _uri.'/assets/images/img-bg-webinar.jpg'; ?>" alt="NASIS Webinar Cover">
              <?php endif; ?>
            </div>
            <?php while ( have_rows('webinar_schedule') ) : the_row();

              echo '<small class="uk-text-muted">'. get_sub_field('date') .'</small>';

            endwhile; ?>
            <h4>
              <a href="#" class="wp-video-popup webinarVideo<?php echo $vid; ?>">
                <?php the_title(); ?>
              </a>
            </h4>
          </div>
          <figure class="uk-overlay uk-margin-bottom uk-hidden">
			<img src="<?php echo _uri.'/assets/images/img-bg-webinar.jpg'; ?>" alt="NASIS Webinar Cover">
            <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle uk-text-center">
              <div>
                  <img src="<?php echo _uri.'/assets/images/youtube-play.svg'; ?>" width="64" height="64" alt="YT Play Button">
                  <h4><small>Watch our Previous Webinar</small></h4>
              </div>
            </figcaption>
            </a>
          </figure>
        </div>
        <?php endwhile; 
        wp_reset_query(); ?>
      </div>


    </div>
  </section>

<?php else : ?>

  <section id="Protected-Page" class="uk-block uk-block-large">
    <div class="uk-container uk-container-small uk-flex uk-flex-middle uk-flex-center">
      <article class="uk-article">
      <?php
        // Fall back to standard content with password form
        the_content();
      ?>
      </article>
    </div>
  </section>

<?php endif;
  // End password protection ?>
</main>

<div id="webinar-slider" class="uk-modal">
	<div class="uk-modal-dialog uk-modal-dialog-large">
		<button type="button" class="uk-modal-close uk-close"></button>
		<div class="uk-modal-header"> Presentation Slides </div>

		<div class="uk-slidenav-position" data-uk-slideshow="height: 720">
			<?php $images = get_field('presentation_slides'); ?>
		    <ul class="uk-slideshow">
		    	<?php foreach ( $images as $image_id ) : ?>
		        <li><?php echo wp_get_attachment_image( $image_id['id'], [ 1280, 720 ] ); ?></li>
		        <?php endforeach; ?>
		    </ul>
		    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slideshow-item="previous"></a>
		    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slideshow-item="next"></a>
		</div>
	</div>
</div>

<div id="response" class="uk-modal setBanner">
    <div class="uk-modal-dialog">
      <button type="button" class="uk-modal-close uk-close"></button>
      <div class="uk-modal-header"> Thank you for downloading 1031 Exchange Guide </div>
      <div class="uk-panel">
        <h3 class="uk-panel-title"> Thank You, <?php echo $firstname[0]; ?>. </h3>
        <p>Whether you are an investor unfamiliar with the process or have extensive experience with tax-deferred investments, we hope the following guide serves as a valuable educational and reference tool for you.</p>
        <p>Please feel free to reach out to us with any questions you may have or suggestions on how we can improve upon this guide and our website.</p>
        <p>Karen E. Kennedy <br> President & Founder <br> NAS Investment Solutions, LLC.</p>
      </div>
    </div>
</div>

<div id="evaluation" class="uk-modal setEvaluation">
    <div class="uk-modal-dialog">
      <button type="button" class="uk-modal-close uk-close"></button>
      <div class="uk-modal-header"> How did we do?<br>Please give us your comments. </div>
      <div class="uk-panel">
        <?php echo do_shortcode( '[wpforms id="2374" title="false" description="false"]' ); ?>
      </div>
    </div>
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