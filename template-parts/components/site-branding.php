<a class="branding" href="<?php bloginfo( 'url' ); ?>">

    <?php if (has_custom_logo()) : ?>

        <?php the_custom_logo(); ?>
        <h1 class="screen-reader-text" itemprop="name"><?php bloginfo( 'name' ); ?></h1>

    <?php else : ?>

        <h1 itemprop="name"><?php bloginfo( 'name' ); ?></h1>

    <?php endif; ?>
    
</a>
