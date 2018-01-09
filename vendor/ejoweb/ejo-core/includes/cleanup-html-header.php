<?php

/**
 * Remove the following html header elements by default:
 * - Windows Live Writer
 * - Theme version meta
 * - WordPress version meta
 */
$html_header_elements = array(
	'wlw', // Windows Live Writer meta
	'wp_version', // WordPress Core version
);

/* Allow themes to prevent the removal of html header elements */
$html_header_elements = apply_filters( 'ejo_remove_html_header_elements', $html_header_elements );

/* Windows Live Writer manifest */
if ( in_array( 'wlw', $html_header_elements ) ) {

	remove_action( 'wp_head', 'wlwmanifest_link' ); 
}

/* WordPress version meta */
if ( in_array( 'wp_version', $html_header_elements ) ) {

	remove_action( 'wp_head', 'wp_generator' ); 
}
