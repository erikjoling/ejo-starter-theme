<?php

add_action( 'widgets_init', 'ejo_unregister_widgets', 99 );

/** 
 * Unregister Widgets that I don't use often
 *
 * Use ejo_base_unregister_widgets filter to manipulate
 */
function ejo_unregister_widgets()
{
	global $wp_widget_factory;

	/* Widgets to remove */
	$widgets_to_unregister = array(
		'WP_Widget_Pages',
		'WP_Widget_Calendar',
		'WP_Widget_Archives',
		'WP_Widget_Meta',
		'WP_Widget_Search',
		'WP_Widget_Categories',
		'WP_Widget_RSS',
		'WP_Widget_Tag_Cloud'
	);

	/* Filter $widgets_to_unregister */
	$widgets_to_unregister = apply_filters( 'ejo_unregister_widgets', $widgets_to_unregister );

	//* Unregister each widget in array $widgets_to_unregister
	foreach ($widgets_to_unregister as $widget) {

		//* Don't unregister if widget is active
		if ( isset($wp_widget_factory->widgets[$widget]) && is_active_widget(false, false, $wp_widget_factory->widgets[$widget]->id_base))
			continue;

		//* Unregister widget
		unregister_widget( $widget );
	}
}
