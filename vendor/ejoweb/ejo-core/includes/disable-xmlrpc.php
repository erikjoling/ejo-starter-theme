<?php

/**
 * Disable XML-RPC
 *
 * Uses code of LittleBizzy
 */

/** 
 * Note: XML-RPC wordt voor meer gebruikt dan Pingback en trackback, zoals voor Remote login
 *
 * Test: 
 * - When I browse to your xmlrpc URL, it returns "XML-RPC server accepts POST requests only" - 
 *   which is what it should do regardless of if the plugin is enabled or not.
 *
 * - When I test your site with the XML-RPC tester at http://xmlrpc.eritreo.it/, it returns that 
 *   it cannot access the XML-RPC service, which is what is expected when the plugin is enabled.
 */
add_filter( 'xmlrpc_enabled', '__return_false' );	

/* RSD (Really Simple Discovery) link is the discover mechanism used by XML-RPC clients. */
remove_action( 'wp_head', 'rsd_link' );

// Force to uncheck pingbck and trackback options
add_filter( 'pre_option_default_ping_status', '__return_zero' );
add_filter( 'pre_option_default_pingback_flag', '__return_zero' );

// Hide options on Discussion page
add_action( 'admin_enqueue_scripts', 'ejo_hide_pingback_options' );

// Set disabled header for any XML-RPC requests
ejo_disallow_xmlrpc_request();


/**
 * Hide Discussion options with CSS
 *
 * @return null
 */
function ejo_hide_pingback_options( $hook ) {

    if ( 'options-discussion.php' !== $hook ) {
        return;
    }

    wp_add_inline_style( 'dashboard', '.form-table td label[for="default_pingback_flag"], .form-table td label[for="default_pingback_flag"] + br, .form-table td label[for="default_ping_status"], .form-table td label[for="default_ping_status"] + br { display: none; }' );
}

/**
 * Set disabled header for any XML-RPC requests
 */
function ejo_disallow_xmlrpc_request() {

    // Exit if script is not xmlrpc.php
    if ( ! isset( $_SERVER['SCRIPT_FILENAME'] ) || 'xmlrpc.php' !== basename( $_SERVER['SCRIPT_FILENAME'] ) )
        return;
    
    // Forbid xmlrpc.php to do stuff
    $header = 'HTTP/1.1 403 Forbidden';

    header( $header );
    echo $header;
    die();
}

/**
 * PINGBACK
 */

// //* Prevent pingback being sent to XMLRPC server
// //* (Probably not necessary if XML-RPC disabled)
// add_filter( 'xmlrpc_methods', 'ejo_prevent_pingback_xmlrpc' );

// //* Remove unnecesary HTTP Header response item
// add_filter( 'wp_headers', 'ejo_remove_x_pingback_header' );

// //* Prevent pingback being sent to XMLRPC server
// function ejo_prevent_pingback_xmlrpc( $methods ) 
// {
// 	unset( $methods['pingback.ping'] );
// 	unset( $methods['pingback.extensions.getPingbacks'] );

// 	return $methods;
// }

// //* Remove from HTTP Header response
// function ejo_remove_x_pingback_header( $headers ) 
// {
// 	unset( $headers['X-Pingback'] );
// }
