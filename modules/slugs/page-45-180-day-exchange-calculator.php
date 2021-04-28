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
        <li><a href="<?php echo __(site_url('1031-exchange-information#TaxRates')); ?>">Tax Rates by State</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/1031-exchange-articles')); ?>">Real Estate investment Articles</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/faqs')); ?>">FAQ’s</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information#EIG')); ?>">Download 1031 Guide</a></li>
        <li><a href="<?php echo __(site_url('1031-exchange-information/glossary')); ?>">Glossary</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="main" role="main">

  <section class="uk-block exchange-calculator">
  	<div class="uk-container uk-container-large">

	  <div class="uk-grid" data-uk-grid-margin>
		<div class="uk-width-medium-1-1 uk-width-large-3-4">

  		<?php the_field( 'content' ); ?>

		<script Language='JavaScript'>
		function computeFutureDate(now_mo, now_day, now_yr, days_to_add, dt_format) {

		    var dbl_dgt = new Array("00", "01", "02", "03", "04", "05", "06", "07", "08", "09");
		    var day_str = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
		    var day_str_abrev = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
		    var month_str = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		    var month_str_abrev = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

		    var now_date_str = month_str[now_mo - 1] + " " + now_day + ", " + now_yr + " 12:00:00";
		    var now_date = new Date(now_date_str);
		    var now_ms = now_date.getTime();
		    var now_year = now_date.getFullYear();
		    var future_ms = eval(now_ms) + eval(days_to_add * 86400000);
		    var future_date = new Date(future_ms);
		    //var future_date = future_date.setTime(future_ms);
		    var future_mo = eval(future_date.getMonth()) + eval(1);
		    var future_day = future_date.getDate();
		    var future_wkday = future_date.getDay();
		    var future_yr = future_date.getFullYear();
		    var future_mo_str = future_mo.toString();
		    var future_day_str = future_day.toString();
		    var future_yr_str = future_yr.toString();
		    var future_date_str = "";

		    if (dt_format == 0) {
		        future_date_str = future_mo + "/" + future_day + "/" + future_yr;
		    } else

		    if (dt_format == 1) {

		        if (future_mo < 10) {
		            future_mo_str = dbl_dgt[future_mo];
		        }
		        if (future_day < 10) {
		            future_day_str = dbl_dgt[future_day];
		        }
		        if (future_yr_str.length == 4) {
		            future_yr_str = future_yr_str.substring(2, 4);
		        }

		        future_date_str = future_mo_str + "/" + future_day_str + "/" + future_yr_str;
		    } else

		    if (dt_format == 2) {

		        if (future_mo < 10) {
		            future_mo_str = dbl_dgt[future_mo];
		        }
		        if (future_day < 10) {
		            future_day_str = dbl_dgt[future_day];
		        }
		        future_date_str = future_mo_str + "/" + future_day_str + "/" + future_yr;
		    } else

		    if (dt_format == 3) {
		        if (future_mo < 10) {
		            future_mo_str = dbl_dgt[future_mo];
		        }
		        if (future_day < 10) {
		            future_day_str = dbl_dgt[future_day];
		        }
		        future_date_str = future_yr + "-" + future_mo_str + "-" + future_day_str;
		    } else

		    if (dt_format == 4) {
		        future_date_str = month_str_abrev[future_mo - 1] + " " + future_day + ", " + future_yr;
		    } else

		    if (dt_format == 5) {
		        future_date_str = month_str[future_mo - 1] + " " + future_day + ", " + future_yr;
		    } else

		    if (dt_format == 6) {
		        future_date_str = day_str_abrev[future_wkday] + " " + month_str_abrev[future_mo - 1] + " " + future_day + ", " + future_yr;
		    } else

		    if (dt_format == 7) {
		        future_date_str = day_str[future_wkday] + " " + month_str[future_mo - 1] + " " + future_day + ", " + future_yr;
		    }

		    return future_date_str;
		}

		function calc_days(form) {

		    var v_month = document.calc.month.options[document.calc.month.selectedIndex].value;
		    var v_day = document.calc.day.options[document.calc.day.selectedIndex].value;
		    var v_year = document.calc.year.options[document.calc.year.selectedIndex].value;

		    var v_day_45 = computeFutureDate(v_month, v_day, v_year, 45, 7);
		    document.calc.day_45.value = v_day_45;

		    var v_day_180 = computeFutureDate(v_month, v_day, v_year, 180, 7);
		    document.calc.day_180.value = v_day_180;

		}

		function clear_results(form) {

		    document.calc.day_45.value = "";
		    document.calc.day_180.value = "";

		}
		</script>

		<form action="#" method="post" name="calc" class="uk-form">
			<div class="uk-panel uk-panel-header uk-text-center">
				<h3 class="uk-panel-title"> <?php the_field( 'heading_label' ); ?> </h3>

				<fieldset>
					<div class="uk-grid uk-grid-width-medium-1-3 uk-grid-small">
	                <script language="javascript">
	                    var now_date = new Date();
	                    var now_year = now_date.getFullYear();
	                    var now_month = now_date.getMonth() + 1;
	                    var now_day = now_date.getDate();
	                    var month_arr = new Array("blank", "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
	                    var i = 0;

	                    document.write("<div><select name='month' size='1' onChange='clear_results(this.form);calc_days(this.form)'>\n");
	                    for (i = 1; i < 13; i++) {
	                        if (i == now_month) {
	                            document.write("<option value='" + i + "' selected>" + month_arr[i] + "</option>\n");
	                        } else {
	                            document.write("<option value='" + i + "'>" + month_arr[i] + "</option>\n");
	                        }
	                    }
	                    document.write("</select></div> \n");
	                    document.write("<div><select name='day' size='1' onChange='clear_results(this.form);calc_days(this.form)'>\n");
	                    for (i = 1; i < 32; i++) {
	                        if (i == now_day) {
	                            document.write("<option value='" + i + "' selected>" + i + "</option>\n");
	                        } else {
	                            document.write("<option value='" + i + "'>" + i + "</option>\n");
	                        }
	                    }
	                    document.write("</select></div> \n");
	                    document.write("<div><select name='year' size='1' onChange='clear_results(this.form);calc_days(this.form)'>\n");
	                    var year_ago = Number(now_year) - Number(1);
	                    var years_ahead = Number(year_ago) + Number(6);
	                    for (i = year_ago; i < years_ahead; i++) {
	                        if (i == now_year) {
	                            document.write("<option value='" + i + "' selected>" + i + "</option>\n");
	                        } else {
	                            document.write("<option value='" + i + "'>" + i + "</option>\n");
	                        }
	                    }
	                    document.write("</select></div> \n");
	                </script>
	            	</div>
            	</fieldset>

                <div class="uk-display-block">
                	<input type="reset" class="uk-button uk-button-default" value="Reset">
                	<input type="button" class="uk-button uk-button-primary" value="<?php the_field( 'calculate_button' ) ?>" onclick="calc_days(this.form)">
            	</div>

                <hr>

                <div class="uk-margin-bottom" data-children-count="1">
                	<label for=""> <?php the_field( 'day_45' ); ?> </label>
                	<input type="text" name="day_45" class="uk-form-width-large" readonly>
                </div>

                <div data-children-count="1">
                	<label for=""> <?php the_field( 'day_180' ); ?> </label>
                	<input type="text" name="day_180" class="uk-form-width-large" readonly>
                </div>

			</div>
		</form>
		
		</div>

		<div class="uk-width-large-1-4 featured-property-panel">

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
	  
	  <?php if ( get_field( 'disclaimer' ) != '' ) : ?>

<hr>

<aside class="disclaimer">
	<?php the_field( 'disclaimer' ); ?>
</aside>

<?php endif; ?>

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