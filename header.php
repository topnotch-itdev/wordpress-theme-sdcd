<?php

	$common_faviconico = get_field('common_faviconico', 'option');

	$favicon_57x57 = get_field('favicon_57x57', 'option');

	$favicon_72 = get_field('favicon_72', 'option');

	$favicon_114x114 = get_field('favicon_114x114', 'option');

	$favicon_120x120 = get_field('favicon_120x120', 'option');

	$favicon_144 = get_field('favicon_144', 'option');

	$favicon_152 = get_field('favicon_152', 'option');

	$body_class_name = '';



	global $post;



	if ($post->ID) {

		$body_class_name = 'bg-white';

	}

?>

<!doctype html>

<html <?php language_attributes(); ?>>

	<head>

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta http-equiv="cleartype" content="on">

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<meta charset="<?php bloginfo('charset'); ?>">

		<?php if ($common_faviconico) : ?>

			<link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="<?php echo $common_faviconico; ?>">

		<?php endif; ?>

		<?php if ($favicon_57x57) : ?>

			<link rel="apple-touch-icon" sizes="57x57" href="<?php echo $favicon_57x57; ?>">

			<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo $favicon_57x57; ?>">

		<?php endif; ?>

		<?php if ($favicon_72) : ?>

			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $favicon_72; ?>">

		<?php endif; ?>

		<?php if ($favicon_114x114) : ?>

			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $favicon_114x114; ?>">

		<?php endif; ?>

		<?php if ($favicon_120x120) : ?>

			<link rel="apple-touch-icon" sizes="120x120" href="<?php echo $favicon_120x120; ?>">

		<?php endif; ?>

		<?php if ($favicon_144) : ?>

			<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $favicon_144; ?>">

			<meta name="msapplication-TileImage" content="<?php echo $favicon_144; ?>">

		<?php endif; ?>

		<?php if ($favicon_152) : ?>

		  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $favicon_152; ?>">

		<?php endif; ?>

		<meta name="application-name" content="<?php bloginfo(); ?>">

		<!--[if lt IE 9]>

			<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>

		<![endif]-->

		

		

		<script src="https://js.stripe.com/v3/"></script>


		<?php wp_head(); ?>


		<script>
        let val = new Date()
        let url = window.location.href

        if (url.indexOf('/thank-you/') !== -1) {
					gtag('event', 'Purchased', {
						'event_category': 'Quote Form',
						'event_label': 'Purchased'
					});
        }
    </script>
	</head>

	<body>

		<div id="wptime-plugin-preloader"></div>

		<?php

			get_template_part('template-parts/common/cookies');

			get_template_part('template-parts/common/no-js');

			get_template_part('template-parts/common/header');

		?>

		<div id="scBody">

      <main id="main-content">

        <div class="home-sub-layout">

        	<?php if ( !is_home() && !is_singular('post') ) : ?>

        		<div class="container c-text-media-container">

        	<?php endif; ?>