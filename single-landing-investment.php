<?php
// Mailchimp API
include ( get_template_directory() . '/modules/inc/mailchimp-api.php' );

// Download Property Brochure
/*
if ( $_GET['dpb'] == 'true' ) {
    $brochure = get_field('brochure_file');

    if ( get_field('brochure_file') ) {
        // Process download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($brochure['filename']).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize(getFullPath($brochure['url'])));
        ob_clean();
        flush(); // Flush system output buffer
        readfile(getFullPath($brochure['url']));
        exit;
    } else {
        http_response_code(404);
        exit;
    }
}*/

// Fill-in the WPForms isCR
// parameter to activate: ?ref=324d8a1d3f81e730d5099a48cee0c5b6
// if ( $_GET['ref'] || $_COOKIE['__client-relation'] ) {
//     $_GET['isCR'] = 'Yes, User is Client Relation Contact';
// }

// Crack down the Videos
$HLVideo    = get_field('highlight_video');
$CRVideo    = get_field('client_relation_video');
$HLExterior = get_field('exterior');
$HLInterior = get_field('interior');

if ( get_field('highlight_video') ) {
	
	if ( ! $_GET['ref'] && ! $_COOKIE['__client-relation']  ) {
		echo do_shortcode( '[wp-video-popup id="HLVideo" hide-related="1" video="'.$HLVideo.'"]' );		
	} else {
		echo do_shortcode( '[wp-video-popup id="HLVideo" hide-related="1" video="'.$CRVideo.'"]' );		
	}
    
} elseif ( get_field('exterior') ) {
    echo do_shortcode( '[wp-video-popup id="EXTVideo" hide-related="1" video="'.$HLExterior.'"]' );
} elseif ( get_field('interior') ) {
    echo do_shortcode( '[wp-video-popup id="INTVideo" hide-related="1" video="'.$HLInterior.'"]' );
}

// Pull Property Slug
$pageSlug = explode('?', $_SERVER['REQUEST_URI'], 2)[0];
$pageSlug = explode('/', $pageSlug);
$_GET['page_slug'] = $pageSlug[2];

// Pull Reference Key Person
$_GET['rkp'] = get_field('contact_name');

// --

/* ?>
<div class="property-alert-banner">
    <a href="#" class="uk-alert-close uk-close"> &times; </a>

    <div class="uk-alert">
        <div class="property-notification">
            <small>Limited Opportunity: Walgreens Investment Property</small>
            <h4><a href="<?php echo __(site_url('property/walgreens-burbank-illinois')); ?>" target="_self">Pair with Garver for Strong Investment Portfolio Diversification</a></h4>
        </div>
        <div class="download-1031">
            <aside class="uk-flex uk-flex-middle">
                <h4>
                    Download Free 28-Page Booklet - 1031: <br>
                    A Guide Through the Tax Deferred Real Estate Investment Process. <br>
                    <a href="<?php echo __(site_url( '/1031-exchange-information#EIG' )); ?>">Download Free Guide Here</a>
                </h4>
                <img src="<?php echo _uri.'/assets/images/book-cover-1031EIG.jpg'; ?>" alt="1031 Exchange Info Guide">
            </aside>
        </div>
    </div>

</div>
<?php */ ?>
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

<main role="main" class="main">
    <?php get_template_part( _menu ); ?>

    <header class="hero">
    <?php $bgHeader = get_field('header_background');

        echo wp_get_attachment_image( $bgHeader['id'], [ 1920, 720, true ] ); 

        $blurbs = get_field('header_blurbs');
        $remov  = array("[", "]");
        $replc  = array("<", ">");
        $blurbs = str_replace($remov, $replc, $blurbs);
        ?>

        <div class="uk-container uk-container-expand">
            <article class="uk-article uk-width-large-1-1 uk-width-xlarge-1-2">
                <p><?php echo $blurbs; ?></p>
                <?php the_field('header_content');  ?>
            </article>
        </div>
    </header>

    <section id="section-request" class="uk-block section-request">
        <div class="uk-container uk-container-expand uk-background-secondary">
            <div class="uk-grid uk-grid-width-large-1-1 uk-grid-width-xlarge-1-2" data-uk-grid-margin>
                <div>
                    <?php if ( get_field('activate_label_ppm') ) {
                    $mailchimpAPI = '&lid='.$_GET['lid'].'&ct='.$campaignTitle.'&cl='.$campaignLink[4]; ?>
                    <a href="<?php echo site_url( '/ppm?property=' . str_replace(" ", "-", get_the_title()) . $mailchimpAPI ); ?>" class="uk-button uk-button-default uk-button-green-outline"> <?php the_field('label_ppm'); ?> </a>
                    <?php } 
                    if ( get_field('activate_label_brochure') ) { ?>
                    <button type="button" class="uk-button uk-button-green"> <?php the_field('label_brochure'); ?> </button>
                    <?php } ?>
                </div>
                <div class="uk-text-right">
                    <?php if ( ! $_GET['ref'] && ! $_COOKIE['__client-relation']  ) { ?>
                        <button type="button" class="uk-button uk-button-orange" data-uk-modal="{target: '#contactForm', center: true, bgclose: false}"> <i class="uk-icon-envelope uk-icon-small"></i> </button>
                        <button type="button" class="uk-button uk-button-orange" data-uk-modal="{target: '#contactMobile', center: true, bgclose: false}"> <i class="uk-icon-phone uk-icon-small"></i> <span>310.988.4240</span> </button>
                    <?php } else { ?>
                        <button type="button" class="uk-button uk-button-orange --cr"> <i class="uk-icon-phone uk-icon-small"></i> <span>310.988.4240</span> </button>
                    <?php } ?>                    <?php if ( !empty(get_field('highlight_video')) ) { ?>	
                    <button type="button" class="uk-button uk-button-outline wp-video-popup HLVideo"> <i class="uk-icon-video-camera uk-icon-small"></i> <span>Watch the Video</span> </button>
                    	<?php } ?>
                    <!-- <a href="<?php echo $HLVideo; ?>" class="uk-button uk-button-outline" data-uk-lightbox> <i class="uk-icon-video-camera uk-icon-small"></i> <span>Watch the Video</span> </a> -->
                </div>
            </div>
        </div>
        <div id="brochure-request-form" class="uk-container uk-container-expand uk-hidden">
            <div class="brochure-form-wrapper">
                <header class="uk-text-center">
                    <?php 
	                if ( ! $_GET['ref'] && ! $_COOKIE['__client-relation'] ) {
	                		$brochure = get_field('brochure_file');
	                	} else {
		                	$brochure = get_field('CR_brochure_file');
	                	}
                    
                    if ( strlen($brochure['description'] <= '130') ) {
                        $classStr = 'uk-text-capitalize';
                    } elseif ( strlen($brochure['description'] >= '65') ) {
                        $classStr = 'uk-text-uppercase';
                    }

                    if ( $brochure ) : ?>
                    <h2><?php 
                        echo ( !empty($brochure['caption']) ) ? $brochure['caption'] : 'Download '. get_the_title() .' Brochure'; 
                        echo ( !empty($brochure['description']) ) ? '<br> <small class="'.$classStr.'">'.$brochure['description'].'</small>' : null;
                    ?></h2>
                    <?php endif; ?>
                    <p>By downloading this property brochure, you are granting permission to receive periodic emails regarding our property investment opportunities.</p>
                </header>
                <?php echo do_shortcode( get_field('label_brochure_shortcode') ); ?>
                <div id="accredited-disclaimer" class="uk-alert uk-text-justify" data-uk-alert>
                    <p>An accredited investor, (a) earned income that exceeded $200,000 (or $300,000 household income) in each of the prior two years, and reasonably expects the same for the current year, OR (b) has a net worth over $1 million, either alone or together with a spouse (excluding the value of the person's primary residence).</p>
                </div>
            </div>
        </div>
    </section>
    
    <?php $disable = get_field( 'disable_summary' );
    if ( $disable != true ) : ?>
    <section class="uk-block section-summary-info">
        <div class="uk-container">
            
            <article class="uk-article uk-text-center">
                <?php the_field('investment_summary_content'); ?>
            </article>

        </div>
    </section>
    <?php endif; ?>

    <section class="uk-block section-records">
        <figure class="uk-overlay">
        <?php $bgSummary = get_field('investment_highlight_background');

            echo wp_get_attachment_image( $bgSummary['id'], 'full' );
            
            $disable = get_field( 'disable_highlight' );
            if ( $disable != true ) : ?>
            <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-right uk-flex uk-flex-middle">
                <article class="uk-article">
                    <?php the_field('investment_highlight_content'); ?>
                </article>
            </figcaption>
            <?php endif; ?>
            
			<?php if ( ! get_field( 'disable_additional_content' ) ) : // If nnot active, show this content

            if ( ! wp_is_mobile() ) : ?>
                <aside class="uk-position-cover uk-overlay-panel uk-overlay-primary uk-hidden-small">
                    <div class="uk-slidenav-position uk-visible-toggle" data-uk-slider="infinite: false">

                        <div class="uk-slider-container">
                            <ul class="uk-slider uk-grid-width-1-1">
                                <?php while ( have_rows( 'additional_content_list' ) ) : the_row(); 

                                $content_photo = get_sub_field( 'content_photo' );
                                $content_label = get_sub_field( 'content_label' );
                                $content_pdf   = get_sub_field( 'content_pdf' );
                                $content_link  = get_sub_field( 'content_link' );
                                $content_video = get_sub_field( 'content_video' ); ?>
                                <li>
                                    <div class="uk-card uk-flex">
                                        <?php echo wp_get_attachment_image( $content_photo['id'], [ 145, 110, true ] ); ?>
                                        <div class="uk-panel">
                                            <h1><?php echo $content_photo['title']; ?></h1>
                                            <?php if ( $content_pdf ) {
                                                echo '<a href="'.$content_pdf['url'].'" data-link="PDF Download" title="'.$content_pdf['filename'].'" target="_blank">'.$content_label.'</a>';
                                            }

                                            elseif ( $content_link ) {
                                                echo '<a href="'.$content_link.'" data-link="Blog/News" target="_blank">'.$content_label.'</a>';
                                            }

                                            elseif ( $content_video ) {
                                                echo '<a href="'.$content_video.'" data-link="Youtube Video" target="_blank">'.$content_label.'</a>';
                                            } ?>
                                        </div>
                                    </div>
                                </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>

                        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
                        <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>

                    </div>
                </aside>
            <?php else : ?>
                <aside class=" uk-visible-small --ext-details">
                    <?php while ( have_rows( 'additional_content_list' ) ) : the_row(); 

                    $content_photo = get_sub_field( 'content_photo' );
                    $content_label = get_sub_field( 'content_label' );
                    $content_pdf   = get_sub_field( 'content_pdf' );
                    $content_link  = get_sub_field( 'content_link' );
                    $content_video = get_sub_field( 'content_video' ); ?>
                    <div class="uk-card uk-flex">
                        <?php echo wp_get_attachment_image( $content_photo['id'], [ 145, 110, true ] ); ?>
                        <div class="uk-panel">
                            <h1><?php echo $content_photo['title']; ?></h1>
                            <?php if ( $content_pdf ) {
                                echo '<a href="'.$content_pdf['url'].'" title="'.$content_pdf['filename'].'" target="_blank">'.$content_label.'</a>';
                            }

                            elseif ( $content_link ) {
                                echo '<a href="'.$content_link.'" target="_blank">'.$content_label.'</a>';
                            }

                            elseif ( $content_video ) {
                                echo '<a href="'.$content_video.'" target="_blank">'.$content_label.'</a>';
                            } ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </aside>
            <?php endif; 

            // Disable Additional Content
            endif; ?>            
        </figure>
    </section>

    <section id="LightBox" class="uk-block section-gallery">
        <div class="uk-container">

            <h3><?php the_field('lightbox_heading'); ?></h3>

            <?php 
                // Categories
                $categories = get_field('lightbox_category');
                $categories = explode( ",", $categories);

                // Gallery
                $LBPhotos = get_field('lightbox_photos');
            ?>

            <ul id="LightBoxControl" class="uk-subnav uk-subnav-pill">
                <?php if ( $post->ID != '2700' ) :
                    echo '<li data-uk-filter="" class="uk-active"><a href="#">All</a></li>';
                endif; ?>
                <?php foreach ( $categories as $category ) { 
                $category = trim($category); ?>
                <li data-uk-filter="<?php echo $category; ?>" class="<?php echo ( $category == 'All' ) ? '--first' : (($category == 'Other Arkansas Acquisitions') ? '--last' : ''); ?>"><a href=""><?php echo $category; ?></a></li>
                <?php } ?>
            </ul>

            <div class="uk-grid-width-1-2 uk-grid-width-small-1-3 uk-grid-width-medium-1-4 --lb-list" data-uk-grid="{controls:'#LightBoxControl', gutter: 5}">
                <?php foreach ( $LBPhotos as $LBPhoto ) { ?>
                <div data-filter="<?php echo $LBPhoto['description']; ?>" data-uk-filter="<?php echo $LBPhoto['description']; ?>">
                    <a class="uk-thumbnail" href="<?php echo $LBPhoto['url']; ?>" data-uk-lightbox="{group: '<?php echo $LBPhoto['description']; ?>'}" title="<?php echo $LBPhoto['title']; ?>">
                        <?php echo wp_get_attachment_image( $LBPhoto['id'], 'full' ); ?>
                        <div class="uk-thumbnail-caption"><?php echo $LBPhoto['title']; ?></div>
                    </a>
                </div>
                <?php } ?>
            </div>

        </div>
    </section>
    
    <?php
	$map = get_field('active_map');
	
	if ( !empty( $map ) ) : ?>
    <section id="property-map" class="section-map">
    <?php
	    if ( $map['value'] == 'elfsight' ) :

        $elfsight = get_field('map_shortcode');
        $elfsight_description = get_field('map_notification_label');

        if ( ! empty($elfsight_description) ) : ?>
        <div class="uk-alert uk-alert-success">
            <span><?php echo $elfsight_description; ?></span>
        </div>
        <?php endif; ?>
        <div class="uk-panel uk-position-relative">
            <div class="wp-google-maps">
                <?php // echo do_shortcode( $elfsight ); ?>
                
                <?php if ( have_rows('map_legends') ) : ?>
                <div class="uk-position-top-left">
                    <div class="legend uk-open" data-uk-dropdown="{mode: 'click', pos: 'bottom-left', preventflip: true}">
                        <div class="map-legend-button"> Map Legend </div>
                        <div class="uk-dropdown">
                            <ul class="uk-list">
                                <?php while ( have_rows('map_legends') ) : the_row(); ?>
                                <li><svg width="20" height="20" viewBox="0 0 20 20" xmlns="//www.w3.org/2000/svg" data-svg="location"><path fill="<?php the_sub_field('legend_color'); ?>" d="M10,0.5 C6.41,0.5 3.5,3.39 3.5,6.98 C3.5,11.83 10,19 10,19 C10,19 16.5,11.83 16.5,6.98 C16.5,3.39 13.59,0.5 10,0.5 L10,0.5 Z"></path><circle fill="#FFF" cx="10" cy="6.8" r="2.3"></circle></svg>
                                <?php the_sub_field('legend_label'); ?></li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php elseif ( $map['value'] == 'acf' ) : 
	    
	    $location = get_field('map_address'); ?>
        <div class="acf-map" data-zoom="10">
			<div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
	  	</div>
	  	<?php endif; ?>
    </section>
    <?php endif; ?>

    <section id="NASISRecords" class="uk-block section-records">
        <div class="uk-container">

            <article class="uk-article uk-text-center track-record-list">
                <h2>NAS Investment Property Track Record - Since 2008</h2>
            
                <ul>
                    <?php while ( have_rows('record_asset') ) : the_row(); 
                    $iconRecord = get_sub_field('icon'); ?>
                    <li>
                        <span><?php echo wp_get_attachment_image( $iconRecord['id'], 'full' ); ?></span>
                        <?php the_sub_field('value'); ?> <small><?php the_sub_field('label'); ?></small>
                    </li>
                    <?php endwhile; ?>

                    <li class="uk-divider"> <hr> </li>
                    
                    <?php while ( have_rows('record_value') ) : the_row(); ?>
                    <li>
                        <?php the_sub_field('value'); ?> <small><?php the_sub_field('notation'); ?></small> <span><?php the_sub_field('label'); ?></span>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </article>

        </div>
    </section>

    <?php $exchange = new WP_Query([ 'post_type' => 'page', 'page_id' => 1279, 'posts_per_page' => 1 ]);
    while ( $exchange->have_posts() ) : $exchange->the_post(); ?>
    <section class="section-next-router">
        <div class="uk-grid uk-grid-collapse uk-grid-match" data-uk-grid-match>
            <?php while ( have_rows( 'router_wrapper' ) ) : the_row(); 
            $icon = get_sub_field( 'router_icon' ); ?>
            <div class="uk-width-medium-1-3">
                <div class="uk-column-panel uk-text-center">
                    <?php echo wp_get_attachment_image( $icon['id'], [ 50, 50, true ] ); ?>
                    <h4><?php the_sub_field( 'router_title' ); ?></h4>
                    <p><?php the_sub_field( 'router_content' ); ?></p>
                    <a href="<?php the_sub_field( 'router_link' ); ?>" class="uk-button">Click Here</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endwhile; wp_reset_query(); ?>

    <section class="uk-block uk-block-secondary section-contact">
        <div class="uk-container uk-container-small">

            <article class="uk-article uk-text-center">
                <h2>Secure Your Opportunity to Invest with Us Now.</h2>
                <span class="uk-text-uppercase">contact</span>
                <?php if ( ! $_GET['ref'] && ! $_COOKIE['__client-relation'] ) { ?>
                    <ul>
                        <li><?php the_field('contact_name'); ?></li>
                        <li><?php the_field('contact_position'); ?> <br> <?php the_field('contact_phone'); ?> </li>
                    </ul>
                <?php } else { ?>
                    <ul>
                        <li><?php the_field('contact_phone'); ?> </li>
                    </ul>
                <?php } ?>
            </article>

        </div>
    </section>

    <section class="uk-block section-disclaimer">
        <article class="uk-article uk-container uk-container-expand">
            <?php the_field('disclaimer'); ?>
        </article>
    </section>

</main>

<?php ### MODALS ### ?>

<div id="contactForm" class="uk-modal">
    <div class="uk-modal-dialog">

        <button type="button" class="uk-modal-close uk-close"></button>
        <div class="uk-modal-header">
            <h3>Send message to <?php echo get_field('contact_name') .', '. get_field('contact_position'); ?> <small><?php bloginfo(); ?></small></h3>
            <p class="uk-text-small"><span class="uk-icon-info-circle"></span> You will receive a response within 24 hours.</p>
        </div>
        <div class="uk-modal-body">
            <?php echo do_shortcode( '[wpforms id="657" title="false" description="false"]' ); ?>
        </div>

    </div>
</div>

<div id="contactMobile" class="uk-modal">
    <div class="uk-modal-dialog uk-border-rounded">

        <button type="button" class="uk-modal-close uk-close"></button>
        <div class="uk-modal-body">
            <figure class="uk-inline uk-text-center">
                <img src="<?php echo _uri; ?>/assets/images/profile-ke-kennedy.jpg" class="uk-border-circle" alt="Karen E. Kennedy, President & Founder">
                <figcaption>
                    <h3><?php the_field('contact_name'); ?></h3>
                    <p><?php the_field('contact_position'); ?></p>
                    <p><?php bloginfo(); ?></p>
                </figcaption>
                <a href="tel:<?php the_field('contact_phone') ?>" class="uk-border-circle uk-background-primary"> <span class="uk-icon-mobile"></span> </a>
                <p>call now</p>
                <p class="uk-text-lead">310.988.4240</p>
            </figure>
        </div>

    </div>
</div>

<?php // PPM Alert Modal
    
    $bannerBG = get_field('banner_background');
    $context1 = get_field('banner_context1');
    $context2 = get_field('banner_context2');
    $context3 = get_field('banner_context3');

?>

<?php if ( get_field( 'activate_banner' ) ) : ?>
<div id="ppm-alert" class="uk-alert" data-uk-alert>
    <a href="#" class="uk-alert-close uk-close"></a>
    <figure class="uk-overlay">
        <?php echo wp_get_attachment_image( $bannerBG['id'], [ 640, 360 ] ); ?>
        <figcaption class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-left">
            <div>
                <h3><?php echo $context1; ?></h3>
                <p><strong><?php echo $context2; ?></strong></p>
                <div class="uk-button-group uk-margin-top">
	                <?php if ( get_field('banner_anchor_tag') ) :
	                $mailchimpAPI = '&lid='.$_GET['lid'].'&ct='.$campaignTitle.'&cl='.$campaignLink[4];
	                $aTag = 'href="'.site_url( '/ppm?property=' . str_replace(" ", "-", get_the_title()) . $mailchimpAPI ).'"';
	                endif; ?>
	                <a <?php echo $aTag; ?> class="uk-button uk-button-primary"><?php echo $context3; ?></a>
	                
	                <?php if ( get_field('activate_label_brochure') ) { ?>
                    <button type="button" class="uk-button uk-button-danger"> <?php the_field('label_brochure'); ?> </button>
	                <?php } ?>
                </div>
            </div>
        </figcaption>
    </figure>
</div>
<?php endif; ?>

<div id="responseModal" class="uk-modal responseModal">
    <div class="uk-modal-dialog">
        <button type="button" class="uk-modal-close uk-close"></button>
        <div class="uk-modal-header"> Property Brochure Download Complete </div>
        <div class="uk-panel">
            <h3 class="uk-panel-title"> Thank You, <?php echo $_GET['ufn']; ?>. </h3>
            <p>Your brochure has been downloaded to your computer into the designated file folder. Please feel free to reach out to us with any questions about our latest property investment.</p>
            <p>Karen E. Kennedy <br> President & Founder <br> NAS Investment Solutions, LLC.</p>
        </div>
    </div>
</div>