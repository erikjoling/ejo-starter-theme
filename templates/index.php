<?php ejo_get_header(); ?>

<main role="main">

    <?php if ( have_posts() ) : // Checks if any posts were found. ?>

        <?php while ( have_posts() ) : // Begins the loop through found posts. ?>

            <?php the_post(); // Loads the post data. ?>

            <?php ejo_the_content_template(); // Loads the right content template. ?>

        <?php endwhile; // End found posts loop. ?>

        <?php ejo_the_template_part( 'components/pagination'); // Loads the pagination template. ?>

    <?php else : // If no posts were found. ?>

        <?php ejo_the_template_part( 'content/error' ); // Loads the error template. ?>

    <?php endif; // End check for posts. ?>

</main><!-- #content -->

<?php ejo_get_footer(); ?>