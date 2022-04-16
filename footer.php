					<?php if ( !is_home() || !is_single() ) : ?>
						</div>
					<?php endif; ?>
				</div>
			</main>
		</div>
		<div id="scFooter">
      <?php
      	get_template_part('template-parts/common/footer');
      	get_template_part('template-parts/common/mobile-nav');
      ?>
    </div>
		<?php wp_footer(); ?>
	</body>
</html>