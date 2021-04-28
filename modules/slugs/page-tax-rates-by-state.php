<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<nav class="uk-navbar local-nav uk-visible-large">
  <div class="uk-container">
    <div class="uk-navbar-flip">
      <ul class="uk-navbar-nav">
        <li><a href="<?php echo __(site_url('1031-exchange-information')); ?>">1031 Exchange Information</a></li>
        <li><a href="<?php echo __(site_url('webinar')); ?>">Webinars</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/1031-exchange-articles')); ?>">Real Estate investment Articles</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/faqs')); ?>">FAQ’s</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information#EIG')); ?>">Download 1031 Guide</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/glossary')); ?>">Glossary</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="main" role="main">

  <section class="uk-block tax-rate-table">
    <div class="uk-container uk-container-large">
		
		<h2>State Capital Gains Tax Rates</h2>

		<div class="uk-grid" data-uk-grid-margin>

			<div class="uk-width-medium-1-1 uk-width-large-3-4">
				<table class="uk-table uk-table-striped">

					<thead>
						<tr>
							<th>State</th>
							<th>State %</th>
							<?php /* <th>Deducation</th> */ ?>
							<th>Combined %</th>
							<th>State Tax Rate Source</th>
							<?php /* <th>State Deduction Source</th> */ ?>
						</tr>
					</thead>

					<tbody>
						<?php while ( have_rows( 'tax_table_list' ) ) : the_row(); ?>
						<tr>
							<td width="17%"><?php the_sub_field('state'); ?></td>
							<td width="16%"><?php the_sub_field('state_percent'); ?></td>
							<?php /* <td width="13%"><?php the_sub_field('deduction'); ?></td> */ ?>
							<td width="17%"><?php the_sub_field('combined_percent'); ?></td>
							<td width="60%"><a href="<?php the_sub_field('tax_rate_link'); ?>" target="_blank" rel=""><?php the_sub_field('state_tax_rate_source'); ?></a></td>
							<?php /* <td width="30%"><a href="<?php the_sub_field('deduction_link'); ?>" target="_blank" rel=""><?php the_sub_field('state_deduction_source'); ?></a></td> */ ?>
						</tr>
						<?php endwhile; ?>
					</tbody>

					<tfoot>
						<tr>
							<td colspan="6">
								<?php /* <p class="uk-text-small uk-text-muted">* States either allow a taxpayer to deduct their federal taxes from your state taxable income, have local income taxes, or have special tax treatment of capital gains income.</p> */ ?>
							</td>
						</tr>
					</tfoot>

				</table>			

				<div class="uk-article uk-text-small uk-margin-top">
					<p>The information provided here is for your general informational purposes only. These are only estimates and should not be taken as fact or considered a recommendation or personalized advisory advice. NAS Investment Solutions, LLC has made this third-party information available from sources it believes are knowledgeable and reliable. However, its accuracy or completeness cannot be guaranteed and actual rates may change due to legal or economic conditions.</p>
					<p>All investments involve risk including the possible loss of principal. You should familiarize yourself with all risks associated with any investment product before investing.</p>
				</div>
			</div>
			<div class="uk-visible-large uk-width-large-1-4 featured-property-panel">		
					
                    <?php $sidebar = [ 'post_type' => ['page'], 'page_id' => '1286' ];
                    query_posts( $sidebar );
                    
                    while ( have_posts() ) : the_post();
                      // Fetch ACF Content
                      while ( have_rows('sidebar_property') ) : the_row(); ?>
                          <div class="uk-panel uk-panel-box featured-property uk-text-center">
                          <?php if ( get_sub_field('property_photo') ) : 
                              $webiPhoto = get_sub_field('property_photo'); ?>
                              <div class="uk-panel-teaser">
                                  <img src="<?php echo $webiPhoto['url']; ?>" alt="<?php the_sub_field('property_title'); ?>">
                              </div>
                              <?php endif; ?>
                              
                              <?php if ( get_sub_field('property_title') ) : ?>
                                  <h3><?php the_sub_field('property_title'); ?></h3>
                              <?php endif; ?>
                              <div class="uk-panel-body">
                                  <?php the_sub_field('property_details'); ?>  
                              </div>
                              
                              <?php if ( get_sub_field('property_button_link') ) : ?>
                              <div class="uk-panel-footer uk-text-center">
                                  <a href="<?php echo esc_url( get_sub_field('property_button_link') ); ?>" class="uk-button uk-button-default">
                                      <?php the_sub_field('property_button_label'); ?>
                                  </a>
                              </div>
                              <?php endif; ?>
                          </div>
                      <?php endwhile; // End of ACF

                      // Fetch ACF Content
                      while ( have_rows('sidebar_webinar') ) : the_row(); ?>
                          <div class="uk-panel uk-panel-box featured-property uk-text-center">
                          <?php if ( get_sub_field('webinar_photo') ) : 
                              $webiPhoto = get_sub_field('webinar_photo'); ?>
                              <div class="uk-panel-teaser">
                                  <img src="<?php echo $webiPhoto['url']; ?>" alt="<?php the_sub_field('webinar_title'); ?>">
                              </div>
                              <?php endif; ?>
                              
                              <?php if ( get_sub_field('webinar_title') ) : ?>
                                  <h3><?php the_sub_field('webinar_title'); ?></h3>
                              <?php endif; ?>
                              <div class="uk-panel-body">
                                  <?php the_sub_field('webinar_details'); ?>  
                              </div>
                              
                              <?php if ( get_sub_field('webinar_button_link') ) : ?>
                              <div class="uk-panel-footer uk-text-center">
                                  <a href="<?php echo esc_url( get_sub_field('webinar_button_link') ); ?>" class="uk-button uk-button-default">
                                      <?php the_sub_field('webinar_button_label'); ?>
                                  </a>
                              </div>
                              <?php endif; ?>
                          </div>
                      <?php endwhile; // End of ACF
                    endwhile; wp_reset_query(); ?>  


			</div>

		</div>

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