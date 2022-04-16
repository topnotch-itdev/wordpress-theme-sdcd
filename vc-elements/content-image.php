<?php
  class vcContentImage extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_content_image_mapping') );
      add_shortcode( 'vc_content_image', array($this, 'vc_content_image_html') );
    }
     
    public function vc_content_image_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC Content + Image', 'csd'),
        'base' => 'vc_content_image',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array( array(
          'type' => 'attach_image',
          'heading' => __('Image', 'csd'),
          'param_name' => 'image',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'textarea_html',
          'heading' => __('Content', 'csd'),
          'param_name' => 'content',
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
        ), array(
          'type' => 'vc_link',
          'heading' => __('Button', 'csd'),
          'param_name' => 'button',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), ),
      ) );         
    }

    public function vc_content_image_html($atts, $content = null) {
      extract( shortcode_atts(array(
        'image' => '',
        'button' => '',
        'background_color' => '',
      ), $atts) );

      $content = wpb_js_remove_wpautop($content, true);
      $button = vc_build_link($button);
      $background_color_style = '';
      $image_url = wp_get_attachment_url($image, 'full');

      if ($background_color != '') {
        $background_color_style = ' style="background: ' . $background_color . ';"';
      }

      $button_content = '';

      if ( !empty($button['url']) ) {
        $button_content = '
<div class="u-mt">
  <a href="' . $button['url'] . '" class="c-button c-button--secondary" target="' . $button['target'] . '" rel="' . $button['rel'] . '">' . $button['title'] . '</a>
</div>
        ';
      }

      $html = '
<section class="c-text-media">
  <div class="c-text-media__text u-align-center u-6/12@desktop u-6/12@tablet-small u-p u-p+@desktop t-primary"' . $background_color_style . '>
    <div class="c-text-media__wrapper c-text-media__wrapper--content-image">' . $content . $button_content . '</div>
  </div>
  <div class="c-text-media__media u-6/12@desktop u-6/12@tablet-small u-hide@mobile" style="background-image: url(' . $image_url . ');"></div>
</section>
      ';

      return $html;
    }
  }
 
  new vcContentImage();    
?>