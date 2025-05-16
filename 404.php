<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package motaphoto
 */

get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="error-title"><?php esc_html_e('Oops, cette page n\'existe pas!', 'motaphoto'); ?></h1>
		</header><!-- .page-header -->

		<div class="error-content">
			<p class="error-text"><?php esc_html_e('Si la photographie que vous cherchez n\'existe pas contactez-moi en remplissant le formulaire à partir du bouton CONTACT du menu de navigation.', 'motaphoto'); ?></p>

			<p class="emoji-wink"><?php echo '😉'; ?></p>
		</div><!-- .page-content -->

	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
