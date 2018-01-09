<?php 

// Icon
add_shortcode( 'icon', 'ejo_get_icon' );

/* EJO Icon shortcode */
function ejo_get_icon( $atts ) 
{
    // Break if no attributes array
    if (!is_array($atts)) {
        return '';
    }

    // Preprocess the attributes to make the icon shortcode simpler
    foreach ($atts as $key => $value) {
        if (is_int($key)) {
            if ($value == 'circle') {
                $atts['circle'] = true;
            }
            else {
                $atts['icon'] = $value;   
            }
            unset($atts[$key]);
        }
    }

    // Defaults
    $atts = shortcode_atts( array(
        'icon' => false,
        'circle' => false
    ), $atts );

    // Break if no icon
    if (!$atts['icon']) {
        return '';
    }

    $icon_class = apply_filters( 'ejo_icon_class', 'icon' );
    $icon_prefix = apply_filters( 'ejo_icon_prefix', 'fa-' );
    $circle_class = ($atts['circle']) ? 'circle' : '';
    
    // Return the icon html
    return sprintf('<span class="%s %s %s" aria-hidden="true"></span>', $icon_class, $icon_prefix.$atts['icon'], $circle_class);
}

/**
 * Helper function for quickly outputting icons in php 
 */
function ejo_the_icon($icon_name, $circle = false) {

    $atts = array();
    $atts['icon'] = $icon_name;
    $atts['circle'] = $circle;

    echo ejo_get_icon($atts);
}