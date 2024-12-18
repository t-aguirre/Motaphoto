<?php
//Footer menu location
function register_custom_footer_menu()
{
    register_nav_menus(array(
        'footer_menu' => 'Menu Footer',
    ));
}
add_action('after_setup_theme', 'register_custom_footer_menu');
