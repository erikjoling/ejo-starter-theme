# Ejo Base
A custom WordPress framework by Ejoweb. It's goal is to make my theme development easier and consistent.

This plugin provides three things:
- It removes some unnecessary Core functionality
- It adds some features and developer tools
- It tweaks the WordPress Admin for better usability

# Usage
Use theme-support for functionality integration and use filters to manipulate them.

### Why not enable all functionality by default and disable via filters?
By letting themes need to specifically enable theme-support the inserted functionality of this plugin becomes a lot more transparent/clear. 

## Removed core functionality

### Blog
By default this plugin hide the posts functionality. If a theme supports `blog` it will be enabled again.

### XML-RPC and Pingback
My clients don't use XML-RPC and Pingback. So I removed support for it by default. Use `xmlrpc` or `pingback` theme support to reintegrate this functionality.

## Added functionality

### Write Log
`write_log( array or string )` is an easy function to write variable data to the debug.log in the `wp-content` folder.

### Array Functions
`array_unset_by_value( string, array )` lets you delete an array record based on the given value.

### Widget Template Loader
Use the Widget Template Loader in your widgets to allow the theme to add custom templates for the widget.

### Custom Scripts
When your theme support `custom-scripts`, `site-scripts` or `post-scripts` you are able to add scripts via the WordPress admin on a per post or per site basis. 

### Social Media
With `social-media` or `social-media-links` supported by your theme it offers functionality to easily manage the links to your social media profiles. 

Might also support `social-media-shares` in the future

## WordPress Admin tweaks

### Admin Dashboard
Use `ejo-admin-dashboard` to let your theme support a cleaned up version of the WordPress dashboard.

### Admin Menu
With `ejo-admin-menu` theme support the menu (left and top) in the WordPress admin is made more usable.

### Text Editor
Add `ejo-text-editor` to your theme to support a cleaned up text-editing experience. It reorganizes the buttons in the tinyMCE bar and hides the buttons most clients won't ever use.


## Shortcodes
* [ejoweb]
* [year]
* [copyright]

## To Do
* Work out dependancy-functionality which themes can easily use to add which plugins they need
* All functionality should be able to implement using theme-support, except helper functions
* All functionality should be possible to manipulate via filters
* **Better document every functionality and global structure**
* Move Ejo Client code to Ejo Client plugin
* **Carbon Fields**
  * Maybe make Ejo Base dependant on carbon fields for theme options?
  * Custom Scripts should utilize carbon fields
  * Maybe integrate carbon fields into Ejo Base
* Maybe extract added functionality to individual plugins:
  - Custom Scripts
  - Social Media
  - (Shortcodes should stay in Ejo Base)
  - Maybe also extract Widget Template Loader class in future