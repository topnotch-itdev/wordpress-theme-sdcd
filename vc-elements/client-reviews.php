<?php
  class vcClientReviews extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_client_reviews_mapping') );
      add_shortcode( 'vc_client_reviews', array($this, 'vc_client_reviews_html') );
    }
     
    public function vc_client_reviews_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC Client Reviews', 'csd'),
        'base' => 'vc_client_reviews',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array( array(
          'type' => 'textfield',
          'heading' => __('Title', 'csd'),
          'param_name' => 'title',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'attach_image',
          'heading' => __('Image', 'csd'),
          'param_name' => 'image',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'colorpicker',
          'heading' => __('Background Color', 'csd'),
          'param_name' => 'background_color',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), ),
      ) );         
    }

    public function vc_client_reviews_html($atts) {
      extract( shortcode_atts(array(
        'image' => '',
        'background_color' => '',
        'reviews' => '',
        'title' => '',
      ), $atts) );

      $background_color_style = '';
      $image_url = wp_get_attachment_url($image, 'full');

      if ($background_color != '') {
        $background_color_style = ' style="background: ' . $background_color . ';"';
      }

      $args = array(
        'post_type' => 'review',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
      );

      $q = new WP_Query($args);

      if ( $q->have_posts() ) {
        $html = '
<section class="c-text-media">
  <div class="c-text-media__text u-align-center u-6/12@desktop u-6/12@tablet-small u-p u-p+@desktop t-primary"' . $background_color_style . '>
    <div class="c-text-media__wrapper c-text-media__wrapper--content-image">
      <h2 style="text-align: center;">' . $title . '</h2>
      <div class="c-reviews-slider cS-hidden">
        ';

        while ( $q->have_posts() ) {
          $q->the_post();

          $html .= '<div class="c-reviews-slider__slide">' . get_the_content() . '</div>';
        }

        $html .= '
      </div>
    </div>
  </div>
  <div class="c-text-media__media u-6/12@desktop u-6/12@tablet-small u-hide@mobile" style="background-image: url(' . $image_url . ');"></div>
</section>
        ';
      }

      wp_reset_postdata();

      return $html;
    }
  }
 
  new vcClientReviews();    
?>