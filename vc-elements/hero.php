<?php
  class vcHero extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_hero_mapping') );
      add_shortcode( 'vc_hero', array($this, 'vc_hero_html') );
    }
     
    public function vc_hero_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC Hero', 'csd'),
        'base' => 'vc_hero',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array( array(
          'type' => 'attach_image',
          'heading' => __('Background Image', 'csd'),
          'param_name' => 'background_image',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'textfield',
          'heading' => __('Blue Part Of Title', 'csd'),
          'param_name' => 'blue_part_of_title',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'textfield',
          'heading' => __('White Part Of Title', 'csd'),
          'param_name' => 'white_part_of_title',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), ),
      ) );         
    }

    public function vc_hero_html($atts) {
      extract( shortcode_atts(array(
        'background_image' => '',
        'blue_part_of_title' => '',
        'white_part_of_title' => '',
      ), $atts) );

      $background_image_url = wp_get_attachment_url($background_image, 'full');

      $html = '
<style>
  .u-h1 .markdown {
    color: #38adce;
  }
</style>
<section class="c-hero-content t-dark">
  <picture class="c-hero-content__image-container js-rellax">
    <source srcset="' . $background_image_url . '" media="(min-width: 30em)">
    <img srcset="' . $background_image_url . '" alt="…" class="c-hero-content__image js-object-fit-image">
    <div class="js-object-fit-fb u-objectfit-fallback"></div>
  </picture>
  <div>
    <div class="c-hero-content__content">
      <h1 class="c-hero-content__heading u-heading u-h1 u-centered"><span class="markdown">' . $blue_part_of_title . '</span> ' . $white_part_of_title . '</h1>
    </div>
  </div>
</section>
      ';

      return $html;
    }
  }
 
  new vcHero();    
?>