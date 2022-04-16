<?php
  add_action('after_setup_theme', function() {
    register_nav_menus( array(
      'primary' => 'Primary Menu',
      'top' => 'Top Menu',
      'footer_1' => 'Footer Menu 1',
      'footer_2' => 'Footer Menu 2',
      'footer_3' => 'Footer Menu 3',
      'footer_4' => 'Footer Menu 4',
      'for_business_industry' => 'For Business - Industry',
      'for_business_insuring_your_business' => 'For Business - Insuring Your Business',
      'for_business_protecting_your_properties' => 'For Business - Protecting your properties',
      'for_business_data_technology' => 'For Business - Data Technology',
      'for_personal_properties' => 'For Personal - Properties',
      'for_personal_motor_insurance' => 'For Personal - Motor Insurance',
    ) );
  });
?>