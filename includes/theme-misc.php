<?php 

/**
 * Safe Redirect Manager
 */
add_filter( 'srm_restrict_to_capability', function() {
    return 'edit_theme_options';
});