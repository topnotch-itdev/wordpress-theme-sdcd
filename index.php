<?php
	get_header();
	get_template_part('template-parts/blog/hero');
?>
<section class="o-content-section t-white">
	<div class="u-achor" id="filter"></div>
	<div class="o-wrapper">
		<?php
			get_template_part('template-parts/blog/tag-filter');

			if ( have_posts() ) {
				get_template_part('template-parts/blog/card');
			}
		?>
	</div>
</section>
<?php	get_footer(); ?>