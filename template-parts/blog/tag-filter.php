<?php
  $tags = get_terms('post_tag', array(
    'orderby' => 'count',
    'order' => 'DESC',
    'number' => '16',
  ) );
?>
<?php if ( !empty($tags) ) : ?>
  <div class="u-divider-bottom u-mb u-pb">
    <div class="u-bold-font u-mb-"><?php _e('Sort articles by most popular tags', 'sdcd'); ?></div>
    <?php foreach ($tags as $tag) : ?>
      <div class="u-inline-block t-neutral c-button--tag js-article-tag" data-value="<?php echo $tag->slug; ?>"><?php echo $tag->name; ?></div>
    <?php endforeach; ?>
    <div class="u-mt-">
      <a class="js-article-search c-button c-button--secondary c-button--narrow c-button--small"><?php _e('Apply', 'sdcd'); ?></a>
    </div>
  </div>
<?php endif; ?>