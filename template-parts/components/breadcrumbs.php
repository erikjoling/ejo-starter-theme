<?php 
if (!is_front_page()) : // check if front-page

	if ( function_exists('yoast_breadcrumb') ) : ?>

	<p class="breadcrumbs">

		<?php yoast_breadcrumb(
			'',
			''
		); ?>

	</p>

	<?php endif; // end yoast check 
	
endif; // end front-page check
?>