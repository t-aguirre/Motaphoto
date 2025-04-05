<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package motaphoto
 */

get_header();

$posts_data = [];

while (have_posts()) : the_post();
    $posts_data[] = [
        'image' => get_the_post_thumbnail(get_the_ID(), 'medium_large'),
        'title' => get_the_title(),
        'date' => get_the_time("Y"),
        'reference' => get_field("reference"),
        'type' => get_field("type"),
        'categories' => strip_tags(get_the_term_list(get_the_ID(), 'categorie')),
        'formats' => strip_tags(get_the_term_list(get_the_ID(), 'format')),
    ];
endwhile; // End of the loop.
// var_dump($posts_data);

//Previous - Next loop
$prev_post = get_previous_post();
if ($prev_post) :
    $prev_thumb = get_the_post_thumbnail($prev_post->ID, 'thumbnail');
endif;

?>

<main id="primary" class="site-main">
    <section class="main-section">
        <article class="flex-row">
            <?php foreach ($posts_data as $data) : ?>
                <div class="photos-data-wrapper">
                    <div class="photos-data">
                        <h1 class="photo-title"><?php echo $data['title']; ?></h1>
                        <ul class="data-list">
                            <li>
                                Référence: <?php echo $data['reference']; ?>
                            </li>
                            <li>
                                Catégorie: <?php echo $data['categories']; ?>
                            </li>
                            <li>
                                Format: <?php echo $data['formats']; ?>
                            </li>
                            <li>
                                Type: <?php echo $data['type']; ?>
                            </li>
                            <li>
                                Année: <?php echo $data['date']; ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="photo-img">
                    <?php echo $data['image']; ?>
                </div>
            <?php endforeach; ?>
        </article>
        <div class="flex-row">
            <div class="contact-cta">
                <p class="cta-call">Cette photo vous intéresse?</p>
                <button type="button" class="contact-btn">Contact</button>
            </div>
            <div class="photo-navigation">
                <div>
                    <div class="photo-thumbnail">

                        <a href="<?php echo get_permalink($prev_post->ID); ?>">
                            <?php echo $prev_thumb; ?>
                        </a>
                    </div>
                    <div class="prev-next">
                        <div class="nav-prev"><?php previous_post_link('%link', '&larr;'); ?></div>
                        <div class="nav-next"><?php next_post_link('%link', '&rarr;'); ?></div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="recommendation-section">
        <h2 class="recommendation-title">Vous aimerez aussi</h2>

        <?php
        $post_terms = wp_get_object_terms($post->ID, 'categorie', array('fields' => 'ids'));
        $args = array(
            'post_type' => 'photos',
            'post__not_in' => array($post->ID),
            'posts_per_page' => 2,
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'id',
                    'terms' => $post_terms,
                )
            )
        );
        $the_query = new WP_Query($args);

        if ($the_query->have_posts()) {
            echo '<div class="recommendation-section__photos">';
            while ($the_query->have_posts()) {
                $the_query->the_post();
        ?>
                <!-- Loading a photo to be repeated as many times as the query provides a result -->
                <?php get_template_part('template-parts/onephoto', null, array('data' => $data)); ?>
        <?php
            }
            echo '</div>';
        } else {
            echo ("Désolée, nous n'avons pas d'autres photos dans cette catégorie.");
        }
        wp_reset_postdata();
        ?>
    </section>
</main><!-- #main -->

<?php
get_footer();
