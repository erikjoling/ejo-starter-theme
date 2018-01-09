<?php
// Simple author shortcode
add_shortcode( 'author', 'ejo_get_author' );

/**
 * Get author of current post
 */
function ejo_get_author( $atts ) 
{
    $output = '';
    $link_open = '';
    $link_close = '';

    /* No output if current post_type doesn't support author */
    if ( ! post_type_supports( get_post_type(), 'author' ) ) {
        return '';
    }

    /* Load attributes with fallback */
    $atts = shortcode_atts( array(
        'link' => false
    ), $atts );

    /* Get the author object */
    $author = get_the_author();

    /* No output without an author */
    if ( ! $author ) {
        return '';
    }

    /* Manage link-output if it is requested */
    if ( $atts['link'] ) {
        global $authordata;

        if ( ! is_object( $authordata ) ) 
            return;

        //* Get url of author page
        $url = esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) );

        $link_open = ($url) ? '<a href="' . $url . '" itemprop="url" rel="author">' : '';
        $link_close = ($url) ? '</a>' : '';
    }

    $output .= '<span itemscope itemtype="http://schema.org/Person" itemprop="author">';
    $output .=     $link_open . '<span itemprop="name">' . $author . '</span>' . $link_close;
    $output .= '</span>';

    return $output;
}