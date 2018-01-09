<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make( 'theme_options', __( 'Theme Options', 'ejo' ) )
    ->set_page_parent('themes.php') // "Appearance" menu
    // ->add_tab(__('General'), array(
    //     Field::make("image", "site_background_image", "Website background image"),
    // ))
    ->add_tab(__('Special Pages'), array(
        Field::make("select", "page_on_404", "404 Pagina")->add_options('ejo_get_pages_array'),
        Field::make("html", "404_uitleg")->set_html(
            '<p>De SEO Titel van de 404 pagina kun je aanpassen via <a href="'.get_site_url().'/wp-admin/admin.php?page=wpseo_titles#top#archives">SEO > Titels & Meta\'s</a>. Onder het tab `Archieven` staat het bij Speciale pagina\'s.</p>' . 
            '<hr>' .
            '<p>De breadcrumbs van de 404 pagina kun je aanpassen via <a href="'.get_site_url().'/wp-admin/admin.php?page=wpseo_advanced">SEO > Geavanceerd</a> onder Kruimelpadinstellingen.</p>'
        ),
    ));