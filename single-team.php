<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ 

session_set_cookie_params(0);
session_start();
$_SESSION['reference'] = $contact;

while ( have_rows('profile_information') ) : the_row();
  $vcf      = get_sub_field('variant_call_format');
  $name     = get_sub_field('profile_name');
  $cabre    = get_sub_field('ca_bre');
  $linkedin = get_sub_field('linkedin_profile_url');
  $email    = get_sub_field('company_email');
  $position = get_sub_field('company_position');
  $office   = get_sub_field('office_number');
  $direct   = get_sub_field('direct_number');
endwhile;

$featured_image = get_field('featured_profile_photo');

// Retrieve ID for exchange of Contact Email 
/*
$cid = $_GET['cid'];
if ( $cid == $post->ID ) {
  $_GET['cid'] = $email;
}
*/

$_GET['cid'] = $email;

// Retrieve if mail sent successfully
$status = $_GET['status'];
?>

<main class="main" role="main">

  <section id="section-profile" class="uk-block">
    <div class="uk-container uk-container-small">

      <figure class="uk-panel">
        <img src="<?php echo $featured_image['url'] ?>" alt="<?php echo $name; ?>">
      </figure>
      
      <hgroup>
        <h1 class="uk-heading-large"><?php echo $name; ?></h1>
        <h3><?php echo $position; ?> <?php if (! empty($cabre)) { ?><small class="uk-display-block uk-text-warning">CA BRE: <?php echo $cabre; ?></small><?php } ?></h3>
      </hgroup>
      
      <div data-uk-accordion="{showfirst: false, toggle: '.phone-link', containers: '.phone-selections'}">
        <div class="uk-heading-line uk-text-center">
          <ul class="uk-list">
            <?php if ( !empty($linkedin) ) : ?>
            <li><a href="<?php echo __($linkedin); ?>" target="_blank" class="fa fa-linkedin"></a></li>
            <?php endif; ?>
            <li><a class="fa fa-envelope" data-uk-modal="{target: '#personalContact',bgclose: false, center: true}"></a></li>
            <li><a class="fa fa-phone phone-link"></a></li>
            <?php if ( !empty($vcf) ) : ?>
            <li><a href="<?php echo __($vcf['url']); ?>" class="fa fa-id-card"></a></li>
            <?php endif; ?>
          </ul>
        </div>
        
        <div class="phone-selections">
          <ul class="uk-subnav uk-subnav-line">
            <li><a class="uk-icon-justify uk-icon-building"> <?php echo $office; ?></a></li>
            <li><a class="uk-icon-justify uk-icon-phone"> <?php echo $direct; ?></a></li>
          </ul>
        </div>
      </div>

    </div>
  </section>

  <section id="section-bio" class="uk-block">
    <?php if ( $status == 'success' ) : ?>
    <div class="uk-container uk-container-small">
      <div class="uk-alert uk-alert-success" data-uk-alert>
        <a href="#" class="uk-alert-close uk-close"></a>
        <p class="uk-text-center"><strong>Mail Sent Success!</strong> We will be in touch with you shortly.</p>
      </div>
    </div>
    <?php endif; ?>
    
    <div class="uk-container uk-container-small uk-text-justify">
      
      <?php the_field('profile_bio'); ?>
      
    </div>
  </section>

</main>

<?php # Init Modal ?>
<div id="personalContact" class="uk-modal">
  <div class="uk-modal-dialog">
    <button type="button" class="uk-modal-close uk-close"></button>
    <div class="uk-modal-header">
      Send message to <?php echo $name; ?>
    </div>
    <div class="uk-modal-body">
      <?php echo do_shortcode( '[wpforms id="264" title="false" description="false"]' ); ?>
    </div>
  </div>
</div>

<?php get_template_part( _router, 'team' ); ?>