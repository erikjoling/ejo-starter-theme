<?php
/**
 * EJO Core: A theme drop-in framework by EJOweb
 *
 * Minimum PHP version: 5.3.0
 *
 * @package   EJO Core
 * @author    Erik Joling <erik@ejoweb.nl>
 * @copyright Copyright (c) 2017, Erik Joling
 * @link      https://github.com/erikjoling/ejo-core
 */

/**
 * Singleton
 */
final class EJO_Core {
    
    /* Holds the instance of this Singleton class. */
    private static $_instance = null;

    /* Version number */
    public static $version = '0.3.2';

    /* Store the slug */
    public static $slug = 'ejo-core';

    /**
     * Singleton implementation
     */
    public static function load() 
    {
        if ( !self::$_instance )
            self::$_instance = new self;
        return self::$_instance;
    }

    //* No cloning
    private function __clone() {}

    /* Plugin setup. */
    private function __construct() {
        
        add_action( 'after_setup_theme', array( 'EJO_Core', 'constants' ),    -95 ); // Setup plugin
        add_action( 'after_setup_theme', array( 'EJO_Core', 'helpers' ),       -1 ); // Make helpers available early on
        add_action( 'after_setup_theme', array( 'EJO_Core', 'templating' ),     8 ); // Templating
        add_action( 'after_setup_theme', array( 'EJO_Core', 'theme_support' ),  9 ); // Theme Support
        add_action( 'after_setup_theme', array( 'EJO_Core', 'mold' ),          15 ); // Molding WordPress. Loaded after theme setup so themes can manipulate it
        add_action( 'after_setup_theme', array( 'EJO_Core', 'ejopack' ),       15 ); // EJOpack. Should be extracted a plugin    
    }
    
    /* Defines Constants. */
    public static function constants() {

        //* Get the template directory and uri and make sure it has a trailing slash.
        if ( ! defined( 'THEME_DIR' ) ) define( 'THEME_DIR', trailingslashit( get_template_directory() ) );        
        if ( ! defined( 'THEME_URI' ) ) define( 'THEME_URI', trailingslashit( get_template_directory_uri() ) );

        //* Define Includes Directory
        if ( ! defined( 'THEME_INC_DIR' ) ) define( 'THEME_INC_DIR', THEME_DIR . 'includes/' );
        if ( ! defined( 'THEME_INC_URI' ) ) define( 'THEME_INC_URI', THEME_URI . 'includes/' );
        
        // Composer Vendor Dir
        if ( ! defined( 'THEME_VENDOR_DIR' ) ) define( 'THEME_VENDOR_DIR', THEME_DIR . 'vendor/' );

        //* Set Version
        if ( ! defined( 'THEME_VERSION' ) ) define( 'THEME_VERSION', wp_get_theme()->get( 'Version' ) );

        //* Set paths to asset folders.
        if ( ! defined( 'THEME_IMG_URI' ) )    define( 'THEME_IMG_URI',    THEME_URI . 'assets/dist/images/' );
        if ( ! defined( 'THEME_JS_URI' ) )     define( 'THEME_JS_URI',     THEME_URI . 'assets/dist/js/' );
        if ( ! defined( 'THEME_CSS_URI' ) )    define( 'THEME_CSS_URI',    THEME_URI . 'assets/dist/css/' );
        if ( ! defined( 'THEME_FONT_URI' ) )   define( 'THEME_FONT_URI',   THEME_URI . 'assets/dist/fonts/' );    
        if ( ! defined( 'THEME_VENDOR_URI' ) ) define( 'THEME_VENDOR_URI', THEME_URI . 'assets/dist/vendor/' );    

        // TODO: Better to get the path of ejo-core automatically in stead of manually...
        $relative_framework_path = trailingslashit( apply_filters( 'ejocore_relative_framework_path', 'vendor/ejoweb/' ) );

        // Sets the path to the core framework directory.
        if ( ! defined( 'EJO_CORE_DIR' ) )
            define( 'EJO_CORE_DIR', trailingslashit( THEME_DIR . $relative_framework_path . basename( dirname( __FILE__ ) ) ) );

        // Sets the path to the core framework directory URI.
        if ( ! defined( 'EJO_CORE_URI' ) )
            define( 'EJO_CORE_URI', trailingslashit( THEME_URI . $relative_framework_path . basename( dirname( __FILE__ ) ) ) );
    }

    /* Add helper functions */
    public static function helpers() {

        require_once( EJO_CORE_DIR . 'includes/helpers/write-log.php' );       // Write Log
        require_once( EJO_CORE_DIR . 'includes/helpers/misc.php' );            // Theme helpers
        require_once( EJO_CORE_DIR . 'includes/helpers/enqueue-plugins.php' ); // Make it easy to add shipped common assets like magnific-popup
        require_once( EJO_CORE_DIR . 'includes/helpers/carbon-fields.php' );   // Carbon Fields
    }

    /* Templating Logic */
    public static function templating() 
    {
        require_once( EJO_CORE_DIR . 'includes/templating/template.php' );             // Main template functionality
        require_once( EJO_CORE_DIR . 'includes/templating/template-post.php' );        // Template post functions
        require_once( EJO_CORE_DIR . 'includes/templating/template-functions.php' );   // Template functions
        require_once( EJO_CORE_DIR . 'includes/templating/template-hierarchy.php' );   // Template hierarchy
        require_once( EJO_CORE_DIR . 'includes/templating/template-tags.php' );        // Template Tags
        require_once( EJO_CORE_DIR . 'includes/templating/template-context.php' );     // Template context

        // Widget Template Loader Class
        require_once( EJO_CORE_DIR . 'includes/templating/widget-template-loader/widget-template-loader.php' ); 
    }

    /* Manage theme support */
    public static function theme_support() 
    {
        /* WordPress Core */
        add_theme_support( 'automatic-feed-links' ); // Add default posts and comments RSS feed links to head.
        add_theme_support( 'title-tag' );            // Automatically add <title> to head.
        add_theme_support( 'post-thumbnails' );      // Adds theme support for WordPress 'featured images'.
        add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) ); // Adds core WordPress HTML5 support.

        /* Plugins */
        add_theme_support( 'yoast-seo-breadcrumbs' ); // Yoast Breadcrumbs

        /* Ejo Core */
        add_theme_support( 'ejo-cleanup-header' );  // Cleanup Header
        add_theme_support( 'ejo-cleanup-widgets' ); // Cleanup Widgets
        add_theme_support( 'ejo-disable-xmlrpc' );  // Disable XMLRPC
        add_theme_support( 'ejo-disable-emojis' );  // Disable Emojis
        add_theme_support( 'ejo-admin-menu' );      // Ejo Admin menu
        add_theme_support( 'ejo-admin-dashboard' ); // Ejo Admin-dashboard
        add_theme_support( 'ejo-text-editor' );     // Ejo Text-editor
        add_theme_support( 'ejo-site-scripts' );    // Custom Site Scripts
        add_theme_support( 'ejo-shortcodes' );      // Shortcodes

        /** 
         * Not supported functionality by default 
         */ 
        
        /* WordPress */
        // add_theme_support( 'post-formats', array() );
        // add_theme_support( 'custom-background', array() );
        // add_theme_support( 'custom-header', array() );
        // add_theme_support( 'custom-logo', array() );
        // add_theme_support( 'starter-content', array() );
        // add_theme_support( 'customize-selective-refresh-widgets' );

        /* Ejo Core */
        // add_theme_support( 'ejo-hide-blogging' );      // Hide blogging
        // add_theme_support( 'ejo-post-scripts' );       // Add scripts to posts
        // add_theme_support( 'ejo-social-media-links' ); // Social Media Links
    }
    
    /* Molding WordPress */
    public static function mold() 
    {
        //* Remove/disable/hide unnecessary functionality

        /* Hide Blogging functionality */
        require_if_theme_supports( 'ejo-hide-blogging', EJO_CORE_DIR . 'includes/hide-blogging.php' );

        /* Cleanup unnecessary HTML Header elements */
        require_if_theme_supports( 'ejo-cleanup-header', EJO_CORE_DIR . 'includes/cleanup-html-header.php' );

        /* Disable unnecessary XML-RPC and Pingback functionality */
        require_if_theme_supports( 'ejo-disable-xmlrpc', EJO_CORE_DIR . 'includes/disable-xmlrpc.php' );

        /* Cleanup unnecessary widgets */
        require_if_theme_supports( 'ejo-cleanup-widgets', EJO_CORE_DIR . 'includes/cleanup-widgets.php' );

        /* Disable emoji support */
        require_if_theme_supports( 'ejo-disable-emojis', EJO_CORE_DIR . 'includes/disable-emojis.php' );

        //* Tweak WordPress Admin

        /* Mold the admin menu to my liking */
        require_if_theme_supports( 'ejo-admin-menu', EJO_CORE_DIR . 'includes/admin-menu.php' );

        /* Mold the admin dashboard to my liking */
        require_if_theme_supports( 'ejo-admin-dashboard', EJO_CORE_DIR . 'includes/admin-dashboard.php');

        /* Mold the text editor to my liking */
        require_if_theme_supports( 'ejo-text-editor', EJO_CORE_DIR . 'includes/text-editor.php' ); 
    }

    /* Functionality to extract to a plugin */
    public static function ejopack() 
    {
        /* Allow admin to add scripts to entire site */
        require_if_theme_supports( 'ejo-site-scripts', EJO_CORE_DIR . '_ejopack/custom-scripts/add-site-scripts.php' );

        /* Allow admin to add scripts to specific posts */
        require_if_theme_supports( 'ejo-post-scripts', EJO_CORE_DIR . '_ejopack/custom-scripts/add-post-scripts.php' );

        /* Social Media */
        require_if_theme_supports( 'ejo-social-media-links', EJO_CORE_DIR . '_ejopack/social-media/links/social-media-links.php');

        /* Shortcodes */
        require_if_theme_supports( 'ejo-shortcodes', EJO_CORE_DIR . '_ejopack/shortcodes/shortcodes.php' );
    }
}

/* Call EJO Core */
EJO_Core::load();