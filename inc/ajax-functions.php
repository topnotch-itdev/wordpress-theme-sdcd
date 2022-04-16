<?php
    add_action('wp_ajax_search_cities_and_towns', 'search_cities_and_towns');
    add_action('wp_ajax_nopriv_search_cities_and_towns', 'search_cities_and_towns');

    function search_cities_and_towns() {
        global $wpdb;
        
        $cities_html = '';
        $towns_html = '';
		$s = $_POST['s'];
		$table_name = $wpdb->prefix . 'custom_towns';
		$results = $wpdb->get_results("SELECT name, postcode FROM $table_name WHERE LOWER(name) LIKE '%$s%' ORDER BY name ASC");
			
		if ( !empty($results) ) {
			$updated_results = array();
			
			foreach ($results as $result) {
				$updated_results[$result->name][] = $result->postcode;
			}
				
			if ( !empty($updated_results) ) {
				$towns_html .= '<ul class="cities-list">';
					
				foreach ($updated_results as $city => $updated_result) {
					$towns_html .= '<li class="cities-list__item">';
					$towns_html .= '<a href="' . get_permalink(783) . '?loc=' . $city . '&postcode=' . implode(',', $updated_result) . '" class="cities-list__link">' . $city . '</a>';
					$towns_html .= '</li>';
				}
					
				$towns_html .= '</ul>';
			}
		}
		
		$table_name = $wpdb->prefix . 'custom_cities';
		$results = $wpdb->get_results("SELECT name, postcode FROM $table_name WHERE LOWER(name) LIKE '%$s%' ORDER BY name ASC");
			
		if ( !empty($results) ) {
			$updated_results = array();
			
			foreach ($results as $result) {
				$updated_results[$result->name][] = $result->postcode;
			}
				
			if ( !empty($updated_results) ) {
				$cities_html .= '<ul class="cities-list">';
					
				foreach ($updated_results as $city => $updated_result) {
					$cities_html .= '<li class="cities-list__item">';
					$cities_html .= '<a href="' . get_permalink(783) . '?loc=' . $city . '&postcode=' . implode(',', $updated_result) . '" class="cities-list__link">' . $city . '</a>';
					$cities_html .= '</li>';
				}
					
				$cities_html .= '</ul>';
			}
		}

        echo json_encode( array(
	    	'cities_html' => $cities_html,
	    	'towns_html' => $towns_html,
	    ) );

        wp_die();
    }	
?>