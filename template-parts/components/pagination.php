<?php if (ejo_is_plural()) : ?>

    <?php the_posts_pagination(
        array( 
            'prev_text' => esc_html( '&laquo;' ), 
            'next_text' => esc_html( '&raquo;' )
        ) 
    ); ?>

<?php endif; // END check for plural ?>
