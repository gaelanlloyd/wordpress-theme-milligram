<?php
/**
 * Header comment needed to help remove whitespace from beginning of file.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php echo mg\return_page_title() . " | " . get_bloginfo('name'); ?></title>

	<!-- WP HEAD -->
	<?php wp_head(); ?>
	<!-- /WP HEAD -->

</head>

<body <?php body_class(); ?>>

	<?php

	// Get the page template and single template name,
	// store as global for use elsewhere (footer, etc.)
	global $template;
	mg\init_site_global( 'PAGE_TEMPLATE', basename( $template ) );

	// DEBUG: List the page template for front-end debugging
	?><!-- PAGE_TEMPLATE = [<?php echo mg\get_site_global( 'PAGE_TEMPLATE' ); ?>] -->

	<div class="container">

		<header>

			<div class="row">

				<div class="column">

					<p class="mb0 mt0"><a href="/" class="color-body underline-no caps"><?php echo get_bloginfo('name'); ?></a></p>

				</div>

				<div class="column" id="navmenu" style="text-align: right;">

					<nav>
						<?php wp_nav_menu( array('menu' => 'Main' ) ); ?>
					</nav>

				</div>

			</div><!--/row-->

		</header>
