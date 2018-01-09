<?php

/*
Add header & footer scripts to theme
*/

class EJO_Site_scripts
{
    //* Slug of this module
    const SLUG = 'ejo-site-scripts';

    public static $menu_title = 'Site scripts';

    public static $page_title = 'Site scripts';

    /* Stores the directory path for this plugin. */
    public static $dir;

    /* Stores the directory URI for this plugin. */
    public static $uri;
    
	/* Holds the instance of this class. */
    private static $_instance = null;

    /* Only instantiate once */
    public static function init() 
    {
        if ( !self::$_instance )
            self::$_instance = new self;
        return self::$_instance;
    }

    //* No cloning
    private function __clone() {}

    /* Plugin setup. */
    private function __construct() 
    {
    	add_action( 'admin_menu', array( $this, 'register_menu' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts_and_styles' ) );

		//* Add scripts to header
		add_action( 'wp_head', array( $this, 'ejo_header_scripts' ) );

		//* Add scripts to footer
		add_action( 'wp_footer', array( $this, 'ejo_footer_scripts' ) );
    }

    /* Defines the directory path and URI for the plugin. */
    public static function setup() 
    {
    	self::$dir = trailingslashit( dirname( __FILE__ ) );
    }

    public function register_menu(){
        add_theme_page( self::$menu_title, self::$page_title, 'edit_theme_options', self::SLUG, array( $this, 'menu_page' ) );
    }

    public function menu_page()
    {
    	require( self::$dir . 'add-site-scripts-menupage.php' );
    }

    public function register_admin_scripts_and_styles( $hook ) {

    }

    //* Add scripts to header
	public function ejo_header_scripts() 
	{
		echo stripslashes(get_option( 'ejo_header_scripts', '' ));
	}

	//* Add scripts to footer
	public function ejo_footer_scripts() 
	{
		echo stripslashes(get_option( 'ejo_footer_scripts', '' ));
	}
}

EJO_Site_scripts::init();