<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package motaphoto
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'motaphoto'); ?></a>

		<header id="masthead">
			<div class="site-header">
				<div class="site-branding">
					<?php
					the_custom_logo();
					if (!the_custom_logo()) :
					?>
						<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
					<?php
					endif;
					?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="line"></span>
						<span class="line"></span>
						<span class="line"></span>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div><!-- #masthead -->

			<!-- Affichage du BANNER avec l'image de background custom -->
			<?php if (is_front_page() || is_home()) : ?>
				<?php if (get_header_image()) : ?>
					<div class="header-banner" style="background-image: url(<?php header_image(); ?>)">
						<h1 class="header-title"><?php echo get_bloginfo('description'); ?></h1>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</header>