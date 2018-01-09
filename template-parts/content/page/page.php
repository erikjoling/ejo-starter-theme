<?php 
/**
 * Template part for displaying `page` content
 */
?>
<article>
	
	<header>
	
		<?php ejo_the_template_part( 'components/breadcrumbs' ); // Loads the breadcrumbs template. ?>
	
		<?php the_title( '<h1>', '</h1>' ); ?>
		
	</header>
	
	<div class="content">
		<?php the_content(); ?>
	</div>

</article>