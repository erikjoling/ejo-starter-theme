<?php
/**
 * Sets up custom filters and actions for the theme.  This does things like sets up sidebars, menus, scripts, 
 * and lots of other awesome stuff that WordPress themes do.
 *
 * Note: This files gets loaded directly in functions.php. Due to WordPress best practices everything in here 
 *       Should be hooked to `after_setup_theme` or later hooks
 */

// Manipulate Ejo core
add_action( 'after_setup_theme', 'ejos_ejo_core', -99 );

// Load theme-specific files.
add_action( 'after_setup_theme', 'ejos_theme_files', 5 );

// Do theme setup on the 'after_setup_theme' hook.
add_action( 'after_setup_theme', 'ejos_theme_setup', 10 );

/**
 * Change ejo-core behaviour
 *
 * @access public
 * @return void
 */
function ejos_ejo_core() {

    // When in debug mode check for the build javascript files
    if (SCRIPT_DEBUG) {
        define( 'THEME_JS_URI', THEME_URI . 'assets/js/custom/' );
    }
    else {
        define( 'THEME_JS_URI',  THEME_URI . 'assets/js/'  );        
    }

    define( 'THEME_CSS_URI', THEME_URI . 'assets/css/' );
}

/**
 * Load Theme files.
 *
 * @access public
 * @return void
 */
function ejos_theme_files() {
    require_once( THEME_INC_DIR . 'carbon-fields/setup.php' );
    
    require_once( THEME_INC_DIR . 'theme-scripts.php' );
    require_once( THEME_INC_DIR . 'theme-media.php' );
    require_once( THEME_INC_DIR . 'theme-editor.php' );
    require_once( THEME_INC_DIR . 'theme-misc.php' );

    require_once( THEME_INC_DIR . 'extensions/404.php' );
    require_once( THEME_INC_DIR . 'extensions/social-share.php' );
}

/**
 * Theme setup function. This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @access public
 * @return void
 */
function ejos_theme_setup() {

    // Register custom menus.
    add_action( 'init', 'ejos_register_menus', 5 );

    // Remove link from excerpt
    add_filter( 'excerpt_more', 'ejos_no_excerpt_link' );

    // Allow shortcodes in navigation labels
    add_filter( 'wp_nav_menu_items', 'do_shortcode' );
}

/**
 * Registers nav menu locations.
 */
function ejos_register_menus() {
	register_nav_menu( 'site-navigation', __('Site Navigation') );
}

/**
 * Remove link from excerpt
 */
function ejos_no_excerpt_link( $more ) {
    return ' <span class="content-limiter">[...]<span>';
}