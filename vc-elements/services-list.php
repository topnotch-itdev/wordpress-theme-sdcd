<?php
  class vcServicesList extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_services_list_mapping') );
      add_shortcode( 'vc_services_list', array($this, 'vc_services_list_html') );
    }
     
    public function vc_services_list_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      $menus = get_registered_nav_menus();
      $menu_items = array();

      foreach ($menus as $location => $description) {
        $menu_items[$description] = $location;
      }

      wp_reset_postdata();

      vc_map( array(
        'name' => __('VC Services List', 'csd'),
        'base' => 'vc_services_list',
        'category' => __('Custom Content Elements', 'csd'),            
        'params' => array( array(
          'type' => 'textfield',
          'heading' => __('Title', 'csd'),
          'param_name' => 'title',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'dropdown',
          'heading' => __('List', 'csd'),
          'param_name' => 'list',
          'value' => $menu_items,
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), ),
      ) );         
    }

    public function vc_services_list_html($atts) {
      extract( shortcode_atts(array(
        'title' => '',
        'list' => '',
      ), $atts) );

      $menu_items = get_menu_by_location($list);

      $html .= $menu_items;

      $html = '
<section class="o-content-section o-content-section--no-top-padding">
  <div class="o-wrapper">
    <div class="u-heading u-h4 u-color-primary u-mb-">' . $title . '</div>
    <div class="c-reveal__content-inner u-mt0 u-p0">
      <div class="o-layout c-mini-nav">
      ';

      foreach ($menu_items as $menu_item) {
        $html .= '
<a href="' . $menu_item->url . '" class="o-layout__item c-mini-nav__link">' . $menu_item->title . '</a>
        ';
      }

      $html .= '
      </div>
    </div>
  </div>
</section>
';

      return $html;
    }
  }
 
  new vcServicesList();    
?>