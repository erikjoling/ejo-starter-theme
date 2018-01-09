<?php 

/**
 * Function to fill carbon fields select
 *
 * @return: array | returns an array with `post_id` => `post_title` entries
 */
function ejo_get_posts_array($args = null, $empty_first_entry = true) {

	// Set default post_type to post
	$args = wp_parse_args($args, array(
		'post_type'      => 'post',
		'posts_per_page' => -1,
	));

	// Run the query
	$query_posts = new WP_Query($args);

	// Setup array
	$posts = array();

	// Optionally make first item empty string (or custom value)
	if ($empty_first_entry) {
		$posts[''] = ($empty_first_entry === true) ? '' : $empty_first_entry;
	}

	// Fill the array
	if ( $query_posts->have_posts() ) : 

		while ( $query_posts->have_posts() ) : $query_posts->the_post(); 

			$posts[get_the_ID()] = get_the_title();

		endwhile; 

		wp_reset_postdata(); 
			
	endif; 

	// Return array: key=ID, value=title
	return $posts;
}

/**
 * Get array of posts wrapper for pages
 */
function ejo_get_pages_array($empty_first_entry = true) {

	$pages = ejo_get_posts_array(
		array(
			'post_type' => 'page',
			'posts_per_page' => -1,
		),
		$empty_first_entry
	);

	return $pages;
}

/**
 * Get array of categories
 */
function ejo_get_categories_array($first_entry = '') {

    $categories = get_terms( 'category', array(
        'hide_empty' => false,
    ) );

    $categories_array = array();

    // Make first item an empty string (or custom value)
    if ($first_entry !== false) {
        $categories_array[''] = $first_entry;
    }

    foreach ($categories as $category) {        
        $categories_array[ $category->term_id ] = $category->name;
    }

    return $categories_array;
}