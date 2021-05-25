<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/

$contact_info = new WP_Query([ 'post_type' => ['page'], 'pagename' => 'contact', 'posts_per_page' => 1 ]);
$mobile_menu = [
  'theme_location'  => 'mobile_menu',
  'menu_class'      => 'uk-nav uk-nav-parent-icon uk-nav-side',
  'container'       => false,
  'items_wrap'      => '<ul class="%2$s" data-uk-nav>%3$s</ul>',
  'depth'           => 2,
  // 'walker'          => new mobMenuWrap()
];

if ( ! is_singular( 'nasis_investments' ) ) :

?>

<div id="mobilenav" class="uk-offcanvas">
  <div class="uk-offcanvas-bar">

    <nav class="sidenav uk-panel" role="navigation">
      <h3 class="uk-panel-title"> Menu Navigation </h3>

      <ul class="uk-nav uk-nav-parent-icon uk-nav-side" data-uk-nav>
        <li><a href="<?php echo esc_url( home_url() ); ?>">Home</a></li>
        <li class="uk-parent">
          <a href="#">About</a>
          <ul class="uk-nav-sub">
            <li><a href="<?php echo esc_url( site_url('commercial-real-estate-investments') ); ?>">About NAS Investment Solutions</a></li>
            <li><a href="<?php echo esc_url( site_url('#NASISCompanyVideo') ); ?>">Company Video</a></li>
            <li><a href="<?php echo esc_url( site_url('testimonials#client-quotes') ); ?>">Client Testimonials</a></li>
            <li><a href="<?php echo esc_url( site_url('team') ); ?>">Team</a></li>
            <li><a href="<?php echo esc_url( site_url('news') ); ?>">News</a></li>
            <li><a href="<?php echo esc_url( site_url('map') ); ?>">Map of Underwritten Properties</a></li>
            <li><a href="<?php echo esc_url( site_url('referral-program') ); ?>">Refer A Friend</a></li>
            <li><a href="<?php echo esc_url( site_url('wp-content/uploads/2020/01/National-Asset-Services-Company-Brochure.pdf') ); ?>">Download NASIS Brochure</a></li>
          </ul>
        </li>
        <li class="uk-parent">
          <a href="#">Investment Info</a>
          <ul class="uk-nav-sub">
            <li><a href="<?php echo esc_url( site_url('1031-exchange-information/fractional-investing') ); ?>">Fractional Interest Investing</a></li>
            <li><a href="<?php echo esc_url( site_url('webinar') ); ?>">Webinars</a></li>
            <li><a href="<?php echo esc_url( site_url('1031-exchange-information/1031-exchange-articles') ); ?>">Real Estate Investment Articles</a></li>
            <li><a href="<?php echo esc_url( site_url('1031-exchange-information') ); ?>">1031 Exchange Information</a></li>
            <li><a href="<?php echo esc_url( site_url('1031-exchange-information#EIG') ); ?>">1031 Exchange Information Guide Download</a></li>
            <li><a href="<?php echo esc_url( site_url('1031-exchange-information#TaxRates') ); ?>">Tax Rate By State</a></li>
            <li><a href="<?php echo esc_url( site_url('1031-exchange-information/45-180-day-exchange-calculator') ); ?>">45/180 Day Exchange Calculator</a></li>
            <li><a href="<?php echo esc_url( site_url('1031-exchange-information/faqs') ); ?>">Frequently Asked Questions</a></li>
            <li><a href="<?php echo esc_url( site_url('1031-exchange-information/glossary') ); ?>">Glossary of Terms</a></li>
          </ul>
        </li>
        <li class="uk-parent">
          <a href="#">Investment Properties</a>
          <ul class="uk-nav-sub">
            <li><a href="<?php echo esc_url( site_url('available-investments') ); ?>">Available Investments</a></li>
            <li><a href="<?php echo esc_url( site_url('property/garver-national-headquarters') ); ?>">Garver National Headquarters</a></li>
            <li><a href="<?php echo esc_url( site_url('property/walgreens-burlington-vermont') ); ?>">Walgreens Burlington Vermont</a></li>
            <li class="uk-nav-header">Recently Closed</li>
            <li><a href="<?php echo esc_url( site_url('property/2200-bentonville') ); ?>">2200 Bentonville</a></li>
            <li><a href="<?php echo esc_url( site_url('property/1031-exchange-property-bnsf') ); ?>">BNSF Logistics Building</a></li>
            <li><a href="<?php echo esc_url( site_url('property/1031-exchange-property-novanta') ); ?>">Novanta Industrial Flex Office</a></li>
            <li><a href="<?php echo esc_url( site_url('property/bnsf-corporate-campus-phase-two') ); ?>">BNSF Corporate Campus Phase II</a></li>
          </ul>
        </li>
        <li><a href="<?php echo esc_url( site_url('acquisition-criteria') ); ?>">Acquisitions Criteria</a></li>
        <li><a href="<?php echo esc_url( site_url('contact') ); ?>">Contact</a></li>
        <li><a href="<?php echo esc_url( site_url('privacy-policy') ); ?>">Privacy Policy</a></li>
        <li><a href="<?php echo esc_url( site_url('sitemap') ); ?>">Sitemap</a></li>
      </ul>

      <hr class="uk-divider-icon">

      <?php while ( $contact_info->have_posts() ) : $contact_info->the_post(); ?>
      <address class="uk-panel-body">
        <?php while ( have_rows( 'contact_details' ) ) : the_row(); ?>
        <h4>Corporate Address</h4>
        <p><?php the_sub_field('corporate_address'); ?></p>

        <h4>Phone &amp; Fax Number</h4>
        <p><?php the_sub_field('phone_fax_number'); ?></p>
        <?php endwhile; ?>
      </address>
      <?php endwhile; wp_reset_query(); ?>
    </nav>

  </div>
</div>

<?php else : ?>

<div id="mobilenav" class="uk-offcanvas">
  <div class="uk-offcanvas-bar">

    <nav class="sidenav uk-panel" role="navigation">
      <h3 class="uk-panel-title"> Menu Navigation </h3>
      
      <ul class="uk-nav uk-nav-parent-icon uk-nav-side" data-uk-nav>
        <li><a href="<?php echo __(home_url()); ?>">Home</a></li>
		
		<li class="uk-parent">
			<a href="#">Media Highlights</a>
			<ul class="uk-nav-sub">
				<li class="uk-nav-header">Videos</li>
				<?php if ( get_field('highlight_video') ) : ?>
			    <li><a href="" class="wp-video-popup HLVideo">Investment Highlights</a></li>
			    <?php endif;
			    
			    if ( get_field('exterior') ) : ?>
			    <li><a href="#" class="wp-video-popup EXTVideo">Exterior Tour</a></li>
			    <?php elseif ( get_field('interior') ) : ?>
			    <li><a href="#" class="wp-video-popup INTVideo">Interior Tour</a></li>
			    <?php endif; ?>
			    <li><a href="<?php echo esc_url( home_url( '#NASISCompanyVideo' ) ); ?>">NASIS Company Video</a></li>
				
				<li class="uk-nav-header">Gallery</li>
                <li><a href="<?php echo site_url('#LightBox'); ?>" data-uk-smooth-scroll="{offset: 60}">Property Photos</a></li>
                
                	<?php if ( get_field('additional_video') ) : ?>
                	<li class="uk-nav-header">Additional Info</li>
                	<li><a href="#" class="wp-video-popup YTVideo">Watch Video to Learn More</a></li>
                	<?php endif; ?>
			</ul>
		</li>
		<?php if ( ! $_GET['ref'] && ! $_COOKIE['__client-relation'] ) : ?>
		<li class="uk-parent">
			<a href="#">Contact</a>
			<ul class="uk-nav-sub">
				<li><a href="#" data-uk-modal="{target: '#contactForm', center: true, bgclose: false}">Contact by Email</a></li>
				<li><a href="#" data-uk-modal="{target: '#contactMobile', center: true, bgclose: false}">Contact by Phone</a></li>
			</ul>
		</li>
		<?php endif; ?>
		<li class="uk-parent">
			<a href="#">About NASIS</a>
			<ul class="uk-nav-sub">
                <li><a href="<?php echo site_url('/commercial-real-estate-investments'); ?>">NAS Investment Solutions</a></li>
                <li><a href="<?php echo site_url('/team'); ?>">Team</a></li>
                <li><a href="<?php echo site_url('/news'); ?>">News</a></li>
                <li><a href="<?php echo __(site_url('/testimonials#client-quotes')); ?>"> Testimonials </a></li>
                <li><a href="#NASISRecords" data-uk-smooth-scroll="{offset: 80}">NAS Property Track Record</a></li>
                <li><a href="<?php echo esc_url( site_url('/wp-content/uploads/2019/03/NAS-Investment-Solutions-Brochure.pdf') ); ?>">Download NASIS Brochure</a></li>
			</ul>
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
    <li class="uk-parent">
        <a href="#">Other Investments</a>
        <ul class="uk-nav-sub">
            <?php while( $investment->have_posts() ) : $investment->the_post(); ?>
            <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>
            <?php endwhile; wp_reset_query(); ?>
        </ul>
    </li>     
		<li class="uk-parent">
			<a href="#">Investment Info</a>
			<ul class="uk-nav-sub">
                <li><a href="<?php echo esc_url( site_url('/1031-exchange-information/fractional-investing') ); ?>">Fractional Interest Investing</a></li>
                <li><a href="<?php echo esc_url( site_url('/webinar') ); ?>">Webinars</a></li>
				<li><a href="<?php echo esc_url( site_url('/1031-exchange-information/1031-exchange-articles') ); ?>">Real Estate Investment Articles</a></li>
                <li><a href="<?php echo esc_url( site_url('/1031-exchange-information') ); ?>">1031 Exchange Information</a></li>
                	<li><a href="<?php echo esc_url( site_url('/1031-exchange-information#EIG') ); ?>">1031 Exchange Information Guide Download</a></li>
                <li><a href="<?php echo esc_url( site_url('/1031-exchange-information#TaxRates') ); ?>">Tax Rate By State</a></li>
                <li><a href="<?php echo esc_url( site_url('/1031-exchange-information/45-180-exchange-calculator') ); ?>">45/180 Day Exchange Calculator</a></li>
                <li><a href="<?php echo esc_url( site_url('/1031-exchange-information/faqs') ); ?>">Frequently Asked Questions</a></li>
                <li><a href="<?php echo esc_url( site_url('/1031-exchange-information/glossary') ); ?>">Glossary of Terms</a></li>
			</ul>
		</li>
		<li><a href="#GlobalFooter" data-uk-smooth-scroll="{offset: 80}" class="uk-button uk-button-outline">New Deal Alert</a></li>
      </ul>

      <hr class="uk-divider-icon">

      <?php while ( $contact_info->have_posts() ) : $contact_info->the_post(); ?>
      <address class="uk-panel-body">
        <?php while ( have_rows( 'contact_details' ) ) : the_row(); ?>
        <h4>Corporate Address</h4>
        <p><?php the_sub_field('corporate_address'); ?></p>

        <h4>Phone &amp; Fax Number</h4>
        <p><?php the_sub_field('phone_fax_number'); ?></p>
        <?php endwhile; ?>
      </address>
      <?php endwhile; wp_reset_query(); ?>
    </nav>

  </div>
</div>

<?php endif;