<?php
get_header();
?>

<?php get_template_part('template-parts/banner', get_post_type()); ?>

<main id="primary" class="site-main">
    <section class="main-container">
        <?php get_template_part('template-parts/filters', get_post_type()); ?>
        <?php get_template_part('template-parts/gallery', get_post_type()); ?>
    </section>

</main><!-- #main -->

<?php
get_footer();
