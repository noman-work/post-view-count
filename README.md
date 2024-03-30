# My Post View Count Plugin

## Overview

The My Post View Count plugin is a tool for WordPress websites. It helps you keep track of how many times your posts have been viewed by your visitors. You can see these view counts in the WordPress admin area and even display them on your website if you want.

## Installation

1. **Download**: Get the plugin files from WordPress or another trusted source.
2. **Upload**: Put the plugin files in the `/wp-content/plugins/` folder of your WordPress site.
3. **Activate**: Go to your WordPress admin area, find the "Plugins" menu, and activate the My Post View Count plugin.

## How to Use

### Admin Panel

Once activated, you'll see a new column in your WordPress admin area where you manage your posts. This column shows the number of times each post has been viewed.

### Shortcode

You can also show the view count on your website's pages or posts using a shortcode. Here's how:

- **Single Post**: Use `[post_view_count]` shortcode to show the view count for the current post.
- **Specific Post**: Use `[post_view_count post_id="123"]` to show the view count for a specific post (replace "123" with the post ID).
- **All Posts**: Use `[post_view_count post_id="all"]` to show the total view count for all posts combined.

## Deactivation

If you decide to deactivate the plugin, don't worry! It will clean up after itself. When you deactivate the plugin, it removes all the view count data it stored for your posts.
