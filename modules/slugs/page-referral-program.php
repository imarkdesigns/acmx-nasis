<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">
<?php ## If page is NOT password protected
    if ( ! post_password_required() ) : ?>

    <section class="uk-block referIntro">
        <div class="uk-container">
            
            <div class="uk-grid" data-uk-grid-margin>
                
                <div class="uk-width-medium-2-3">
                    <article class="uk-article">
                        <p class="uk-article-lead"><?php the_field('lead_paragraph'); ?></p>
                        <?php the_field('article_content'); ?>
                    </article>
                </div>
                
                <div class="uk-width-medium-1-3 uk-flex uk-flex-center">
                    <figure> <?php $attachedPhoto = get_field('attached_photo');
                        echo wp_get_attachment_image( $attachedPhoto['id'], [ 480, 480, true ], '', [ 'class' => 'uk-thumbnail' ] ); ?>
                    </figure>
                </div>
            
            </div>
            
        </div>
    </section>

    <section id="referralForm" class="uk-block referForm">
        <a href="#referResponseClient" class="clientResponseMessage" data-uk-modal="{center:true}"></a>
        <a href="#referResponseFriend" class="friendResponseMessage" data-uk-modal="{center:true}"></a>
        
        <div class="uk-grid uk-grid-collapse">
            <figure class="uk-overlay uk-width-large-1-2">
                <?php $bgLeftPanel = get_field('bg_left_panel');
                echo wp_get_attachment_image( $bgLeftPanel['id'], [ 1280, 720, true ] ); ?>
                <div class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle">
                    <?php while( have_rows( 'headings_left_panel' ) ) : the_row(); ?>
                    <div class="uk-panel">
                        
                        <h2><?php the_sub_field('title'); ?></h2>
                        <?php if ( get_sub_field('description') != '' ) :
                            echo '<p>'. get_sub_field('description') .'</p>';
                        endif; ?>
                        <button type="button" class="uk-button uk-button-primary uk-button-large" data-uk-modal="{target:'#referForm', center:true}">Refer A Friend Now</button>
                        
                    </div>
                    <?php endwhile; ?>
                </div>
            </figure>
            <figure class="uk-overlay uk-width-large-1-2 referredForm">
                <?php $bgRightPanel = get_field('bg_right_panel');
                echo wp_get_attachment_image( $bgRightPanel['id'], [ 1280, 720, true ] ); ?>
                <div class="uk-overlay-panel uk-overlay-background uk-flex uk-flex-center uk-flex-middle">
                    <?php while( have_rows( 'headings_right_panel' ) ) : the_row(); ?>
                    <div class="uk-panel">
                        
                        <h2><?php the_sub_field('title'); ?></h2>
                        <?php 
                            $wpFormsRP = get_field('shortcode_right_panel'); 
                            echo do_shortcode( $wpFormsRP ); 
                        ?>
                        
                    </div>
                    <?php endwhile; ?>
                </div>
            </figure>
        </div>

    </section>
    
    <?php $background = get_field('quote_background_photo'); ?>
    <section class="uk-block referQuote" style="background: url(<?php echo $background['url']; ?>) no-repeat center / cover;">
        <div class="uk-overlay-panel uk-overlay-background"></div>
        <div class="uk-container uk-container-small">
            
            <blockquote class="uk-text-center">
                <p><?php the_field('quote_content'); ?></p>
                <footer>
                    <?php the_field('quote_citation_label'); ?>
                </footer>
            </blockquote>
            
            <p class="uk-text-center">
                <a href="https://www.nasassets.com/outreach" rel="follow" class="uk-button- uk-button-primary uk-button-large"><?php the_field('quote_button_label'); ?></a>
            </p>
            
        </div>
    </section>

    <?php $enable = get_field('rss_control'); 
    if ( $enable == 'enable' ) : ?>
    <section class="uk-block americanRedCrossFeed">
        
        <div class="uk-container uk-container-small uk-text-center">
            
            <?php the_field('rss_feed_headings'); ?>
            
        </div>        
        <div class="uk-container uk-container-large uk-margin-top">
            
            <article class="uk-article">
            <?php the_field('rss_feed_aggregator_hook'); ?>
            </article>
            
        </div>
        
    </section>
    <?php endif; ?>

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

<?php endif; ?>
</main>

<?php 
  
// Router Selection
$router = get_field('theme_router');

switch($router) :

    case 'team' :
        get_template_part( _router, 'team' );
        break;

    case 'team_info' :
        get_template_part( _router, 'team-details' );
        break;
    
    default :
        get_template_part( _router, 'colophon' );
        break;

endswitch;

?>

<?php ### REFERRER FORM ### ?>
<div id="referForm" class="uk-modal">
    <div class="uk-modal-dialog">
        <button type="button" class="uk-modal-close uk-close"></button>
        
        <?php while( have_rows( 'headings_left_panel' ) ) : the_row(); ?>
        <div class="uk-panel">
        
            <h2><?php the_sub_field('title'); ?></h2>
            <?php if ( get_sub_field('description') != '' ) :
                echo '<p>'. get_sub_field('description') .'</p>';
            endif;
            
            $wpFormsLP = get_field('shortcode_left_panel'); 
            echo do_shortcode( $wpFormsLP ); ?>
        
        </div>
        <?php endwhile; ?>
        
    </div>
</div>


<?php ### REFERRAL FORM RESPONSE ?>
<div id="referResponseClient" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                
        <?php $clientBG = get_field('client_message_bg'); ?>
        <div class="uk-panel">
            <div class="uk-panel-teaser">
                <?php echo wp_get_attachment_image( $clientBG['id'], [ 1280, 720 ] ); ?>
            </div>
            <article class="uk-article uk-text-center">
                <?php the_field('client_message'); ?>
            </article>
        </div>
        
        <div class="uk-modal-footer">
            <button class="uk-button uk-modal-close">Dismiss Window</button>
        </div>
    </div>
</div>

<div id="referResponseFriend" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-lightbox">
        
        <?php $friendBG = get_field('friend_message_bg'); ?>
        <div class="uk-panel">
            <div class="uk-panel-teaser">
                <?php echo wp_get_attachment_image( $friendBG['id'], [ 1280, 720 ] ); ?>
            </div>
            <article class="uk-article uk-text-center">
                <?php the_field('friend_message'); ?>
            </article>
        </div>
        
        <div class="uk-modal-footer">
            <button class="uk-button uk-modal-close">Dismiss Window</button>
        </div>        
    </div>
</div>





























