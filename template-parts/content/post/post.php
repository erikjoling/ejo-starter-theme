<?php
/**
 * Template part for displaying `posts`
 */
?>

<article>

	<header>
		<?php ejo_the_template_part( 'components/breadcrumbs' ); // Loads the breadcrumbs template. ?>

		<?php if ( '' !== get_the_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'large' ); ?>
		<?php endif; ?>

		<?php the_title( '<h1>', '</h1>' ); ?>

		<div class="meta">
		    <span class="author"><?php echo get_the_author(); ?></span>
		    <?php the_terms( get_the_ID(), 'category', '<span class="categories">', ' / ', '</span>' ); ?>
		    <?php the_tags( '<span class="tags">', ', ', '</span>' ); ?>
		</div>

	</header>

	<div class="content">
		<?php the_content(); ?>
	</div>
		
</article>

