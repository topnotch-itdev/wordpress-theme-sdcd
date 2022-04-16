<?php
  define('GOOGLE_API_KEY', 'AIzaSyCZ8tq6k5WmPOemlEa4tMD361MtaNI1pyE');

  $template_directory = get_template_directory();

  require_once $template_directory . '/inc/assets.php';
  require_once $template_directory . '/inc/nav.php';
  require_once $template_directory . '/inc/options.php';

  add_filter('acf/settings/google_api_key', function() {
    return GOOGLE_API_KEY;
  });

  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');

  require_once $template_directory . '/inc/theme-favicon-settings.php';

  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('admin_print_styles', 'print_emoji_styles');

  require_once $template_directory . '/inc/custom-vc-elements.php';
  require_once $template_directory . '/inc/helpers.php';
  require_once $template_directory . '/inc/shortcodes.php';
  require_once $template_directory . '/inc/ajax-functions.php';
  
  // Add custom sidebar steps form
  require_once $template_directory . '/booking_form/sidebar_form.php';
  require_once $template_directory . '/booking_form/get_intouch_form.php';
?>