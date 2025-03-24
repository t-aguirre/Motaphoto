<!-- Affichage du BANNER avec l'image de background custom -->
<?php if (is_front_page() || is_home()) : ?>
    <?php if (get_header_image()) : ?>
        <div class="header-banner" style="background-image: url(<?php header_image(); ?>)">
            <h1 class="header-title"><?php echo get_bloginfo('description'); ?></h1>
        </div>
    <?php endif; ?>
<?php endif; ?>