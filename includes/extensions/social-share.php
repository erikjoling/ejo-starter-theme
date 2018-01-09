<?php 

// Add shortcode
add_action( 'init', 'ejos_register_social_share_shortcode' );

/**
 * Template part: Social Share 
 * 
 * @access public
 * @return void
 */
function ejo_social_share() {
    ?>
        <aside class="social-share">
            <h3>Deel dit bericht</h3>
            <a target="_blank" title="Share on Twitter" href="https://twitter.com/share?url=<?php echo get_permalink(); ?>">Twitter</a>
            <a target="_blank" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?<?php echo get_permalink(); ?>">Facebook</a>
        </aside>
    <?php
}

/**
 * Register shortcode: Social Share 
 * 
 * @access public
 * @return void
 */
function ejos_register_social_share_shortcode() {
    add_shortcode( 'social_share', 'ejos_social_share_shortcode' );
}

/**
 * Shortcode: Social Share 
 * 
 * @access public
 * @return string
 */
function ejos_social_share_shortcode( $attr, $content, $shortcode_tag ) {
    
    // Shortcode callbacks must return content, hence, output buffering here.
    ob_start();

    ejo_social_share();

    return ob_get_clean();
}