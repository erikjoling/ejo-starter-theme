<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
</head>

<body <?php body_class(); ?>>

    <header role="banner">        
        <div class="wrap">

        <?php ejo_the_template_part( 'components/site-branding', true ); // Loads the site-branding template. ?>                
        <?php ejo_the_template_part( 'components/site-navigation', true ); // Loads the site-navigation template. ?>

        </div>          
    </header>