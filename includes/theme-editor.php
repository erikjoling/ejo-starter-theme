<?php

// Add styles to editor
add_filter( 'ejo_tinymce_styleformats', 'ejos_tinymce_styleformats' );

// Add editor style
add_action( 'admin_init', 'ejos_add_editor_styles' );
add_filter( 'mce_css', 'ejos_tinymce_remove_mce_css' );
/**
 * Add custom styles to the editor
 */
function ejos_tinymce_styleformats( $style_formats = array() ) {

    return $style_formats;
}

/**
 * Registers an editor stylesheet for the theme.
 */
function ejos_add_editor_styles() {

    // $fonts_stylesheet = str_replace( ',', '%2C', 'https://fonts.googleapis.com/css?family=Lora:400i,700i|Lato:400,400i,700,700i' );
    $font_awesome_stylesheet = str_replace( ',', '%2C', 'https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css' );

    // add_editor_style( $fonts_stylesheet );
    add_editor_style( $font_awesome_stylesheet );

    add_editor_style( THEME_CSS_URI . 'editor.css?ver='.THEME_VERSION );
}

// Unset default wordpress tinymce style
function ejos_tinymce_remove_mce_css($stylesheets) {
    $stylesheets = explode(',',$stylesheets);
    foreach ($stylesheets as $key => $sheet) {
        if (preg_match('/wp\-content\.css/',$sheet)) {
            unset($stylesheets[$key]);
        }
    }
    $stylesheets = implode(',',$stylesheets);
    return $stylesheets;
}
