<?php
  $facebook_link = get_field('facebook_link', 'option');
  $twitter_link = get_field('twitter_link', 'option');
  $linkedin_link = get_field('linkedin_link', 'option');
  $google_link = get_field('google_link', 'option');
  $img_directory_uri = get_template_directory_uri() . '/dist/img';
?>
<footer class="c-site-footer u-p u-p+@tablet t-navy">
  <div class="u-align-center u-h3 u-heading u-pb+ u-color-primary u-max-70@tablet u-centered u--footer-title"><?php the_field('footer_title', 'option'); ?></div>
  <div class="o-layout o-layout--medium u-stack-layout@mobile o-gutter">
    <div class="o-layout__item u-5/12@desktop">
    	<div class="u-heading u-lead u-mb-"><?php the_field('footer_menu_1_title', 'option'); ?></div>
      <nav class="c-main-nav c-main-nav__list--footer o-layout u-mt u-mt0@desktop">
    		<?php
    			wp_nav_menu( array(
        	  'theme_location' => 'footer_1',
        	  'container' => '',
        	  'menu_class' => '',
        	  'items_wrap' => '<ul class="%2$s">%3$s</ul>',
        	  'depth' => 1,
        	) );

    			wp_nav_menu( array(
        	  'theme_location' => 'footer_2',
        	  'container' => '',
        	  'menu_class' => '',
        	  'items_wrap' => '<ul class="%2$s">%3$s</ul>',
        	  'depth' => 1,
        	) );
    		?>
    	</nav>
   	</div>
    <div class="o-layout__item u-5/12@desktop o-layout__item--right">
      <div class="u-heading u-lead u-mb-"><?php the_field('footer_menu_2_title', 'option'); ?></div>
      <nav class="c-main-nav c-main-nav__list--footer o-layout u-mt u-mt0@desktop">
    		<?php
    			wp_nav_menu( array(
        	  'theme_location' => 'footer_3',
        	  'container' => '',
        	  'menu_class' => '',
        	  'items_wrap' => '<ul class="%2$s">%3$s</ul>',
        	  'depth' => 1,
        	) );

    			wp_nav_menu( array(
        	  'theme_location' => 'footer_4',
        	  'container' => '',
        	  'menu_class' => '',
        	  'items_wrap' => '<ul class="%2$s">%3$s</ul>',
        	  'depth' => 1,
        	) );
    		?>
    	</nav>
    </div>
    <div class="o-layout__item u-1/1 u-align-center@desktop">
      <ul class="o-inline-list u-pt">
      	<?php if ($facebook_link != '') : ?>
        	<li class="o-inline-list__item">
            <a href="<?php echo $facebook_link; ?>" target="_blank" class="u-bg-none" aria-label="<?php _e('Visit us on Facebook', 'csd'); ?>">
              <img width="42" src="<?php echo $img_directory_uri; ?>/facebook.svg" alt="<?php _e('Visit us on Facebook', 'csd'); ?>" style="border-radius: 50%">
            </a>
          </li>
        <?php endif; ?>
      	<?php if ($twitter_link != '') : ?>
          <li class="o-inline-list__item">
            <a href="<?php echo $twitter_link; ?>" target="_blank" class="u-bg-none" aria-label="<?php _e('Visit us on Twitter', 'csd'); ?>">
              <img width="42" src="<?php echo $img_directory_uri; ?>/twitter.svg" alt="<?php _e('Visit us on Twitter', 'csd'); ?>" style="border-radius: 50%">
            </a>
          </li>
        <?php endif; ?>
      	<?php if ($linkedin_link != '') : ?>
          <li class="o-inline-list__item">
            <a href="<?php echo $linkedin_link; ?>" target="_blank" class="u-bg-none" aria-label="<?php _e('Visit us on LinkedIn', 'csd'); ?>">
             	<img width="42" src="<?php echo $img_directory_uri; ?>/linkedin.svg" alt="<?php _e('Visit us on LinkedIn', 'csd'); ?>" style="border-radius: 50%">
             </a>
           </li>
        <?php endif; ?>
      	<?php if ($google_link != '') : ?>
          <li class="o-inline-list__item">
          	<a href="<?php echo $google_link; ?>" target="_blank" class="u-bg-none" aria-label="<?php _e('Visit us on Google', 'csd'); ?>">
              <img width="42" src="<?php echo $img_directory_uri; ?>/google.svg" alt="<?php _e('Visit us on Google', 'csd'); ?>" style="border-radius: 50%">
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <div class="u-mt u-pt u-text-12 u-divider-top"><?php the_field('copyright', 'option'); ?></div>
</footer>