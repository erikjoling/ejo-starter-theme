<?php
/**
 * Template part for displaying `posts` in archive
 */

?>

<article class="post-plural">

	<header>

		<?php if ( '' !== get_the_post_thumbnail() ) : ?>

			<a href="<?php the_permalink(); ?>" class="post-thumbnail">
				<?php the_post_thumbnail( 'post-thumbnail' ); ?>
			</a>

		<?php endif; ?>

		<?php the_title( '<h2><a href="' . get_permalink() . '" rel="bookmark">', '</a></h2>' ); ?>

		<div class="meta">
		    <span class="author"><?php echo get_the_author(); ?></span>
		    <?php the_terms( get_the_ID(), 'category', '<span class="categories">', ' / ', '</span>' ); ?>
		    <?php the_tags( '<span class="tags">', ', ', '</span>' ); ?>
		</div>

	</header>

	<div class="content">
		<?php the_excerpt(); ?>
	</div>
		
	<footer><a href="<?php the_permalink(); ?>" class="button">Read more</a></footer>

</article>

