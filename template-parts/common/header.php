<?php
  global $post;

  $logo = get_field('logo', 'option');
  $dark_logo = get_field('dark_logo', 'option');
?>
<div id="scHeader">
  <header class="js-siteheader c-site-header c-site-header--fixed">
    <div class="c-site-header__main">
      <div class="o-layout u-1/1 c-site-header__layout">
        <?php if ( !empty($logo) ) : ?>
          <div class="o-layout__item o-layout__item--logo u-2/12">
            <a href="<?php echo esc_url( home_url('/') ); ?>" aria-label="Go to the homepage">
              <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" class="o-layout__item-logo o-layout__item-logo--white">
              <img src="<?php echo $dark_logo['url']; ?>" alt="<?php echo $dark_logo['alt']; ?>" class="o-layout__item-logo o-layout__item-logo--dark">
            </a>
          </div>
        <?php endif; ?>
        <div class="o-layout__item u-10/12">
          <nav class="c-main-nav c-main-nav--header u-align-right u-hide@tablet js-main-nav">
            <div class="u-mb-- u-mb-@desktop">
              <?php
                wp_nav_menu( array(
                  'theme_location' => 'top',
                  'container' => '',
                  'menu_class' => '',
                  'items_wrap' => '<ul class="u-mb__nav %2$s">%3$s</ul>',
                  'depth' => 1,
                ) );
              ?>
            </div>
            <div class="c-main-nav__item c-main-nav__item--parent">
              <a href="<?php the_permalink(71); ?>" class="c-main-nav__link c-main-nav__link--parent<?php if ($post->ID == 71) : ?>  c-main-nav__link--active<?php endif; ?>"><?php echo get_the_title(71); ?></a>
              <div class="c-main-nav__dropdown o-layout o-layout--small">
                <div class="o-layout__item u-3/12 u-pb-">
                  <div class="c-main-nav__dropdown-title"><?php _e('Services', 'csd'); ?></div>
                  <?php
                    wp_nav_menu( array(
                      'theme_location' => 'for_business_industry',
                      'container' => '',
                      'menu_class' => '',
                      'items_wrap' => '<ul class="o-layout__nav %2$s">%3$s</ul>',
                      'depth' => 1,
                    ) );
                  ?>
                </div>
                <div class="o-layout__item u-3/12 u-pb-">
                  <div class="c-main-nav__dropdown-title"><?php _e('Courier Services', 'csd'); ?></div>
                  <?php
                    wp_nav_menu( array(
                      'theme_location' => 'for_business_insuring_your_business',
                      'container' => '',
                      'menu_class' => '',
                      'items_wrap' => '<ul class="o-layout__nav %2$s">%3$s</ul>',
                      'depth' => 1,
                    ) );
                  ?>
                </div>
                <div class="o-layout__item u-3/12 u-pb-">
                  <div class="c-main-nav__dropdown-title"><?php _e('Industry', 'csd'); ?></div>
                  <?php
                    wp_nav_menu( array(
                      'theme_location' => 'for_business_protecting_your_properties',
                      'container' => '',
                      'menu_class' => '',
                      'items_wrap' => '<ul class="o-layout__nav %2$s">%3$s</ul>',
                      'depth' => 1,
                    ) );
                  ?>
                </div>
                <div class="o-layout__item u-3/12 u-pb-">
                  <div class="c-main-nav__dropdown-title"><?php _e('Our Vehicles', 'csd'); ?></div>
                  <?php
                    wp_nav_menu( array(
                      'theme_location' => 'for_business_data_technology',
                      'container' => '',
                      'menu_class' => '',
                      'items_wrap' => '<ul class="o-layout__nav %2$s">%3$s</ul>',
                      'depth' => 1,
                    ) );
                  ?>
                </div>
              </div>
            </div>
            <?php
              wp_nav_menu( array(
                'theme_location' => 'primary',
                'container' => '',
                'menu_class' => '',
                'items_wrap' => '<ul class="c-main-nav__list %2$s">%3$s</ul>',
                'depth' => 1,
              ) );

              get_template_part('template-parts/common/nav-overlay');
            ?>
          </nav>
          <a href="#menu" class="c-hamburger u-show@tablet js-open-overlay-nav">
            <span class="c-hamburger__label u-hide">Menu</span>
            <span class="c-hamburger__icon"></span>
          </a>
        </div>
      </div>
    </div>
  </header>
  <noscript>
    <style>
      .js-search-input {
        display: inline-block;
      }

      .js-search-toggle {
        display: none;
      }
    </style>
  </noscript>
</div>