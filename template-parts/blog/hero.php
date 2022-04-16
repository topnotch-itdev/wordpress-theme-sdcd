<?php 
  if ( is_home() && get_option('page_for_posts') ) {
    $img = wp_get_attachment_image_src(get_post_thumbnail_id( get_option('page_for_posts') ),'full'); 
    $featured_image = $img[0];
  }
?>
<section class="c-hero-content t-dark">
  <picture class="c-hero-content__image-container js-rellax">
    <source srcset="<?php echo $featured_image; ?>" media="(min-width: 30em)">
    <img srcset="<?php echo $featured_image; ?>" alt="…" class="c-hero-content__image js-object-fit-image">
    <div class="js-object-fit-fb u-objectfit-fallback"></div>
  </picture>
  <div>
    <div class="c-hero-content__content">
      <h1 class="c-hero-content__heading u-heading u-h1 u-centered"><?php single_post_title(); ?></h1>
    </div>
  </div>
</section>