<?php
function pass_value_to_js()
{
    // Retrieve the "reference" meta field from SCF
    $reference_value = get_field('reference');

    // Pass the value to JavaScript
    wp_localize_script('motaphoto-modal', 'photoData', array(
        'reference' => esc_js($reference_value),
    ));
}
add_action('wp_enqueue_scripts', 'pass_value_to_js');
