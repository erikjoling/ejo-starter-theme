<?php 

/**
 * Helper function for getting the script/style `.min` suffix for minified files. 
 *
 * Shamelessly copied from Hybrid Core (Justin Tadlock)
 */
function ejo_get_min_suffix() {
    return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
}

/**
 * Check the extension of a file
 *
 * @param string $file
 * @param string $extension
 */
function ejo_file_has_extension($file, $extension) {

    _deprecated_function( __FUNCTION__, 'Ejo Core 0.3', 'Function is under consideration.' );

    // We don't want a leading dot
    $extension = ltrim($extension, ".");

    $filetype = wp_check_filetype($file);

    if ($filetype['ext'] == $extension)
        return true;

    return false;
}