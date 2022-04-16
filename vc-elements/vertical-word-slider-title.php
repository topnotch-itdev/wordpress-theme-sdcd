<?php
  class vcVerticalWordSliderTitle extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_vertical_word_slider_title_mapping') );
      add_shortcode( 'vc_vertical_word_slider_title', array($this, 'vc_vertical_word_slider_title_html') );
    }
     
    public function vc_vertical_word_slider_title_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC Vertical Word Slider', 'csd'),
        'base' => 'vc_vertical_word_slider_title',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array( array(
          'type' => 'textfield',
          'heading' => __('Text Before Slider', 'csd'),
          'param_name' => 'text_before_slider',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ),  array(
          'type' => 'textfield',
          'heading' => __('Text After Slider', 'csd'),
          'param_name' => 'text_after_slider',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'param_group',
          'heading' => __('Slide Words', 'csd'),
          'param_name' => 'slide_words',
          'params' => array( array(
            'type' => 'textfield',
            'heading' => __('Word', 'csd'),
            'param_name' => 'word',
            'admin_label' => false,
            'weight' => 0,
            'group' => 'Custom Group',
          ), ),
        ), ),
      ) );         
    }

    public function vc_vertical_word_slider_title_html($atts) {
      extract( shortcode_atts(array(
        'text_before_slider' => '',
        'text_after_slider' => '',
        'slide_words' => '',
      ), $atts) );

      wp_enqueue_script('jquery-ui');

      $slide_words = vc_param_group_parse_atts($atts['slide_words']);

      $html = '
<section class="o-content-section" data-component="simple-intro">
  <div class="o-wrapper">
    <div class="s-editorial-container">
      <div class="s-editorial s-intro">
        <h4 class="s-editorial--title-no-margin" style="margin-bottom:10px;font-size:32px;">' . $text_before_slider . ' <span class="word-rotate active"><span class="word-rotate-items">
      ';

      foreach ($slide_words as $word) {
        $html .= '<span style="color:#000000;">' . $word['word'] . '</span>';
      }

      $html .= '
        </span></span> ' . $text_after_slider . '</h4>
      </div>
    </div>
  </div>
</section>
      ';

      return $html;
    }
  }
 
  new vcVerticalWordSliderTitle();    
?>