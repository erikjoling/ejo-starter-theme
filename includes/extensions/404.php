<?php 
/**
 * NOTE: Since this theme doesn't customize carbon-fields entries the option name is prefixed with an underscore
 */

add_filter( 'ejo_post_id', 'ejo_page_on_404');
add_filter( 'display_post_states', 'ejo_post_state_404', 10, 2);

// 404 Page id getter
function get_404_page() {
    return get_option('_page_on_404', false);
}

/**
 * Add 404 label to admin pages-overview
 */
function ejo_post_state_404($post_states, $post) {

    if ( get_404_page() == $post->ID ) {
        $post_states['page_on_404'] = __('404-pagina');
    }

    return $post_states;
}

/**
 * Hook 404 page into my ejo_get_page_id function
 */
function ejo_page_on_404($post_id) {

    if (is_404())
        $post_id = get_404_page();

    return $post_id;
}

/**
 * Remove SEO metabox on 404 page
 *
 * Note: To exclude the 404 page from the sitemap I need to put it on noindex in the metabox
 *       So not a good idea to remove the metabox...
 */
// add_action( 'add_meta_boxes', 'ejo_remove_metabox_on_404', 11, 2 );
// function ejo_remove_metabox_on_404($post_type, $post) {

//     if ($post->ID == get_404_page()) {
//         remove_meta_box( 'wpseo_meta', 'page', 'normal' );
//     }
// }