<?php

/**
 * AJAX FUNCTION TO DYNAMICALLY LOAD PHOTOS IN THE GALLERY (home.php)
 *
 * This function is called via an AJAX request. It first checks the security by validating the nonce,
 * then ensures that the 'paged' parameter is provided for pagination of the results. 
 * It then performs a WP_Query to retrieve posts of the custom post type 'photos',
 * respecting the pagination parameters and sorting the results by descending date.
 * If photos are found, it generates HTML for the results. 
 * In case no results are found, an error message is returned.
 * Finally, the function returns the results as a JSON response.
 */
function load_photos()
{
    // Security check
    if (!isset($_REQUEST['nonce']) or !wp_verify_nonce($_REQUEST['nonce'], 'load_photos')) {
        wp_send_json_error("Vous n’avez pas l’autorisation d’effectuer cette action.", 403);
    }

    // Check that the page number was sent
    if (!isset($_POST['paged'])) {
        wp_send_json_error("Le paramètre 'paged' est manquant.", 400);
    }

    $paged = intval($_POST['paged']);

    // Query to fetch photos
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 8,
        'paged' => $paged,
        'order' => 'DESC',
        'orderby' => 'date'
    );

    $query = new WP_Query($args);

    // Build the HTML for the results
    $resultats_html = '';
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ob_start(); // Start output buffering
            get_template_part('template-parts/onephoto');
            $resultats_html .= ob_get_clean(); // Capture and append the output to the variable
            $resultats_html .= ob_get_clean();
        }
        wp_send_json_success($resultats_html);
    } else {

        wp_send_json_success(array('no_more_photos' => true)); //Send a flag to indicate there are no more photos
    }
    // Reset WP_Query
    wp_reset_postdata();

    // Return the results in JSON format
    wp_send_json_success($resultats_html);

    wp_die();
}

add_action('wp_ajax_load_photos', 'load_photos');
add_action('wp_ajax_nopriv_load_photos', 'load_photos');
