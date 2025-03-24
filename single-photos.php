<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package motaphoto
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();
        the_title();
        the_post_thumbnail();
        the_date();
        echo get_field("reference");
        echo get_field("type");
        echo get_field("categories");
        // echo strip_tags(get_the_term_list(get_the_ID(), 'categories'));
        echo strip_tags(get_the_term_list(get_the_ID(), 'formats'));
    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();
