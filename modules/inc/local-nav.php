<nav class="uk-navbar local-nav uk-visible-large">
    <div class="uk-container uk-container-large">
        <div class="overflow">
            <ul class="uk-subnav uk-subnav-line">
                <li><a href="<?php echo __(site_url('webinar')); ?>">Webinar</a></li>
                <?php if ( $post->ID != 1279 ) {
                    echo '<li><a href="'.__(site_url('1031-exchange-information#NASISTaxRates')).'">Tax Rates by State</a></li>';
                } else {
                    echo '<li><a href="#TaxRates" data-uk-smooth-scroll="{offset: 70}">Tax Rates by State</a></li>';
                } ?>
                <li><a href="<?php echo __(site_url('1031-exchange-information/1031-exchange-calculator')); ?>">1031 Exchange Calculator</a></li>
                <li><a href="<?php echo __(site_url('1031-exchange-information/1031-exchange-articles')); ?>">Real Estate investment Articles</a></li>
                <li><a href="<?php echo __(site_url('1031-exchange-information/faqs')); ?>">FAQ’s</a></li>
                <li><a href="<?php echo __(site_url('1031-exchange-information/glossary')); ?>">Glossary</a></li>
                <li><a href="<?php echo __(site_url('1031-exchange-information?q=guide#NASISEIG')); ?>">Download 1031 Guide</a></li>
            </ul>
        </div>
    </div>
</nav>