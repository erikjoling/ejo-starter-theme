<section class="recent-posts">
    <header>
    	<h1>Updates</h1>
    </header>

	<?php
    $recent_posts = get_posts(array(
			'numberposts' => 2
		));
	?>

	<div class="content">

		<?php if ( !empty($recent_posts) ) : // Checks if any post_ids were found. ?>

			<div class="group">

				<?php foreach( $recent_posts as $recent_post ) : // Begins the loop through found posts. ?>

					<?php ejo_setup_postdata($recent_post); ?>

					<?php ejo_the_content_template( 'post', 'plural' ); // Loads the plural post template (on every loop). ?>

				<?php endforeach; // End found posts loop. ?>

				<?php wp_reset_postdata(); ?>

			</div>

		<?php else : // If no posts were found. ?>

			<?php ejo_the_template_part( 'content/error' ); // Loads the error template. ?>

		<?php endif; // End check for posts. ?>

	</div>

	<footer>
		<h4><a href="<?php echo get_post_type_archive_link( 'post' ); ?>">Ga naar blog...</a></h4>
	</footer>
    
</section>

