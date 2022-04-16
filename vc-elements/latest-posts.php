<?php
  class vcLatestPosts extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_latest_posts_mapping') );
      add_shortcode( 'vc_latest_posts', array($this, 'vc_latest_posts_html') );
    }
     
    public function vc_latest_posts_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC Latest Posts', 'csd'),
        'base' => 'vc_latest_posts',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array(),
      ) );         
    }

    public function vc_latest_posts_html() {
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'post_status' => 'publish',
      );

      $q = new WP_Query($args);
      $html = '';

      global $post;

      if ( $q->have_posts() ) {
        $html .= '
<section class="o-content-section t-white">
  <div class="o-wrapper u-pt@tablet">
    <h2 class="u-heading u-h2 u-align-center u-centered u-mb u-mb+@mobile u-max-70@tablet">' . __('Our Blog', 'csd') . '</h2>
    <div class="o-layout o-layout--large o-layout--trio o-flex-layout u-stack-layout@mobile u-mb--">
        ';

        while ( $q->have_posts() ) {
          $q->the_post();

          $post_thumbnail_url = get_the_post_thumbnail_url();

          $html .= '
            <div class="o-layout__item o-flex-layout__item u-4/12@desktop u-6/12@mobile">
              <a href="' . get_permalink() . '" class="c-card c-card--flex u-align-center">
                <noscript>
                  <style>
                    .img-' . $post->post_name . ' {
                      background-image: url("' . $post_thumbnail_url . '");
                    }
                  </style>
                </noscript>
                <div class="c-card__image js-background-img img-' . $post->post_name . '" data-initial="' . $post_thumbnail_url . '" data-optimized="' . $post_thumbnail_url . '"></div>
                <div class="c-card__content u-p">
                  <div class="u-h5 u-label c-card__label">' . $post->post_title . '</div>
                  <div class="u-copy u-text-16 u-label u-pv-">
                    <time pubdate="pubdate">' . get_the_date('F j, Y') . '</time>
                  </div>
                  <div class="u-copy">' . get_the_excerpt() . '</div>
                  <div class="u-link u-mt-- u-bold-font">' . __('View', 'csd') . '</div>
                </div>
              </a>
            </div>
          ';
        }

        $html .= '
    </div>
  </div>
</section>
        ';
      }

      return $html;
    }
  }
 
  new vcLatestPosts();    
?>