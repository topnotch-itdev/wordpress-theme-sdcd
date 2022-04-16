<?php
	get_header();
	get_template_part('template-parts/single/hero');
?>
<?php if ( have_posts() ) : ?>
	<?php the_post(); ?>
	<section class="o-content-section">
		<div class="o-wrapper">
			<div class="s-editorial">
				<div class="s-editorial__layout group">
					<div class="s-editorial__layout-left"><?php the_content(); ?></div>
					<div class="s-editorial__layout-right"><?php echo do_shortcode('[sidebar_form]'); ?></div>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<?php
	get_template_part('template-parts/common/cta');
	get_footer();
?>