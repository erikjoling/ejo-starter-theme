<?php

/**
 * Use this function to integrate archive pages while getting the post_id
 */

function ejo_get_post_id() {

    // If archive page: check if there is a page connected
    if ( ejo_is_archive() ) {
        $post_id = ejo_get_archive_page_id( get_post_type() );
    }
    // If taxonomy: No support (yet), return false
    elseif ( ejo_is_tax() ) {
        $post_id = false;
    }
    else {
        $post_id = get_the_ID();
    }
    
    return apply_filters( 'ejo_post_id', $post_id );
}

function ejo_the_post_id() {
    echo ejo_get_post_id();
}

/** 
 * Retrieve the page (id) associated with the archive
 */
function ejo_get_archive_page_id( $post_type = null ) {

    if ( ! $post_type )
        $post_type = get_post_type();
    
    // Exit if post_type does not exist
    if ( ! $post_type_obj = get_post_type_object( $post_type ) )
        return false;

    // Built-in support for posts
    if ($post_type == 'post') {
        if ( 'page' != get_option( 'show_on_front' ) )
            $archive_page_id = false;

        $archive_page_id = apply_filters( 'ejo_archive_page_id_post', get_option( 'page_for_posts' ) );
    }
    else {
        $archive_page_id = apply_filters( "ejo_archive_page_id_$post_type", false );
    }

    // Check if page exists
    if ( empty( get_post($archive_page_id) ) ) 
        return false;

    return $archive_page_id;
}
