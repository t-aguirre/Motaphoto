<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package motaphoto
 */

?>

<footer id="colophon" class="site-footer">
	<div class="site-info">
		<?php
		wp_nav_menu(array(
			'theme_location' => 'footer_menu',
			'container' => 'ul',
			'container_class' => 'footer-menu',
		));
		?>
		<p class="footer-text">Tous dorits réservés</p>

	</div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>