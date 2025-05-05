<?php

/**
 * DISPLAY FILTERED PHOTOS IN THE HOME GALLERY (home.php)
 * 
 * This function is called via an AJAX request. It first checks the security by validating the nonce
 */

function filter_photos()
{
    // Verify the nonce for security
    if (!isset($_REQUEST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'filter_photos_nonce')) {
        wp_send_json_error("Vous n’avez pas l’autorisation d’effectuer cette action.", 403);
    }

    // Retrieve the form data
    $categorie = sanitize_text_field($_POST['category'] ?? '');
    $format = sanitize_text_field($_POST['format']  ?? '');
    $order = sanitize_text_field($_POST['order'] ?? 'desc');
    error_log('Order value: ' . var_export($order, true));

    // Using WP_Query to fetch the filtered photos
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => $order,
        'tax_query' => array('relation' => 'AND'),
    );

    // Add filtering conditions if a category is selected
    if (!empty($categorie)) {
        array_push(
            $args['tax_query'],
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $categorie
            )
        );
    }

    // Add filtering conditions if a format is selected
    if (!empty($format)) {
        array_push(
            $args['tax_query'],
            array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $format

            )
        );
    }
    // Modifying order filter argument if necessary
    if ($order == 'date_asc') {
        $args['order'] = 'ASC';
    }

    $query = new WP_Query($args);

    ob_start(); //start capturing output

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            error_log('Nombre de posts : ' . $query->found_posts);

            $query->the_post();
            get_template_part('template-parts/onephoto');
        }
    } else {
        echo '<p class="no-more-photos">Aucune photo trouvée.</p>';
    }

    wp_reset_postdata();

    $html = ob_get_clean(); // Retrieve the captured content and clean the output buffer

    wp_send_json_success($html); // Send a JSON response to the client with the generated HTML content

    wp_die();
}

add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');
