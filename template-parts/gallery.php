<?php
$args = array(
    'post_type' => 'photos',
    'posts_per_page' => 8,
    'order' => "DESC",
    'orderby' => "date",
    'paged' => 1,
);
$the_query = new WP_Query($args);

if ($the_query->have_posts()) {
    echo '<div class="photos-catalogue"><div class="recommendation-section__photos catalogue-margin">';
    while ($the_query->have_posts()) {
        $the_query->the_post();
?>
        <!-- Loading a photo to be repeated as many times as the query provides a result -->
        <?php get_template_part('template-parts/onephoto') ?>
<?php
    }
    echo '</div></div>';
} else {
    echo ("<p class='no-photos-message'>Désolée, nous n'avons pas d'autres photos dans cette catégorie.</p>");
}
wp_reset_postdata();
?>