<?php
	if ( !function_exists('get_menu_by_location') ) {
		function get_menu_by_location($theme_location) {
	    $theme_locations = get_nav_menu_locations();
	    $menu_obj = get_term($theme_locations[$theme_location], 'nav_menu');

			return $menu_obj ? wp_get_nav_menu_items($menu_obj->term_id) : $menu_obj;
	  }
	}

	function custom_excerpt_length($length) {
		return 18;
	}

	add_filter('excerpt_length', 'custom_excerpt_length', 999);
?>