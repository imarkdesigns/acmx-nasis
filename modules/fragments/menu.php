<?php
$header_menu = [
    'theme_location'  => 'header_menu',
    'menu_class'      => 'uk-navbar-nav',
    'container'       => '',
    'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
    'depth'           => 2,
    'walker'          => new subMenuWrap()
];

if ( $post->post_type == 'exchange_articles' ) {
    $extNav = 'gn-fixed';
}

// Crack down the Videos
$HLVideo    = get_field('highlight_video');
$CRVideo    = get_field('client_relation_video');
$HLExterior = get_field('exterior');
$HLInterior = get_field('interior');
$HLAddition = get_field('additional_video');

if ( get_field('highlight_video') ) {

	if ( ! $_GET['ref'] && ! $_COOKIE['__client-relation']  ) {
		echo do_shortcode( '[wp-video-popup id="HLMVideo" hide-related="1" video="'.$HLVideo.'"]' );	
	} else {
		echo do_shortcode( '[wp-video-popup id="HLMVideo" hide-related="1" video="'.$CRVideo.'"]' );		
	}
    
} elseif ( get_field('exterior') ) {
    echo do_shortcode( '[wp-video-popup id="EXTVideo" hide-related="1" video="'.$HLExterior.'"]' );
} elseif ( get_field('interior') ) {
    echo do_shortcode( '[wp-video-popup id="INTVideo" hide-related="1" video="'.$HLInterior.'"]' );
} elseif ( get_field('additional_video') ) {
    echo do_shortcode( '[wp-video-popup id="YTVideo" hide-related="1" video="'.$HLAddition.'"]' );
}

if ( $post->post_type != 'nasis_investments' || get_field('property_status') == 'Sold Out' ) : ?>

<nav class="globalnav <?=$extNav?>" role="navigation" data-uk-sticky="{top:-200, animation: 'uk-animation-slide-top'}">
        
    <div id="navbar" class="uk-navbar uk-main-navbar">
        <a href="<?php echo __(home_url()); ?>" class="uk-navbar-brand"> <?php bloginfo( $title ); ?> </a>
        
        <div class="uk-navbar-flip">
            <?php wp_nav_menu( $header_menu ); ?>
            <a href="javascript:void(0);" class="uk-navbar-toggle" data-uk-offcanvas="{mode: 'slide', target: '#mobilenav'}"></a>
        </div>
    </div>

</nav>

<?php else : ?>

<nav class="globalnav" role="navigation" data-uk-sticky="{top:-200, animation: 'uk-animation-slide-top'}">
    <div id="navbar" class="uk-navbar">
        <a href="<?php echo __(home_url()); ?>" class="uk-navbar-brand"> <?php bloginfo( $title ); ?> </a>

        <div class="uk-navbar-flip">
            <ul class="uk-navbar-nav">
                <li><a href="<?php echo esc_url( home_url() ); ?>">Home</a></li>
                <li data-uk-dropdown="{mode: 'click'}">
                    <a href="#">Media Highlights <i class="uk-icon-caret-down"></i></a>
                    <div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom uk-dropdown-width-2">
                        <div class="uk-grid uk-dropdown-grid">
                            <div class="uk-width-1-2">
                                <ul class="uk-nav uk-nav-dropdown">
                                    <li class="uk-nav-header">Videos</li>
                                    	<?php if ( get_field('highlight_video') ) : ?>
                                    <li><a href="" class="wp-video-popup HLMVideo">Investment Highlights</a></li>
                                    <?php endif; ?>
                                    
                                    <?php if ( get_field('exterior') ) : ?>
                                    <li><a href="#" class="wp-video-popup EXTVideo">Exterior Tour</a></li>
                                    <?php elseif ( get_field('interior') ) : ?>
                                    <li><a href="#" class="wp-video-popup INTVideo">Interior Tour</a></li>
                                    <?php endif; ?>
                                    <li><a href="<?php echo esc_url( home_url( '#NASISCompanyVideo' ) ); ?>">NASIS Company Video</a></li>
                                </ul>
                            </div>
                            <div class="uk-width-1-2">
                                <ul class="uk-nav uk-nav-dropdown">
                                    <li class="uk-nav-header">Gallery</li>
                                    <li><a href="<?php echo site_url('#LightBox'); ?>" data-uk-smooth-scroll="{offset: 60}">Property Photos</a></li>
                                </ul>
                            </div>
                            <?php if ( get_field('additional_video') ) : ?>
                            <div class="uk-width-1-1">
                                <ul class="uk-nav uk-nav-dropdown">
                                    <li class="uk-nav-header">Additional Info</li>
                                    <li><a href="#" class="wp-video-popup YTVideo"><?php echo ( get_field( 'additional_video_label' ) ) ? get_field( 'additional_video_label' ) : 'Watch Video to Learn More'; ?> </a></li>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>
                <li><a href="#property-map" data-uk-smooth-scroll="{offset: 80}">Map</a></li>
				<?php if ( ! $_GET['ref'] && ! $_COOKIE['__client-relation'] ) : ?>
                <li data-uk-dropdown="{mode: 'click'}">
                    <a href="#">Contact <i class="uk-icon-caret-down"></i></a>
                    <div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="#" data-uk-modal="{target: '#contactForm', center: true, bgclose: false}">Contact by Email</a></li>
                            <li><a href="#" data-uk-modal="{target: '#contactMobile', center: true, bgclose: false}">Contact by Phone</a></li>
                        </ul>
                    </div>
                </li>
                <?php endif; ?>

                <li data-uk-dropdown="{mode: 'click'}">
                    <a href="#">About NASIS <i class="uk-icon-caret-down"></i></a>
                    <div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom">
                        <ul class="uk-nav uk-nav-dropdown">
                            <li><a href="<?php echo site_url('commercial-real-estate-investments'); ?>">NAS Investment Solutions</a></li>
                            <li><a href="<?php echo site_url('team'); ?>">Team</a></li>
                            <li><a href="<?php echo site_url('news'); ?>">News</a></li>
                            <li><a href="<?php echo __(site_url('testimonials#client-quotes')); ?>"> Testimonials </a></li>
                            <li><a href="#NASISRecords" data-uk-smooth-scroll="{offset: 80}">NAS Property Track Record</a></li>
                            <li><a href="<?php echo esc_url( site_url('wp-content/uploads/2021/02/NASIS-Brochure-2021-February-Edition.pdf') ); ?>">Download NASIS Brochure</a></li>
                        </ul>
                    </div>
                </li>
                <?php $investment = new WP_Query([ 
                    'post_type'      => ['nasis_investments'],
                    'posts_per_page' => -1,
                    'post__not_in'   => [ 1702 ],
                    'has_password'   => false,
                    'post_status'    => 'publish',
                    'meta_key'       => 'property_status',
                    'meta_value'     => 'Available'
                ]); ?>
                <li data-uk-dropdown="{mode: 'click'}">
                    <a href="#">Other Investments <i class="uk-icon-caret-down"></i></a>
                    <div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom">
                        <ul class="uk-nav uk-nav-dropdown">
                            <?php while( $investment->have_posts() ) : $investment->the_post(); ?>
                            <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
                            <?php endwhile; wp_reset_query(); ?>
                        </ul>
                    </div>
                </li>
                <li data-uk-dropdown="{mode: 'click'}">
                    <a href="#">Investment Info <i class="uk-icon-caret-down"></i></a>
                    <div class="uk-dropdown uk-dropdown-navbar uk-dropdown-bottom">
                        <ul class="uk-nav uk-nav-dropdown">
	                        <li><a href="<?php echo esc_url( site_url('fractional-investing') ); ?>">Fractional Interest Investing</a></li>
	                        <li><a href="<?php echo esc_url( site_url('webinar') ); ?>">Webinars</a></li>
							<li><a href="<?php echo esc_url( site_url('1031-exchange-information/1031-exchange-articles') ); ?>">Real Estate Investment Articles</a></li>
                            <li><a href="<?php echo esc_url( site_url('1031-exchange-information') ); ?>">1031 Exchange Information</a></li>
                            <li><a href="<?php echo esc_url( site_url('1031-exchange-information?q=guide#NASISEIG') ); ?>">1031 Exchange Information Guide Download</a></li>
                            <li><a href="<?php echo esc_url( site_url('1031-exchange-information#TaxRates') ); ?>">Tax Rate By State</a></li>
                            <li><a href="<?php echo esc_url( site_url('1031-exchange-information/1031-exchange-calculator') ); ?>">1031 Exchange Calculator</a></li>
                            <li><a href="<?php echo esc_url( site_url('1031-exchange-information/faqs') ); ?>">Frequently Asked Questions</a></li>
                            <li><a href="<?php echo esc_url( site_url('1031-exchange-information/glossary') ); ?>">Glossary of Terms</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href="#GlobalFooter" data-uk-smooth-scroll="{offset: 80}" class="uk-button uk-button-danger">New Deal Alert</a></li>
            </ul>
            <a href="javascript:void(0);" class="uk-navbar-toggle" data-uk-offcanvas="{mode: 'slide', target: '#mobilenav'}"></a>
        </div>
    </div>
</nav>

<?php endif;