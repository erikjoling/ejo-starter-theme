<?php 

/**
 * Allows putting header.php inside a subdirectory
 *
 * Forked from wp-includes\general-template.php
 */
function ejo_get_header() {

    /* WordPress Core action hook */
    do_action( 'get_header' );

    /* Set `template-parts` as default folder */
    $template_parts_dir = trailingslashit(apply_filters( 'ejo_template_parts_dir', 'template-parts' ));

    /* Set template hierarchy for header */
    $templates = array();
    $templates[] = $template_parts_dir . 'header/header.php';
    $templates[] = $template_parts_dir . 'header.php';
    $templates[] = 'header.php';

    locate_template( $templates, true );
}

/**
 * Allows putting footer.php inside a subdirectory
 *
 * Forked from wp-includes\general-template.php
 */
function ejo_get_footer() {

    /* WordPress Core action hook */
    do_action( 'get_footer' );

    /* Set `template-parts` as default folder */
    $template_parts_dir = trailingslashit(apply_filters( 'ejo_template_parts_dir', 'template-parts' ));

    /* Set template hierarchy for footer */
    $templates = array();
    $templates[] = $template_parts_dir . 'footer/footer.php';
    $templates[] = $template_parts_dir . 'footer.php';
    $templates[] = 'footer.php';

    locate_template( $templates, true );
}

/**
 * Allow custom template directory 
 * Replaces WordPress Core version
 *
 * @param string $slug
 */
function ejo_get_template_part( $slug ) {

    // Just like WordPress Core...
    do_action( "get_template_part_{$slug}", $slug, '' );

    // Set `template-parts` as default template-parts folder
    $template_parts_dir = trailingslashit(apply_filters( 'ejo_template_parts_dir', 'template-parts' ));
    
    // Generate template
    $templates = array(); 
    $templates[] = $template_parts_dir . $slug . '.php';

    return locate_template($templates);
}

/**
 * Load template part
 *
 * @param string  $slug 
 * @param boolean $require_once 
 */
function ejo_the_template_part( $slug, $require_once = true ) {

    $template_part = ejo_get_template_part( $slug );

    if ( ! empty($template_part) )
        load_template( $template_part, $require_once );
    else 
        return false;
}

/**
 * Calculate which content template to get
 * Has a fallback hierarchy, which ejo_get_template_part has not
 *
 * Inspired by Justin Tadlock
 */
function ejo_get_content_template( $post_type = '', $template_type = '') {
    
    // Set up an empty array and get the post type.
    $templates = array();

    // Set `template-parts` as default template-parts folder
    $template_parts_dir = apply_filters( 'ejo_template_parts_dir', 'template-parts' );

    // Set `content` as default entries folder
    $entries_dir = apply_filters( 'ejo_entries_dir', 'content' );

    // Set `content` as default entry file
    $entry_file = apply_filters( 'ejo_default_entry_basename', 'content' );

    // Process given input
    if (!$post_type) {
        
        $post_type = get_post_type();

        // Reset template type because it wouldn't make any sense without a manual post_type
        $template_type = ''; 

        // Add archive template_type to posts in archives
        if ( is_archive() || is_home() ) {
            $template_type = 'plural';
        }
    }

    // Process template based off the post type and template type.
    if ($template_type) {

        $templates[] = "{$template_parts_dir}/{$entries_dir}/{$post_type}/{$post_type}-{$template_type}.php";
        $templates[] = "{$template_parts_dir}/{$entries_dir}/{$post_type}-{$template_type}.php";
    }

    // Template based off the post type.
    $templates[] = "{$template_parts_dir}/{$entries_dir}/{$post_type}/{$post_type}.php";
    $templates[] = "{$template_parts_dir}/{$entries_dir}/{$post_type}.php";

    // Fallback 'content.php' template.
    if ($template_type)
        $templates[] = "{$template_parts_dir}/{$entries_dir}/{$entry_file}-{$template_type}.php"; 

    $templates[] = "{$template_parts_dir}/{$entries_dir}/{$entry_file}.php";

    // Apply filters to the templates array.
    $templates = apply_filters( 'ejo_content_template_hierarchy', $templates );

     // Locate the template.
    return locate_template($templates);
}

/**
 * Load content template
 *
 * @param string $post_type
 * @param string $template_type (file or slug)
 * @param mixed  $require_once (null or boolean)
 */
function ejo_the_content_template( $post_type = '', $template_type = '', $require_once = null ) {
    
    // If file is not a php-file then assume it's a slug and get file
    $template_part = ejo_get_content_template($post_type, $template_type);

    if ($require_once === null) {
        if ( $template_type == 'plural' || strpos( basename($template_part), '-plural' ) !== false ) {
            $require_once = false;
        }
        elseif ( is_archive() || is_home() ) {
            $require_once = false;
        }
        else {
            $require_once = true;            
        }
    }

    if ( ! empty($template_part) )
        load_template( $template_part, $require_once );
    else 
        return false;
}

/**
 * Shortcut for setting up custom postdata. Don't forget to reset postdata afterwards
 */
function ejo_setup_postdata($post) {

    // Set the $post as the global $post object
    $GLOBALS['post'] = get_post($post); 

    // Setup the post data.
    setup_postdata($GLOBALS['post']); 
}




// *** DEPRECATED FUNCTIONS *** //

/**
 * Load template part
 *
 * @param string  $slug 
 * @param boolean $require_once 
 */
function ejo_load_template_part( $slug, $require_once = true ) {

    _deprecated_function( __FUNCTION__, 'Ejo Core 0.4', 'Function is replaced by ejo_the_template_part().' );

    $template_part = ejo_get_template_part( $slug );

    if ( ! empty($template_part) )
        load_template( $template_part, $require_once );
    else 
        return false;
}


/**
 * Load content template
 *
 * @param string $post_type
 * @param string $template_type (file or slug)
 * @param mixed  $require_once (null or boolean)
 */
function ejo_load_content_template( $post_type = '', $template_type = '', $require_once = null ) {
    
    _deprecated_function( __FUNCTION__, 'Ejo Core 0.4', 'Function is replaced by ejo_the_content_template().' );

    // If file is not a php-file then assume it's a slug and get file
    $template_part = ejo_get_content_template($post_type, $template_type);

    if ($require_once === null) {
        if ( strpos( basename($template_part), '-plural' ) !== false ) {
            $require_once = false;
        }
        elseif ( is_archive() || is_home() ) {
            $require_once = false;
        }
        else {
            $require_once = true;            
        }
    }

    if ( ! empty($template_part) )
        load_template( $template_part, $require_once );
    else 
        return false;
}

/**
 * Check if file is a template_part
 *
 * Note: Not in use currently, but keeping it here for reference
 *
 * @param string $file
 */
function ejo_is_template_part($file) {

    _deprecated_function( __FUNCTION__, 'Ejo Core 0.3', 'Function is under consideration.' );

    // Get template-parts path
    $template_parts_path = trailingslashit(THEME_DIR . apply_filters( 'ejo_template_parts_dir', 'template-parts' ));

    // Expect php extension
    $template_part_extension = 'php';

    // Get pathinfo of the file
    $file_pathinfo = pathinfo($file);

    // Check if file has the expected template-part extension
    if ( ! isset($file_pathinfo['extension']) || $file_pathinfo['extension'] != $template_part_extension) {
        return false;
    }

    // Check if file is located in template-parts directory
    if ( ! isset($file_pathinfo['dirname']) || strpos($file_pathinfo['dirname'], $template_parts_path) === false ) {
        return false;
    }

    return true;
}
