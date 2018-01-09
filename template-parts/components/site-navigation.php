<?php if ( has_nav_menu( 'site-navigation' ) ) : // Check if there's a menu assigned to the 'site-navigation' location. ?>

	<nav aria-label="site">

		<?php wp_nav_menu(
			array(
				'theme_location'  => 'site-navigation',
				'container'       => '',
				'menu_id'         => 'site-navigation-items',
				'menu_class'      => 'menu-items',
				'fallback_cb'     => '',
				'items_wrap'      => '<ul id="%s" class="%s">%s</ul>'
			)
		); ?>

	</nav>

<?php endif; // End check for menu. ?>