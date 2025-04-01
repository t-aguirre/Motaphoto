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
        'categories' => get_the_term_list(get_the_ID(), 'categorie'),
        'formats' => get_the_term_list(get_the_ID(), 'format'),
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


</main><!-- #main -->

<?php
get_footer();
