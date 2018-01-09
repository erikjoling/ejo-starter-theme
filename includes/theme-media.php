<?php

// IMAGE SIZES
add_image_size( 'post-thumbnail', 600, 400, true );
add_image_size( 'max', 1920, 9999, false );

// FILTERS AND ACTIONS

// Replace `Full` image-size by `Max` image-size 
add_filter( 'image_size_names_choose', 'ejos_images_size_names_choose' );

// Set Thumbnail as default option to choose
add_filter( 'pre_option_image_default_size', 'ejos_default_image_size' );

// Set File as default link for gallery images
add_filter( 'media_view_settings', 'ejos_gallery_default_type_set_link');

// Wrap gallery
add_filter( 'do_shortcode_tag', 'ejos_wrap_gallery_tag', 10, 4 );

// FUNCTIONS

function ejos_images_size_names_choose($sizes) {
    
    unset( $sizes['full']);
    $sizes['max'] = __('Max');

    return $sizes;
}

function ejos_default_image_size() {
    return 'thumbnail';
}

// Set File as default link for gallery images
function ejos_gallery_default_type_set_link( $settings ) {

    $settings['galleryDefaults']['link'] = 'file';
    
    return $settings;
}

// Wrap gallery in container
function ejos_wrap_gallery_tag( $output, $tag, $attr, $m ) {
    
    if ($tag == 'gallery')
        $output = '<div class="gallery-container">' . $output . '</div>';

    return $output;
}
