<?php
  class vcTextBlock extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_text_block_mapping') );
      add_shortcode( 'vc_text_block', array($this, 'vc_text_block_html') );
    }
     
    public function vc_text_block_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC Text Block', 'csd'),
        'base' => 'vc_text_block',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array( array(
          'type' => 'textarea_html',
          'heading' => __('Conten', 'csd'),
          'param_name' => 'content',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), ),
      ) );         
    }

    public function vc_text_block_html($atts, $content = null) {
      $content = wpb_js_remove_wpautop($content, true);

      $html = '
<section class="o-content-section" data-component="simple-intro">
  <div class="o-wrapper">
    <div class="s-editorial-container">
      <div class="s-editorial s-intro">' . $content . '</div>
    </div>
  </div>
</section>
      ';

      return $html;
    }
  }
 
  new vcTextBlock();    
?>