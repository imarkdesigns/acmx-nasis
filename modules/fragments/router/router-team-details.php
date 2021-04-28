<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ 

?>

<aside class="uk-block teamDetails">
    <?php if ( get_field('team_slider_headings') != '' ) : ?>
    <div class="uk-container uk-container-small">
        <?php the_field('team_slider_headings'); ?>
    </div>
    <?php endif; ?>
    
    <div class="uk-container uk-container-expand">        
    
<div class="uk-slidenav-position" data-uk-slider>

    <div class="uk-slider-container">
        <ul class="uk-slider uk-grid-medium uk-grid-width-small-1-1 uk-grid-width-medium-1-3 uk-grid-width-xlarge-1-6">
            <?php while ( have_rows('team_detailed_slider') ) : the_row(); ?>
            <li>

                <div class="uk-panel uk-text-center">
                    <div class="uk-panel-teaser">
                        <?php $avatar = get_sub_field('profile_display_photo');
                        echo wp_get_attachment_image( $avatar['id'], [ 480, 480, true ], '', [ 'class' => 'uk-thumbnail uk-border-rounded' ] ); ?>
                    </div>
                    <h4><?php the_sub_field('profile_name'); ?> <small><?php the_sub_field('profile_designation'); ?></small></h4>
                    <p><?php the_sub_field('profile_description'); ?></p>
                </div>

            </li>
            <?php endwhile; ?>
        </ul>
    </div>

    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-previous" data-uk-slider-item="previous"></a>
    <a href="" class="uk-slidenav uk-slidenav-contrast uk-slidenav-next" data-uk-slider-item="next"></a>    

</div>    
    
    </div>
</aside>