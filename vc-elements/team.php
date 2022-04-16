<?php
  class vcTeam extends WPBakeryShortCode {
    function __construct() {
      add_action( 'init', array($this, 'vc_team_mapping') );
      add_shortcode( 'vc_team', array($this, 'vc_team_html') );
    }
     
    public function vc_team_mapping() {    
      if ( !defined('WPB_VC_VERSION') ) {
        return;
      }

      $args = array(
        'post_type' => 'team',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
      );

      $q = new WP_Query($args);
      $employees = array();

      if ( $q->have_posts() ) {
        while ( $q->have_posts() ) {
          $q->the_post();

          $employees[get_the_title()] = get_the_ID();
        }
      }

      wp_reset_postdata();

      vc_map( array(
        'name' => __('VC Team', 'sdcd'),
        'base' => 'vc_team',
        'category' => __('Custom Content Elements', 'sdcd'),            
        'params' => array( array(
          'type' => 'textfield',
          'heading' => __('Title', 'sdcd'),
          'param_name' => 'title',
          'admin_label' => false,
          'weight' => 0,
          'group' => 'Custom Group',
        ), array(
          'type' => 'param_group',
          'heading' => __('Employees', 'sdcd'),
          'param_name' => 'employees',
          'params' => array( array(
            'type' => 'dropdown',
            'heading' => __('Employee', 'sdcd'),
            'param_name' => 'post',
            'value' => $employees,
            'admin_label' => false,
            'weight' => 0,
            'group' => 'Custom Group',
          ), ),
        ), ),
      ) );         
    }

    public function vc_team_html($atts) {
      extract( shortcode_atts(array(
        'title' => '',
        'employees' => '',
      ), $atts) );

      $employees = vc_param_group_parse_atts($atts['employees']);

      $html = '
<section class="o-content-section t-white">
	<div class="o-wrapper o-wrapper--team u-pt@tablet">
		<h2 class="u-heading u-h2 u-align-center u-centered u-max-70@tablet">' . $title . '</h2>
		<div class="u-team">
			';

			foreach ($employees as $employee) {
				$html .= '
<div class="u-team__item">
	' . get_the_post_thumbnail($employee['post'], 'medium') . '
	<div class="u-team__item-info">
		<div class="u-team__item-employee">' . get_the_title($employee['post']) . '</div>
		<div class="u-team__item-employee">' . get_field('position', $employee['post']) . '</div>
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
 
  new vcTeam();    
?>