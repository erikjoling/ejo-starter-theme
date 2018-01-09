<?php

//* Custom Ejoweb shortcodes [ejoweb] [ejoweb_credits]
add_shortcode( 'ejoweb', 'ejoweb_link' );
add_shortcode( 'ejoweb_credits', 'ejoweb_credits' );


/** 
 * Link to Ejoweb website
 */
function ejoweb_link( $atts ) 
{
    $atts = shortcode_atts( array(
        'text' => 'Ejoweb',
        'title' => 'Ejoweb - WordPressbureau'
    ), $atts );

    return '<a href="https://www.ejoweb.nl" title="' . $atts['title'] . '">' . $atts['text'] . '</a>';
}

/** 
 * Show Ejoweb credits
 *
 * Show it as a link on the home-page and as plain text on other pages
 */
function ejoweb_credits( $atts ) 
{
    $atts = shortcode_atts( array(
        'text' => 'Webdesign door Ejoweb',
        'title' => 'Website gemaakt door Ejoweb'
    ), $atts );

    return '<span class="site-credits">' . ejoweb_link( $atts ) . '</span>';
}