<?php /**
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package NAS Investment Solutions
 * @version 1.0
**/ ?>

<main class="main" role="main">

  <section id="section-sitemap" class="uk-block">
    <div class="uk-container uk-container-small">

      <article class="uk-article section-full-page-list">

        <?php
          $page = new WP_Query([ 'post_type' => 'page', 'posts_per_page' => '-1', 'post_status' => 'publish', 'has_password' => false, 'order' => 'asc', 'post__not_in' => [ 234, 465, 20, 22, 24, 386, 388  ] ]);
          $team = new WP_Query([ 'post_type' => 'nasis_team', 'posts_per_page' => '-1', 'post_status' => 'publish', 'order' => 'asc' ]);
          $news = new WP_Query([ 'post_type' => 'post', 'posts_per_page' => '-1', 'order' => 'asc' ]);
          $articles = new WP_Query([ 'post_type' => 'exchange_articles', 'posts_per_page' => '-1', 'order' => 'asc' ]);
          $property = new WP_Query([ 'post_type' => 'nasis_investments', 'posts_per_page' => '-1', 'post_status' => 'publish', 'has_password' => false, 'order' => 'asc', 'post__not_in' => [ 1702 ] ]);
        ?>

        <div class="section-content">
          <div class="section-sitemap">
            <div class="section-sitemap-pages">
              <h4>NAS Investment Solutions</h4>
              <ul>
              <?php while ($page->have_posts()) : $page->the_post();
                echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
              endwhile; wp_reset_postdata(); ?>
              </ul>
            </div>
          </div>

          <div class="section-sitemap">
            <div class="section-sitemap-team">
              <h4>NAS Investment Solutions - Team</h4>
              <ul>
              <?php while ($team->have_posts()) : $team->the_post();
                echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
              endwhile; wp_reset_postdata(); ?>
              </ul>
            </div>
          </div>

          <div class="section-sitemap">
            <div class="section-sitemap-news">
              <h4>NAS Investment Solutions - News</h4>
              <ul>
              <?php while ($news->have_posts()) : $news->the_post();
                echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
              endwhile; wp_reset_postdata(); ?>
              </ul>
            </div>
          </div>

          <div class="section-sitemap">
            <div class="section-sitemap-news">
              <h4>NAS Investment Solutions - Exchange Articles</h4>
              <ul>
              <?php while ($articles->have_posts()) : $articles->the_post();
                echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
              endwhile; wp_reset_postdata(); ?>
              </ul>
            </div>
          </div>

          <div class="section-sitemap">
            <div class="section-sitemap-investments">
              <h4>NAS Investment Solutions - Investments Property</h4>
              <ul>
              <?php while ($property->have_posts()) : $property->the_post();
                echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
              endwhile; wp_reset_postdata(); ?>
              </ul>
            </div>
          </div>
        </div>

      </article>

    </div>
  </section>

</main>