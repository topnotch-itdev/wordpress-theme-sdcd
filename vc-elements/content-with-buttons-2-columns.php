<?php
  class vcContentWithButtons2Columns extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_content_with_buttons_2_columns_mapping') );
      add_shortcode( 'vc_content_with_buttons_2_columns', array($this, 'vc_content_with_buttons_2_columns_html') );
    }
     
    public function vc_content_with_buttons_2_columns_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC Content With Buttons (2 Columns)', 'csd'),
        'base' => 'vc_content_with_buttons_2_columns',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array( array(
          'type' => 'textfield',
          'heading' => __('Left Title', 'csd'),
          'param_name' => 'left_title',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'textfield',
          'heading' => __('Left Content', 'csd'),
          'param_name' => 'left_content',
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
          'type' => 'textfield',
          'heading' => __('Right Title', 'csd'),
          'param_name' => 'right_title',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'textfield',
          'heading' => __('Right Content', 'csd'),
          'param_name' => 'right_content',
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

    public function vc_content_with_buttons_2_columns_html($atts) {
      extract( shortcode_atts(array(
        'left_title' => '',
        'left_content' => '',
        'left_link' => '',
        'right_title' => '',
        'right_content' => '',
        'right_link' => '',
      ), $atts) );

      $left_link = vc_build_link($left_link);
      $right_link = vc_build_link($right_link);

      $html = '
<section class="u-align-center o-layout o-layout--flush o-gutter">
  <section class="o-layout__item c-fifty-fifty u-6/12@tablet-small u-pb+@tablet-small u-hide@tablet-small">
    <div class="c-fifty-fifty__wrapper u-pv">
      <div class="c-fifty-fifty__content">
        <div class="u-label u-h5">' . $left_title . '</div>
        <div class="u-pb">
          <p>' . $left_content . '</p>
        </div>
        <a href="' . $left_link['url'] . '" class="c-button c-button--secondary" target="' . $left_link['target'] . '" rel="' . $left_link['rel'] . '">' . $left_link['title'] . '</a>
      </div>
    </div>
  </section>
  <section class="o-layout__item c-fifty-fifty u-6/12@tablet-small u-pb+@tablet-small u-hide@tablet-small">
    <div class="c-fifty-fifty__wrapper u-pv">
      <div class="c-fifty-fifty__content">
        <div class="u-label u-h5">' . $right_title . '</div>
        <div class="u-pb">
          <p>' . $right_content . '</p>
        </div>
        <a href="' . $right_link['url'] . '" class="c-button c-button--secondary" target="' . $right_link['target'] . '" rel="' . $right_link['rel'] . '">' . $right_link['title'] . '</a>
      </div>
    </div>
  </section>
</section>
      ';

      return $html;
    }
  }
 
  new vcContentWithButtons2Columns();    
?>