<?php
/*
 * Plugin Name:       My Post View Count
 * Plugin URI:        https://nomanwc.com
 * Description:       This plugin records the number of views a post has received and displays it in admin post list and via a shortcode.
 * Version:           1.0.0
 * Requires at least: 6.2
 * Requires PHP:      8.1
 * Author:            Abdullah Al Noman
 * Author URI:        https://nomanwc.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://nomanwc.com
 * Text Domain:       my-post-view-count
 * Domain Path:       /languages
 */

// Prevent direct access to this file
defined('ABSPATH') || exit;

// Include the main plugin class
require_once plugin_dir_path(__FILE__) . 'inc/Post_View_Count.php';


// Hook the deactivation function
function pwc_plugin_deactivation() {
    // Get all post IDs
    $post_ids = get_posts(array(
        'fields'         => 'ids',
        'posts_per_page' => -1,
    ));

    // Delete meta data for each post
    foreach ($post_ids as $post_id) {
        delete_post_meta($post_id, 'pwc_post_views');
    }
}
register_deactivation_hook(__FILE__, 'pwc_plugin_deactivation');


// Instantiate the main plugin class
new Post_View_Count();