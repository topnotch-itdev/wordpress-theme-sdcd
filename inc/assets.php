<?php
  add_action('wp_enqueue_scripts', 'sdcd_scripts');

  function sdcd_scripts() {
    $template_directory_uri = get_template_directory_uri();

    wp_enqueue_style('main', $template_directory_uri . '/dist/css/main.css');
    wp_enqueue_style('survey', $template_directory_uri . '/dist/css/survey.css');
    wp_register_style('lightslider', $template_directory_uri . '/vendor/lightslider/dist/css/lightslider.min.css');
    wp_enqueue_style('custom', $template_directory_uri . '/dist/css/custom.css', array(), time());
    


    /** 
     ** Dev JS
     */
    
    // wp_enqueue_script('remodal', $template_directory_uri . '/node_modules/remodal/dist/remodal.min.js', array(), false, true);
    // wp_enqueue_script('slick-carousel', $template_directory_uri . '/node_modules/slick-carousel/slick/slick.min.js', array(), false, true);
    // wp_register_script('google-maps-js-api', 'https://maps.googleapis.com/maps/api/js?key=' . GOOGLE_API_KEY . '&callback=initMap', array(), false, true);
    // wp_enqueue_script('jquery-ui-dist', $template_directory_uri . '/node_modules/jquery-ui-dist/jquery-ui.min.js', array('jquery'), false, true);
    // wp_enqueue_script('dropzone', $template_directory_uri . '/node_modules/dropzone/dist/min/dropzone.min.js', array(), false, true);
    // wp_enqueue_script('app', $template_directory_uri . '/src/js/app.js', array('jquery'), false, true);


    /**
     ** Build JS
     */
    
    wp_enqueue_script( 'main', $template_directory_uri . '/dist/js/main.js', array() );
    wp_enqueue_script('is-ie-11', $template_directory_uri . '/dist/js/is-ie-11.js', array(), false, true);
    wp_enqueue_script('main-bundle', $template_directory_uri . '/dist/js/main-bundle.js', array(), false, true);
    wp_register_script('lightslider', $template_directory_uri . '/vendor/lightslider/dist/js/lightslider.min.js', array('jquery'), false, true);
    wp_register_script('jquery-ui', $template_directory_uri . '/vendor/jquery-ui/jquery-ui.min.js', array('jquery'), false, true);
    wp_enqueue_script('app', $template_directory_uri . '/dist/js/app.js', array('jquery'), false, true);
    
    wp_localize_script( 'main', 'php_vars', array(
	  'ajax_url' => admin_url('admin-ajax.php'),
    ) );
    
    
    
    // Includes JS, CSS intend the sidebar forms
    wp_enqueue_style('google-mulish-font', 'https://fonts.googleapis.com/css2?family=Mulish:wght@200..900&display=swap');
    wp_enqueue_style('google-mukta-font', 'https://fonts.googleapis.com/css2?family=Mukta');
    
    wp_enqueue_style('sidebar-form-style', $template_directory_uri . '/booking_form/assets/css/right_form_style.css', array(), time());
    wp_enqueue_style('getin-form-style', $template_directory_uri . '/booking_form/assets/css/get_intouch_form.css', array(), time());
    
    
    wp_enqueue_script('google-distance', $template_directory_uri . '/booking_form/assets/js/googlemap_distance.js', array('jquery'), time(), true);
    wp_enqueue_script('steps-form', $template_directory_uri . '/booking_form/assets/js/right_form.js', array('jquery'), time(), true);
    wp_enqueue_script('steps-form-slide', $template_directory_uri . '/booking_form/assets/js/steps_form_slider.js', array('jquery'), time(), true);
    wp_enqueue_script('getin-touch-form', $template_directory_uri . '/booking_form/assets/js/get_intouch_form.js', array('jquery'), time(), true);
    
    wp_enqueue_script('googleapis', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCz2aeNYAclxfxUfHOyyxuGKZ1nDO_Q-Aw&libraries=places&callback=initPlacesMap', array(), false, true);
    

  }
?>