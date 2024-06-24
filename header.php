<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo wp_get_document_title(); ?></title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<!-- Generate favicon here http://www.favicon-generator.org/ -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<style>
		:root {
			--primary-color: <?php echo get_theme_mod('primary_color', '#4CE0D7'); ?>;
			--text-color: <?php echo get_theme_mod('text_color', '#262626'); ?>;
			--secondary-color: <?php echo get_theme_mod('secondary_color', '#BCBCBC'); ?>;
			--secondary-light-color: <?php echo get_theme_mod('secondary_light_color', '#f2f2f2'); ?>;
		}
	</style>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header itemscope itemtype="http://schema.org/WPHeader">
		<div class="header-items">
			<nav class="navbar navbar-expand-lg " aria-label="Offcanvas navbar large">
				<div class="container">
					<div itemscope itemtype="http://schema.org/Organization" id="logo">
						<?php the_custom_logo(); ?>
					</div>
					<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
						<div class="offcanvas-header">
							<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
						</div>
						<div class="offcanvas-body justify-content-end">
							<?php
							wp_nav_menu([
								'theme_location' => 'primary-menu',
								'menu_class' => 'main-menu',
								'container' => '',
							]); ?>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</header>