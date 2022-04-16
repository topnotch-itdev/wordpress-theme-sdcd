<?php
  global $post;

  $post_thumbnail_url = get_the_post_thumbnail_url(null, 'full');
?>
<section class="c-hero-content t-dark">
  <picture class="c-hero-content__image-container js-rellax">
    <source srcset="<?php echo $post_thumbnail_url; ?>" media="(min-width: 30em)">
    <img srcset="<?php echo $post_thumbnail_url; ?>" alt="…" class="c-hero-content__image js-object-fit-image">
    <div class="js-object-fit-fb u-objectfit-fallback"></div>
  </picture>
  <div>
    <div class="c-hero-content__content">
      <h1 class="c-hero-content__heading u-heading u-h1 u-centered"><?php echo $post->post_title; ?></h1>
    </div>
  </div>
</section>