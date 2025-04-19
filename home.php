<?php
get_header();
?>

<?php get_template_part('template-parts/banner', get_post_type()); ?>

<main id="primary" class="site-main">
    <section class="main-section main-section-margin">
        <?php get_template_part('template-parts/filters', get_post_type()); ?>
        <?php get_template_part('template-parts/gallery', get_post_type()); ?>
        <button type="button" class="load-btn" data-url="<?php echo admin_url("admin-ajax.php") ?>" data-nonce="<?php echo wp_create_nonce("load_photos") ?>">Charger plus</button>
    </section>

</main><!-- #main -->

<?php
get_footer();
