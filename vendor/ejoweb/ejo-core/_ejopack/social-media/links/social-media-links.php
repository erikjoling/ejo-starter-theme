<?php

/*
Add Social Media links to your website
*/

class EJO_Social_Media_Links
{
    //* Slug of this module
    const SLUG = 'ejo-social-media-links';

    //* Menu Label
    public static $menu_title;

    //* Page Heading
    public static $page_title;

    /* Stores the directory path for this plugin. */
    public static $dir;

    /* Stores the directory URI for this plugin. */
    public static $uri;

    //* Default social media links
    public static $default_social_media_links;    
    
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
        self::setup();

        //get_class ipv $this

        add_action( 'admin_menu', array( $this, 'register_menu' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts_and_styles' ) );

        //* 
        add_shortcode( 'social_media', array( $this, 'social_media_links_shortcode' ) );
    }

    /* Defines the directory path and URI for the plugin. */
    public static function setup() 
    {
        self::$dir = trailingslashit( dirname( __FILE__ ) );

        //* Dynamicly get this folder url
        self::$uri = EJO_CORE_URI . str_replace(EJO_CORE_DIR, '', self::$dir);

        self::$menu_title = __('Social Media Links', EJO_Core::$slug);
        self::$page_title = __('Social Media Links', EJO_Core::$slug);

        self::$default_social_media_links = array(
            'facebook' => array( 
                'name'   => 'Facebook',
                'link'   => '',
                'active' => false
            ),
            'twitter' => array( 
                'name'   => 'Twitter',
                'link'   => '',
                'active' => false
            ),
            'linkedin' => array( 
                'name'   => 'Linkedin',
                'link'   => '',
                'active' => false
            ),
            'pinterest' => array( 
                'name'   => 'Pinterest',
                'link'   => '',
                'active' => false
            ),
            'instagram' => array( 
                'name'   => 'Instagram',
                'link'   => '',
                'active' => false
            ),
            'googleplus' => array( 
                'name'   => 'Google+',
                'link'   => '',
                'active' => false
            ),
            'whatsapp' => array( 
                'name'   => 'Whatsapp',
                'link'   => '',
                'active' => false
            ),
        );
    }

    public function register_menu()
    {
        add_theme_page( self::$menu_title, self::$page_title, 'edit_theme_options', self::SLUG, array( $this, 'menu_page' ) );
    }

    public function menu_page()
    {
        require( self::$dir . 'menu-page.php' );
    }

    public function register_admin_scripts_and_styles( $hook ) 
    {
        //* Only hook on ejo settings page
        if ( 'appearance_page_' . self::SLUG != $hook )
            return;

        wp_enqueue_script( 'ejo-social-media-admin', self::$uri . 'admin-social-media.js', array('jquery', 'jquery-ui-sortable') );
        wp_enqueue_style( 'ejo-social-media-admin', self::$uri . 'admin-social-media.css' );
    }

    /**
     * Shortcode function for showing social media links
     */
    public function social_media_links_shortcode( $atts )
    {
        $social_media_links = get_option( '_ejo_social_media_links', array() );

        if (empty($social_media_links))
            return '';

        $atts = shortcode_atts( array(
            'type' => 'icon',
        ), $atts );

        $site_name = get_bloginfo('name');

        $output = '<ul class="social-media-links type-'.$atts['type'].'">';

            foreach ($social_media_links as $social_id => $social_media) {
                
                if ( !$social_media['active'] )
                    continue;

                $output .= '<li>';

                    switch ($atts['type']) {
                        case 'icon':
                            $text = "<i></i>";
                            break;

                        case 'text':
                            $text = $social_media['name'];
                            break;
                        
                        case 'both':
                            $text = "<i></i>{$social_media['name']}";
                            break;

                        default:
                            $text = $social_media['name'];
                            break;
                    }

                    //* Wrap a link around the social-profile
                    $output .= sprintf(
                                    '<a href="%s" class="%s" title="%s" target="_blank">%s</a>',
                                    $social_media['link'],
                                    $social_id,
                                    $social_media['name'] . ' profiel ' . $site_name,
                                    $text
                               );

                $output .= '</li>';
            }

        $output .= '</ul>';

        return $output;
    }

    public static function get_social_media_link( $social_media_id ) 
    {
        $social_media_links = get_option( '_ejo_social_media_links', array() );

        if ( empty($social_media_links) || empty($social_media_links[$social_media_id]) )
            return '';

        return $social_media_links[$social_media_id]['link'];
    }

    public static function get_social_media() 
    {
        $social_media = array(); // [array: term id => term name];

        foreach (self::$default_social_media_links as $social_media_id => $social_media_info) {
            $social_media[$social_media_id] = $social_media_info['name'];
        }        

        return $social_media;
    }
}

EJO_Social_Media_Links::init();

