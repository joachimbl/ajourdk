<!DOCTYPE HTML>
<html>
	<head>
		<?php page_title(); ?>
		<?php meta_description(); ?>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo( 'template_directory' ); ?>/images/favicon.ico" />
		<link rel="apple-touch-icon" href="<?php bloginfo( 'template_directory' ); ?>/images/appletouchicon.png" />
		<link rel="apple-touch-icon-precomposed" media="screen and (resolution: 326dpi)" href="<?php bloginfo( 'template_directory' ); ?>/images/appletouchicon.png" />
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="robots" content="index, follow" />	
		
		<link media="screen and (min-width: 960px)" rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/min/?b=wp-content/themes/ajour&f=style.css" />
		<link media="screen and (max-width: 960px)" rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/handheld.css" />
		
		<!--[if lt IE 9]>
			<link media="screen" rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/min/?b=wp-content/themes/ajour&f=style.css" />
			<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/ie-only.css" />
		<![endif]-->
		<!--[if IE 9]>
			<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_directory' ); ?>/ie9-only.css" />
		<![endif]-->	
		
		<?php css(); ?>
		
		<script type="text/javascript" src="<?php bloginfo( 'template_directory' ); ?>/min/?b=wp-content/themes/ajour&f=js/jquery-1.6.2.min.js,js/jquery.cycle.all.js,js/scripts.js,js/jquery.selectbox-0.1.2.min.js,js/jquery.tools.min.js"></script>
		<?php js(); ?>
		
		
		<?php 
			if($_SERVER["HTTP_X_PURPOSE"] != "preview"){ // Ingen Analytics for Safari previews
				echo get_field('analytics');
			}
		?>
	
	<?php flush(); ?>

	<body id="<?php echo "page" . $post->ID; ?>">
		<div id="wrapper" class="grid12 centered">
			<div id="header">
				<h1 class="inline-block"><a href="<?php bloginfo( 'home' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
					
					$args = array(
						'depth'				=> 2,
						'theme_location'	=> 'main-menu',
						'exclude'			=> get_option('page_on_front')
					);
					
					wp_nav_menu($args);					
				?>
			</div>