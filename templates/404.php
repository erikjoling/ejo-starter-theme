<?php ejo_get_header(); ?>

<main role="main">

    <?php $page_404 = get_404_page(); ?>

    <?php if ($page_404) : ?>

        <?php ejo_setup_postdata($page_404); ?>
        
        <?php ejo_the_content_template(); ?>

        <?php wp_reset_postdata(); ?>

    <?php else: ?>

        <?php ejo_the_template_part( 'content/error' ); ?>
    
    <?php endif; ?>

</main>

<?php ejo_get_footer(); ?>