<?php
  $tag_addon = '';

  if ( isset($_GET['tag']) ) {
    $tag_addon = ' tag="' . $_GET['tag'] . '"';
  }

  echo do_shortcode('[ajax_load_more container_type="div" post_type="post" posts_per_page="9" transition_container_classes="o-layout o-layout--large o-flex-layout u-mb"' . $tag_addon . ']');
?>