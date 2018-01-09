<?php 

/**
 * Output the publish time of the post
 */
function ejo_the_time() {
    echo ejo_get_the_time();
}

/**
 * Get the publish time of the post
 */
function ejo_get_the_time() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    // if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    //     $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    // }

    $time_string = sprintf( $time_string,
        get_the_date( DATE_W3C ),
        get_the_date()
        // get_the_modified_date( DATE_W3C ),
        // get_the_modified_date()
    );

    return $time_string;
}