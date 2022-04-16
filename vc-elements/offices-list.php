<?php
  class vcOfficesList extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_offices_list_mapping') );
      add_shortcode( 'vc_offices_list', array($this, 'vc_offices_list_html') );
    }
     
    public function vc_offices_list_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC Offices List', 'sdcd'),
        'base' => 'vc_offices_list',
        'category' => __('Custom Content Elements', 'sdcd'),            
        'params' => array( array(
          'type' => 'textfield',
          'heading' => __('Title', 'sdcd'),
          'param_name' => 'title',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), ),
      ) );         
    }

    public function vc_offices_list_html($atts) {
      extract( shortcode_atts(array(
        'title' => '',
      ), $atts) );

      $args = array(
        'post_type' => 'office',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
      );

      $q = new WP_Query($args);

      if ( $q->have_posts() ) {

      $html = '
<section class="o-content-section" data-id="1">
  <div class="u-heading u-h4 u-ph- u-pb- o-wrapper o-blue">' . $title . '</div>
    <div class="js-office-listing">
      ';

      while ( $q->have_posts() ) {
        $q->the_post();

        $address = get_field('address');
        $open_hours = get_field('open_hours');
        $phone = get_field('phone');

        $html .= '
<div class="c-info-card o-wrapper u-p- u-pv u-divider-bottom">
  <div class="u-mb-">
    <div class="u-h5 u-heading">' . get_the_title() . '</div>
  </div>
  <div class="o-layout u-stack-layout@tablet-small">
        ';

        if ($address != '') {
          $html .= '
<div class="o-layout__item u-6/12@tablet-small u-3/12@desktop u-vertical-top u-mb@tablet-small u-mb0@desktop">
  <div class="u-label u-text-16">' . __('Address', 'sdcd') . ':</div>
  <div>' . $address . '</div>
</div>
          ';
        }

        if ($open_hours != '') {
          $html .= '
<div class="o-layout__item u-6/12@tablet-small u-3/12@desktop u-vertical-top u-mb@tablet-small u-mb0@desktop">
  <div class="u-label u-text-16">' . __('Open', 'sdcd') . ':</div>
  <div>' . $open_hours . '</div>
</div>
          ';
        }

        if ($phone != '') {
          $html .= '
<div class="o-layout__item u-6/12@tablet-small u-2/12@desktop u-vertical-top u-mb-@tablet-small u-mb0@desktop">
  <div>
    <div class="u-label u-text-16">' . __('Phone', 'sdcd') . ':</div>
    <div class="u-mb-">
      <a href="tel:' . $phone . '" class="u-link">' . $phone . '</a>
    </div>
  </div>
</div>
          ';
        }

        $html .= '
    <div class="o-layout__item u-3/12@desktop u-6/12@tablet-small u-vertical-bottom-until-desktop">
      <a class="c-button c-button--narrow c-button--secondary u-pull-right@desktop" href="' . get_permalink() . '">' . __('Get in touch', 'sdcd') . '</a>
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

      }

      wp_reset_postdata();

      return $html;
    }
  }
 
  new vcOfficesList();    
?>