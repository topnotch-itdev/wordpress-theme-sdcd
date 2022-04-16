<?php
  class vcOfficeContactDetails extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_office_contact_details_mapping') );
      add_shortcode( 'vc_office_contact_details', array($this, 'vc_office_contact_details_html') );
    }
     
    public function vc_office_contact_details_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      vc_map( array(
        'name' => __('VC Office Contact Details', 'sdcd'),
        'base' => 'vc_office_contact_details',
        'category' => __('Custom Content Elements', 'sdcd'),            
        'params' => array(),
      ) );         
    }

    public function vc_office_contact_details_html() {
      $address = get_field('address');
      $open_hours = get_field('open_hours');
      $phone = get_field('phone');

      $html = '
<section class="o-content-section o-gutter u-pb-- o-content-section--contact-details">
  <div class="o-layout u-stack-layout@tablet-small u-centered o-wrapper">
      ';

      if ($address != '') {
        $html .= '
<div class="o-layout__item u-6/12@tablet-small u-4/12@desktop u-vertical-top u-mb@tablet-small u-mb0@desktop">
  <div class="u-label u-text-16">' . __('Address', 'sdcd') . ':</div>
  <div>' . $address . '</div>
</div>
        ';
      }

      if ($open_hours != '') {
        $html .= '
<div class="o-layout__item u-6/12@tablet-small u-4/12@desktop u-vertical-top u-mb@tablet-small u-mb0@desktop">
  <div class="u-label u-text-16">' . __('Address', 'sdcd') . ':</div>
  <div>' . $open_hours . '</div>
</div>
        ';
      }

      if ($phone != '') {
        $html .= '
<div class="o-layout__item u-6/12@tablet-small u-4/12@desktop u-vertical-top u-mb@tablet-small u-mb0@desktop">
  <div>
    <div class="u-label u-text-16">' . __('Call us', 'sdcd') . ':</div>
    <div class="u-mb-">
      <a href="tel:' . $phone . '" class="u-link">' . $phone . '</a>
    </div>
  </div>
</div>
        ';
      }

      $html .= '
    </div>
</section>
      ';

      return $html;
    }
  }
 
  new vcOfficeContactDetails();    
?>