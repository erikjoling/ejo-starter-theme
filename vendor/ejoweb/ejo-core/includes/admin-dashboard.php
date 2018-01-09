<?php 

//* Remove post-related dashboard widgets
add_action('admin_init', 'ejo_manage_dashboard_widgets' );

function ejo_manage_dashboard_widgets() 
{

    // remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
    // remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
    // remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    // remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    // remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
    // remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
    // remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    // remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8

    //* Wordpress seo
    remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
}