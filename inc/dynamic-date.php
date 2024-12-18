<?php

/**
 * Creating a shortcode to display a dynamic date
 */
function shortcode_last_updated_date()
{
    return 'Dernière mise à jour: ' . date('d F Y');
}
add_shortcode('last_updated_date', 'shortcode_last_updated_date');
