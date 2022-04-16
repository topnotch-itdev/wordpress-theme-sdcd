<?php
  class vcLogosSlider extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_logos_slider_mapping') );
      add_shortcode( 'vc_logos_slider', array($this, 'vc_logos_slider_html') );
    }
     
    public function vc_logos_slider_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      $args = array(
        'post_type' => 'client_partner',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
      );

      $q = new WP_Query($args);
      $logos = array();

      if ( $q->have_posts() ) {
        while ( $q->have_posts() ) {
          $q->the_post();

          $logos[get_the_title()] = get_the_ID();
        }
      }

      wp_reset_postdata();

      vc_map( array(
        'name' => __('VC Logos Slider', 'csd'),
        'base' => 'vc_logos_slider',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array( array(
          'type' => 'textfield',
          'heading' => __('Title', 'csd'),
          'param_name' => 'title',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'colorpicker',
          'heading' => __('Title Color', 'csd'),
          'param_name' => 'title_color',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'colorpicker',
          'heading' => __('Logos Background Color', 'csd'),
          'param_name' => 'logos_background_color',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'colorpicker',
          'heading' => __('Section Background Color', 'csd'),
          'param_name' => 'section_background_color',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'param_group',
          'heading' => __('Logos', 'csd'),
          'param_name' => 'logos',
          'params' => array( array(
            'type' => 'dropdown',
            'heading' => __('Logo', 'csd'),
            'param_name' => 'logo',
            'value' => $logos,
            'admin_label' => false,
            'weight' => 0,
            'group' => 'Custom Group',
          ), ),
        ), ),
      ) );         
    }

    public function vc_logos_slider_html($atts) {
      extract( shortcode_atts(array(
        'title' => '',
        'logos_background_color' => '',
        'section_background_color' => '',
        'logos' => '',
        'title_color' => '',
      ), $atts) );

      wp_enqueue_style('lightslider');
      wp_enqueue_script('lightslider');

      $logos = vc_param_group_parse_atts($atts['logos']);
      $title_style = '';

      if ($title_color != '') {
        $title_style = ' style="color: ' . $title_color . ';"';
      }

      $html = '
<section class="o-content-section t-white o-content-section" style="background: ' . $section_background_color . ';">
	<div class="o-wrapper u-pt@tablet o-wrapper--logos">
		<h2 class="u-heading u-h2 u-align-center u-centered u-mb u-mb+@mobile u-max-70@tablet"' . $title_style . '>' . $title . '</h2>
		<div class="u-logos cS-hidden">
			';

			foreach ($logos as $logo) {
				$html .= '
<div class="u-logos__item">
  <div class="u-logos__item-bg" style="background: ' . $logos_background_color . ';">
    <span class="u-logos__item-helper"></span>
    ' . get_the_post_thumbnail($logo['logo'], 'medium') . '
  </div>
</div>
				';
			}

			$html .= '
	</div>
</section>
      ';

      return $html;
    }
  }
 
  new vcLogosSlider();    
?>