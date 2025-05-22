<!-- Dynamically display a background image for the home banner using a random featured image from the "photos" CPT -->
<?php if (is_front_page() || is_home()) : ?>
    <?php
    $args = array(
        'post_type'      => 'photos',
        'posts_per_page' => 1,
        'orderby'        => 'rand',
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), array(1440, 962));

            if ($image_url) :
    ?>
                <div class="header-banner" style="background-image: url('<?php echo esc_url($image_url[0]); ?>')">
                    <h1 class="header-title"><?php echo get_bloginfo('description'); ?></h1>
                </div>
    <?php
            endif;
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
<?php endif; ?>