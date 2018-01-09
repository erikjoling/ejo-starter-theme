<?php

/**
 * Remove Posts from websites by default
 * 
 * This doesn't really remove posts functionality from WordPress because
 * it is too tightly integrated with the system. It simply hides it from
 * the WordPress back-end
 *
 * What is hidden:
 * - Posts in Admin Menu
 * - New Post in Admin Menu Bar
 * - Access to posts screen (built-in stuff like: edit-posts, categories, tags, new-post)
 * - Activity Dashboard widget
 * - Number of posts in 'right now' Dashboard widget
 * - Recent Posts widget
 * - RSS Feeds
 * 
 * to do:
 * - Posts in sitemap
 * - Yoast SEO 
 * -  
 */ 

/* Remove posts menu */
add_action( 'admin_menu', 'ejo_remove_posts_menu', 99);

//* Remove new-post from admin-bar
add_action( 'admin_bar_menu', 'ejo_remove_posts_menubar', 99);

//* Restrict access to posts screen (edit-posts, categories, tags, new-post)
add_action( 'current_screen', 'ejo_disallow_posts_screen' );

//* Remove post-related dashboard widgets
add_action( 'admin_init', 'ejo_remove_posts_dashboard' );

//* Remove widget 
add_filter( 'ejo_base_unregister_widgets', 'ejo_remove_posts_widget' );

//* Disable RSS Feeds
add_action( 'template_redirect', 'ejo_disable_rss_feeds', 1 );

//* Remove Blog Feed links
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
    

/* Remove posts menu */
function ejo_remove_posts_menu() 
{
    $show_blog_for_admin = apply_filters( 'show_blog_for_admin', false);

    //* Manipulations do not count for admin users
    if (current_user_can('manage_options') && $show_blog_for_admin)
        return;

    //* Try to remove posts-section from menu
    foreach ($GLOBALS['menu'] as $index => $menu_item) {

        //* edit.php represents posts menu
        if ($menu_item[2] == 'edit.php' ) {

            // Unset top level menu
            unset( $GLOBALS['menu'][$index], $GLOBALS['submenu'][ 'edit.php' ] );
            
            // Break out of loop since our goal is reached
            break;
        }
    }
}

/* Remove new-post from admin-bar */
function ejo_remove_posts_menubar($wp_admin_bar) 
{
    $show_blog_for_admin = apply_filters( 'show_blog_for_admin', false);

    //* Manipulations do not count for admin users
    if (current_user_can('manage_options') && $show_blog_for_admin)
        return;

    $wp_admin_bar->remove_node('new-post');      // Remove the new-post link
}

//* Restrict access to posts screen (edit-posts, categories, tags, new-post)
function ejo_disallow_posts_screen($current_screen) 
{
    $show_blog_for_admin = apply_filters( 'show_blog_for_admin', false);

    //* Manipulations do not count for admin users
    if (current_user_can('manage_options') && $show_blog_for_admin)
        return;

    /**
     * Disallow access to post screens
     *
     * Fixes Bug: When saving taxonomy-term of a custom-post-type the $current_screen object will have `post` as post-type
     * Solution: Only disallow when taxonomy is default (post_tag/category) or false
     */
    if ( $current_screen->post_type == 'post' && ($current_screen->taxonomy == 'post_tag' || $current_screen->taxonomy == 'category' || $current_screen->taxonomy == false) ) {
        wp_die( __( 'You are not allowed to access the posts section. Contact your developer if this doesn\'t seem right.' ) );
    }
}

/* Remove Posts Dashboard Widget */
function ejo_remove_posts_dashboard()
{
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}

/* Remove recent_posts widget */
function ejo_remove_posts_widget($widgets_to_unregister) 
{
    $show_blog_for_admin = apply_filters( 'show_blog_for_admin', false);

    //* Manipulations do not count for admin users
    if (current_user_can('manage_options') && $show_blog_for_admin)
        return $widgets_to_unregister;

    $widgets_to_unregister[] = 'WP_Widget_Recent_Posts';

    return $widgets_to_unregister;
}

/**
 * Server 404 on feeds
 */
function ejo_disable_rss_feeds() {
    global $wp_query;

    // Only continue if it's a feed!
    if (!is_feed()) 
        return; 

    // Serve 404
    $wp_query->is_feed = false;
    $wp_query->set_404();
    status_header( 404 );

    // Override the xml+rss header set by WP in send_headers
    header( 'Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset') );
}