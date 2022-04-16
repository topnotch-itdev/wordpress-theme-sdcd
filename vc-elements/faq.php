<?php
  class vcFAQ extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_faq_mapping') );
      add_shortcode( 'vc_faq', array($this, 'vc_faq_html') );
    }
     
    public function vc_faq_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC FAQ', 'csd'),
        'base' => 'vc_faq',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array( array(
          'type' => 'textfield',
          'heading' => __('Title', 'csd'),
          'param_name' => 'title',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'param_group',
          'heading' => __('Questions', 'csd'),
          'param_name' => 'questions',
          'params' => array( array(
            'type' => 'textfield',
            'heading' => __('Question', 'csd'),
            'param_name' => 'question',
            'admin_label' => false,
            'weight' => 0,
            'group' => 'Custom Group',
          ), array(
            'type' => 'textfield',
            'heading' => __('Answer', 'csd'),
            'param_name' => 'answer',
            'admin_label' => false,
            'weight' => 0,
            'group' => 'Custom Group',
          ), ),
        ), ),
      ) );         
    }

    public function vc_faq_html($atts) {
      extract( shortcode_atts(array(
        'title' => '',
        'questions' => '',
      ), $atts) );

      $questions = vc_param_group_parse_atts($atts['questions']);

      $html = '
<section class="o-content-section">
  <div class="o-wrapper u-pv0" style="padding-left:0;">
    <h2 class="u-heading u-h2 u-mb u-mb+@mobile u-align-center u-block u-heading--blue">' . $title . '</h2>
    <div>
      ';

      foreach ($questions as $question) {
        $html .= '
<div class="c-reveal c-reveal--plain t-white">
  <a href="#" class="c-reveal__toggle c-button--icon c-button--white u-lead u-p js-reveal-toggle">
    <div class="c-reveal__toggle--inner"></div>
    <div class="u-inline-block--middle u-mr- u-heading u-h4 u-color-primary u-hide@mobile">' . __('', 'csd') . '</div>
    <div class="u-inline-block--middle u-bold-font u-max-90">' . do_shortcode($question['question']) . '</div>
    <div class="c-button__icon c-button--icon--big c-svg-icon--circle c-svg-icon--primary">
      <svg id="arrow_1_" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22.7 14.2">
        <path id="arrow" d="M11.3 12.9L.6 4.6 3 1.4l8.3 6.5 8.3-6.5 2.5 3.2z" />
      </svg>
    </div>
  </a>
  <div class="c-reveal__content">
    <div class="c-reveal__content-inner s-editorial s-reveal-wysiwyg u-pt0 u-mt0">
      <div class="u-inline-block--top u-mr- u-h4 u-heading u-color-grey-darker u-hide@mobile">' . __('', 'csd') . '</div>
      <div class="u-inline-block--middle u-max-90@mobile">' . do_shortcode($question['answer']) . '</div>
    </div>
  </div>
</div> 
        ';
      }

      $html .= '
    </div>
  </div>
</section>
      ';

      return $html;
    }
  }
 
  new vcFAQ();    
?>