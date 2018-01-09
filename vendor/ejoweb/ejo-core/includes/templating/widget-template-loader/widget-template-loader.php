<?php

/**
 * EJO Widget Template Loader
 *
 * Load widget templates from your theme directory
 *
 * See README.md for how to use
 */
final class EJO_Widget_Template_Loader
{
    //* Holds the instance of this class.
    protected static $_instance = null;

    //* Directory name where custom templates for this plugin should be found in the theme.
    protected static $theme_widget_template_dir = 'widgets';

    //* Only instantiate once
    public static function init() 
    {
        if ( !self::$_instance )
            self::$_instance = new self;
        return self::$_instance;
    }

    //* No clones please!
    protected function __clone() {}

    //* Plugin setup.
    protected function __construct() {}

	/**
	 * Create the file names of templates.
	 *
	 * @param array  $widget_slug	id_base of widget
	 * @param array  $sidebar_slug	id of sidebar where the widget is loaded
	 *
	 * @return array
	 */
	public static function get_template_file_names( $widget_slug, $sidebar_slug ) 
	{
		$template_file_names = array();
		$template_file_names[] = $sidebar_slug . '_' . $widget_slug . '.php';
		$template_file_names[] = $widget_slug . '.php';

		return $template_file_names;
	}

	/**
	 * Return a list of paths to check for template locations.
	 *
	 * Default is to check in a child theme (if relevant) before a parent theme, so that themes which inherit from a
	 * parent theme can just overload one file. If the template is not found in either of those, it looks in the
	 * theme-compat folder last.
	 *
	 * @return mixed|void
	 */
	public static function get_template_directories() 
	{
		$theme_widget_template_dir = trailingslashit( apply_filters( 'ejo_widget_template_dir', self::$theme_widget_template_dir ) );
		$theme_template_dir = trailingslashit( apply_filters( 'ejo_theme_template_dir', '' ) );

		//* Prioritized order of template locations
		$template_directories = array();

		//* Start by setting theme location high in order
		$template_directories[10] = trailingslashit( get_template_directory() ) . $theme_template_dir . $theme_widget_template_dir;
		$template_directories[11] = trailingslashit( get_template_directory() ) . $theme_template_dir;

		//* Set child theme location first if active
		if ( is_child_theme() ) {
			$template_directories[1] = trailingslashit( get_stylesheet_directory() ) . $theme_template_dir . $theme_widget_template_dir;
			$template_directories[2] = trailingslashit( get_stylesheet_directory() ) . $theme_template_dir;
		}

		// Sort the file paths based on priority.
		ksort( $template_directories, SORT_NUMERIC );

		return array_map( 'trailingslashit', $template_directories );
	}


	/**
	 * Retrieve the directory and filename of the highest priority template file that exists.
	 *
	 * @return string The template filename if one is located. Otherwise false
	 */
	public static function get_template_file( $widget_slug, $sidebar_slug ) 
	{
		$template_file_names = self::get_template_file_names( $widget_slug, $sidebar_slug );
		$template_directories = self::get_template_directories();

		//* Try to find a template file.
		foreach ( $template_file_names as $template_file_name ) {

			//* Trim off any slashes from the template name.
			$template_file_name = ltrim( $template_file_name, '/' );

			//* Try locating this template file by looping through the template paths.
			foreach ( $template_directories as $template_directory ) {

				if ( file_exists( $template_directory . $template_file_name ) ) {

					//* Return template file
					return $template_directory . $template_file_name;
				}
			}
		}

		//* Return false if no file found
		return false;
	}

	/**
	 * Get template file.
	 */
	public static function get_template( $args, $widget )
	{
		return self::get_template_file( $widget->id_base, $args['id'] );
	}

	/**
	 * Load a template file.
	 *
	 * @param string $template_file Absolute path to a file or list of template parts.
	 * @param array  $args          Widget $args
	 * @param array  $instance      Widget $instance
	 */
	public static function load_template( $args, $instance, $widget, $data = array() ) 
	{
		//* Get template file
		$template_file = self::get_template_file( $widget->id_base, $args['id'] );

		//* Premature return false if template_file does not exist
		if ( !$template_file )
			return false;

		//* Include the template-file
		require( $template_file );

		//* Return the name of the template-file
		return $template_file;
	}
}