<header class="archive-header">
    <?php ejo_the_template_part( 'components/breadcrumbs' ); // Loads the breadcrumbs template. ?>

    <?php
        the_archive_title( '<h1 class="page-title">', '</h1>' );
        the_archive_description( '<div class="taxonomy-description">', '</div>' );
    ?>
</header><!-- .page-header -->
