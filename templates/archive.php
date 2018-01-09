<?php ejo_get_header(); ?>

<main role="main">

    <section class="archive">

        <?php ejo_the_template_part( 'components/archive-header' ); // Loads the archive-header template. ?>

        <?php if ( have_posts() ) : // Checks if any posts were found. ?>

            <div class="group">

                <?php while ( have_posts() ) : // Begins the loop through found posts. ?>

                    <?php the_post(); // Loads the post data. ?>

                    <?php ejo_the_content_template(); // Loads the right content template. ?>

                <?php endwhile; // End found posts loop. ?>

            </div>

            <?php ejo_the_template_part( 'components/pagination'); // Loads the pagination template. ?>

        <?php else : // If no posts were found. ?>

            <?php ejo_the_template_part( 'content/error' ); // Loads the error template. ?>

        <?php endif; // End check for posts. ?>

    </section>

</main><!-- #content -->

<?php ejo_get_footer(); ?>