<?php 

// Add archive templates to home (posts) hierarchy
add_filter( 'home_template_hierarchy', 'ejo_home_template_hierarchy', 5 );

/**
 * Add archive.php and archive-post.php to home (page selected for blogposts) template stack
 */
function ejo_home_template_hierarchy( $templates ) {

    return array( 'home.php', 'archive-post.php', 'archive.php', 'index.php' );
}

/**
 * Allow templates to be inside custom subdirectory
 * Unfortunately WordPress Core doens't have a good way to change template structure. 
 *
 * Override all `get_query_template` filters to prepend with `template_parts`
 * 
 * Possible values for `$type` include: 'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date',
 * 'embed', home', 'frontpage', 'page', 'paged', 'search', 'single', 'singular', and 'attachment'.
 *
 * source: wp-includes\template.php
 */
add_filter( 'index_template_hierarchy',      'ejo_add_templates_subdirectory' );
add_filter( '404_template_hierarchy',        'ejo_add_templates_subdirectory' );
add_filter( 'archive_template_hierarchy',    'ejo_add_templates_subdirectory' );
add_filter( 'author_template_hierarchy',     'ejo_add_templates_subdirectory' );
add_filter( 'category_template_hierarchy',   'ejo_add_templates_subdirectory' );
add_filter( 'tag_template_hierarchy',        'ejo_add_templates_subdirectory' );
add_filter( 'taxonomy_template_hierarchy',   'ejo_add_templates_subdirectory' );
add_filter( 'date_template_hierarchy',       'ejo_add_templates_subdirectory' );
add_filter( 'embed_template_hierarchy',      'ejo_add_templates_subdirectory' );
add_filter( 'home_template_hierarchy',       'ejo_add_templates_subdirectory' );
add_filter( 'frontpage_template_hierarchy',  'ejo_add_templates_subdirectory' );
add_filter( 'page_template_hierarchy',       'ejo_add_templates_subdirectory' );
add_filter( 'paged_template_hierarchy',      'ejo_add_templates_subdirectory' );
add_filter( 'search_template_hierarchy',     'ejo_add_templates_subdirectory' );
add_filter( 'single_template_hierarchy',     'ejo_add_templates_subdirectory' );
add_filter( 'singular_template_hierarchy',   'ejo_add_templates_subdirectory' );
add_filter( 'attachment_template_hierarchy', 'ejo_add_templates_subdirectory' );

/**
 * Add a subdirectory for templates to WordPress Core templating hierarchy
 */
function ejo_add_templates_subdirectory( $templates ) {

    // Set `templates` as default templates folder
    $template_dir = trailingslashit(apply_filters( 'ejo_template_dir', 'templates' ));

    // Rebuild templates with custom template-subdirectory prepended
    foreach ($templates as $key => $template) {
        /**
         * When a custom page/post-template is selected the templates subdirectory is included in the template path.
         * So we try to remove it
         */
        $template = str_replace($template_dir, '', $template);

        // Add templates subdirectory in front of template
        $templates[$key] = $template_dir . $template;
    }

    return $templates;
}



/**
 * Integrate archive-{post_type}.php for taxonomies (maybe also for authors and dates)
 */
// TODO

/**
 * Integrate archive-post.php for tags and categories (maybe already supported by above)
 */
// TODO