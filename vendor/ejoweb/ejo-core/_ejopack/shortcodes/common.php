<?php

/**
 * Add common shortcodes
 */
// Simple current year shortcode
add_shortcode( 'year', function() {
    return date('Y');
} );

//* Client copyright
add_shortcode( 'copyright', 'ejo_get_client_copyright' );

/**
 * Get Client Copyright statement
 */
function ejo_get_client_copyright( $atts )
{
    $atts = shortcode_atts( array(
        'text' => get_bloginfo( 'name' ),
    ), $atts );

    return '<span class="copyright">' . $atts['text'] . ' &#169; '.date('Y').'</span>';
}