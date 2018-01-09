<?php

// Setup Carbon Fields (installed via composer) 
add_action( 'after_setup_theme', 'ejos_carbon_fields_load', 10 );

// Register Fields 
add_action( 'carbon_fields_register_fields', 'ejos_carbon_fields_register_fields' );

/**
 * Load Carbon Fields
 */
function ejos_carbon_fields_load() {
    
    require_once( THEME_VENDOR_DIR . 'autoload.php' );
    
    \Carbon_Fields\Carbon_Fields::boot();

    /* Remove default capability restricting theme-options */
    add_filter( 'carbon_fields_theme_options_container_admin_only_access', '__return_false' );
}

/**
 * Register Options
 */
function ejos_carbon_fields_register_fields() {

    // Always include helper functions
    require_once( THEME_INC_DIR . 'carbon-fields/helpers.php' );

    // Add theme options
    require_once( THEME_INC_DIR . 'carbon-fields/setup-theme-options.php' );
}
