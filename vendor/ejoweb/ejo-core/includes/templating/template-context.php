<?php 

// Add contextual body classes
add_filter( 'body_class', 'ejo_body_class_filter' );

/**
 * Filters the WordPress body class with a better set of classes
 */
function ejo_body_class_filter( $classes ) {

    $queried_object    = get_queried_object();
    $queried_object_id = get_queried_object_id();

    $classes = array();

    // Blog page.
    if ( is_home() ) {

        $classes[] = 'archive-view';
        $classes[] = 'post-archive-view';
    }

    // Singular post (post_type) classes.
    if ( is_singular() ) {

        $classes[] = 'singular-view';
        $classes[] = "{$queried_object->post_type}-view";

        // Front page.
        if ( is_front_page() ) {
            $classes[] = 'front-page';
        }

        if ( is_page_template() ) {
            // Set `templates` as default templates folder
            $template_dir = trailingslashit(apply_filters( 'ejo_template_dir', 'templates' ));
            $template_slug = get_page_template_slug( $queried_object_id );
            $template_slug = str_replace($template_dir, '', $template_slug); // Remove this themes custom template directory 

            $classes[] = sanitize_html_class( str_replace( array( '.', '/' ), '-', basename( $template_slug, '.php' ) ) );
        }
    }
    // Archive views.
    elseif ( is_archive() ) {

        $classes[] = 'archive-view';

        // Post type archives.
        if ( is_post_type_archive() ) {
            $classes[] = "{$queried_object->name}-archive-view";
        }
        elseif ( is_tax() || is_category() || is_tag() ) {
            $classes[] = "{$queried_object->taxonomy}-taxonomy-view";
        }
    }
    elseif ( is_search() ) {
        $classes[] = 'search-view';
    }

    return array_map( 'esc_attr', $classes );
}
