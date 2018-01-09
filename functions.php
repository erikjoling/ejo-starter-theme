<?php
/**
 * This file is the kickstart of the theme. It is triggered immediately before `after_setup_theme` hook
 */

// Set Theme Directory Constants
define( 'THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'THEME_URI', trailingslashit( get_template_directory_uri() ) );

// Set Ejo Core Directory Constants
define( 'EJO_CORE_DIR', THEME_DIR . 'vendor/ejoweb/ejo-core/' );
define( 'EJO_CORE_URI', THEME_URI . 'vendor/ejoweb/ejo-core/' );

// Load EJO Core
require_once( EJO_CORE_DIR . 'ejo-core.php' );

// Kickstart the theme
require_once( THEME_DIR . 'includes/theme.php' );

// *** DON'T ADD CODE HERE. DO THAT IN <INCLUDES>/THEME.PHP (FOR ORGANIZATIONAL PURPOSES) *** //