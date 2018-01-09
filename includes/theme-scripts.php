<?php

// Share breakpoints with javascript (Just before footer scripts)
add_action( 'wp_print_footer_scripts', 'ejos_add_js_breakpoints', 8 ); 

//* Add custom styles & scripts
add_action( 'wp_enqueue_scripts', 'ejos_add_core_scripts', 8 );

//* Add custom styles & scripts
add_action( 'wp_enqueue_scripts', 'ejos_add_theme_styles_and_scripts' );

function ejos_add_js_breakpoints() {

    // Check voor een mooiere oplossing: http://zerosixthree.se/detecting-media-queries-with-javascript/
    $breakpoints = array(
        'xs' => '0',
        'sm' => '480',
        'md' => '720',
        'lg' => '960',
        'xl' => '1200',
    );

    ?>
    <script type='text/javascript'>
        window.breakpoints = <?php echo json_encode($breakpoints); ?>;
    </script>
    <?php
}

/**
 * Load scripts & styles for the front end.
 */
function ejos_add_core_scripts() {
    $suffix = ejo_get_min_suffix();
    
    // wp_enqueue_script( 'polyfill-closest',     THEME_JS_URI . "polyfills/closest{$suffix}.js",    array(), THEME_VERSION, true );
    // wp_enqueue_script( 'polyfill-classlist',   THEME_JS_URI . "polyfills/classList{$suffix}.js",    array(), THEME_VERSION, true );
    // wp_enqueue_script( 'functions-helpers',    THEME_JS_URI . "functions-helpers{$suffix}.js",    array(), THEME_VERSION, true );
    // wp_enqueue_script( 'functions-templating', THEME_JS_URI . "helpers/functions-templating{$suffix}.js", array(), THEME_VERSION, true );
}

/**
 * Load scripts & styles for the front end.
 */
function ejos_add_theme_styles_and_scripts() {
    $suffix = ejo_get_min_suffix();

    /* CSS */
    // wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Lora:400i,700i|Lato:400,400i,700,700i', array(), null);
    wp_enqueue_style( 'font-awesome', 'https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css', array(), null);
    wp_enqueue_style( 'normalize', THEME_CSS_URI . "normalize{$suffix}.css", array(), '5.0.0' );
    wp_enqueue_style( 'theme', THEME_CSS_URI . "theme{$suffix}.css", array(), THEME_VERSION );

    /* SCRIPTS */
    // wp_enqueue_script( 'site-navigation', THEME_JS_URI . "site-navigation{$suffix}.js", array( 'jquery' ), THEME_VERSION, true );
    // wp_enqueue_script( 'theme',           THEME_JS_URI . "theme{$suffix}.js",           array( 'jquery' ), THEME_VERSION, true );
}
