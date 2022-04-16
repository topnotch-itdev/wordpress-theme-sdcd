<?php
  class vcCTA extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_cta_mapping') );
      add_shortcode( 'vc_cta', array($this, 'vc_cta_html') );
    }
     
    public function vc_cta_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC CTA', 'csd'),
        'base' => 'vc_cta',
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
        ), ),
      ) );         
    }

    public function vc_cta_html($atts) {
      extract( shortcode_atts(array(
        'title' => '',
        'title_color' => '',
      ), $atts) );

      $title_style = '';

      if ($title_color != '') {
        $title_style = ' style="color: ' . $title_color . ';"';
      }

      $html = '
<section class="o-content-section t-white cta" id="cta">
	<div class="o-wrapper u-pt@tablet">
		<h2 class="u-heading u-h2 u-align-center u-centered u-mb u-mb+@mobile u-max-70@tablet"' . $title_style . '>' . $title . '</h2>
		' . do_shortcode('[contact-form-7 id="246" title="CTA"]') . '
	</div>
</section>
      ';

      return $html;
    }
  }
 
  new vcCTA();    
?>
