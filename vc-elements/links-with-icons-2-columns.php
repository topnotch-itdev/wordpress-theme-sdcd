<?php
  class vcLinksWithIcons2Columns extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_links_with_icons_2_columns_mapping') );
      add_shortcode( 'vc_links_with_icons_2_columns', array($this, 'vc_links_with_icons_2_columns_html') );
    }
     
    public function vc_links_with_icons_2_columns_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC Links With Icons (2 Columns)', 'csd'),
        'base' => 'vc_links_with_icons_2_columns',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array( array(
          'type' => 'attach_image',
          'heading' => __('Left Icon', 'csd'),
          'param_name' => 'left_icon',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'vc_link',
          'heading' => __('Left Link', 'csd'),
          'param_name' => 'left_link',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'attach_image',
          'heading' => __('Right Icon', 'csd'),
          'param_name' => 'right_icon',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'vc_link',
          'heading' => __('Right Link', 'csd'),
          'param_name' => 'right_link',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), ),
      ) );         
    }

    public function vc_links_with_icons_2_columns_html($atts) {
      extract( shortcode_atts(array(
        'left_icon' => '',
        'left_link' => '',
        'right_icon' => '',
        'right_link' => '',
      ), $atts) );

      $left_icon_url = wp_get_attachment_url($left_icon, 'full');
      $right_icon_url = wp_get_attachment_url($right_icon, 'full');
      $left_link = vc_build_link($left_link);
      $right_link = vc_build_link($right_link);

      $html = '
<div class="u-align-center o-layout o-layout--flush u-flex@tablet-small">
  <a href="' . $left_link['url'] . '" class="_editable o-layout__item u-6/12@tablet-small t-tertiary u-pv c-fifty-fifty__header" target="' . $left_link['target'] . '" rel="' . $left_link['rel'] . '">
    <div class="c-fifty-fifty__wrapper">
      <div class="u-inline-block--middle u-pr--">
        <div class="c-fifty-fifty__header-icon">
          <img src="' . $left_icon_url . '" alt="">
        </div>
      </div>
      <div class="u-inline-block--middle u-label u-max-60 u-align-left c-fifty-fifty__heading">' . $left_link['title'] . '</div>
    </div>
  </a>
  <a href="' . $right_link['url'] . '" class="_editable o-layout__item u-6/12@tablet-small t-tertiary u-pv c-fifty-fifty__header" target="' . $right_link['target'] . '" rel="' . $right_link['rel'] . '">
    <div class="c-fifty-fifty__wrapper">
      <div class="u-inline-block--middle u-pr--">
        <div class="c-fifty-fifty__header-icon">
          <img src="' . $right_icon_url . '" alt="">
        </div>
      </div>
      <div class="u-inline-block--middle u-label u-max-60 u-align-left c-fifty-fifty__heading">' . $right_link['title'] . '</div>
    </div>
  </a>
</div>
      ';

      return $html;
    }
  }
 
  new vcLinksWithIcons2Columns();    
?>