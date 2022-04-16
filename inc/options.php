<?php
  if ( function_exists('acf_add_options_page') ) {
    acf_add_options_page(
      array(
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
      )
    );

    acf_add_options_sub_page(
      array(
        'page_title' => 'Favicon',
        'menu_title' => 'Favicon',
        'parent_slug' => 'theme-general-settings',
      )
    );

    acf_add_options_sub_page(
      array(
        'page_title' => 'Footer',
        'menu_title' => 'Footer',
        'parent_slug' => 'theme-general-settings',
      )
    );
  }
?>