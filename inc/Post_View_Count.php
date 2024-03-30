<?php 
/**
 * Main Class
 */
class Post_View_Count 
{
    public function __construct()
    {
        // Debugging: Add debug statement to verify constructor execution
    error_log('Post_View_Count constructor called');
        //Hook the increment function
        add_action('wp', [$this, 'increment_view_count']);

        //Shortcode
        add_shortcode('post_view_count', [$this, 'post_view_count_shortcode']);

        // Add Custom Admin Column
        add_filter('manage_posts_columns', [$this, 'add_view_count_column']);
        add_action('manage_posts_custom_column', [$this, 'show_view_count_column'], 10, 2);
        add_filter('manage_edit-post_sortable_columns', [$this, 'sortable_view_count_column']);
    }

    /**
     * increment view count
     */
    public function increment_view_count()
    {
        if(is_single())
        {
            $post_id = get_the_ID();
            $views = get_post_meta($post_id, 'pwc_post_views', true);
            $views = empty($views) ? 1 : (int)$views + 1;
            update_post_meta($post_id, 'pwc_post_views', $views);
        }
    }

    /**
     * Show view count on column
     */
    public function add_view_count_column($columns)
    {   
        $columns['view_count'] = 'View count';
        return $columns;
    }

    /**
     * Show view count in custom admin column
     */
    public function show_view_count_column($columns, $post_id)
    {
        if($columns === 'view_count')
        {
            $views = get_post_meta($post_id, 'pwc_post_views', true);
            echo empty($views) ? '0' : $views;
        }
    }

    /**
     * Make Column Sortable
     */
    public function sortable_view_count_column($columns)
    {
        $columns['view_count'] = 'view_count';
        return $columns;
    }

    /**
     * Shortcode function to display view count
     */
    public function post_view_count_shortcode($atts) {
        $atts = shortcode_atts([
            'post_id' => '',
            'post' => ''
        ], $atts);

        if (!empty($atts['post_id']) && $atts['post_id'] === 'all') {
            // Show combined view count for all posts (same as before)
            $total_views = 0;
            $args = [
                'post_type' => 'post',
                'posts_per_page' => -1,
                'fields' => 'ids'
            ];
            $posts = get_posts($args);
            foreach ($posts as $post_id) {
                $views = get_post_meta($post_id, 'pwc_post_views', true);
                $total_views += intval($views);
            }
            return '<div class="post-count-wrapper" style=" margin: 10px 0; "><span class="dashicons dashicons-visibility"></span> Post View ' . $total_views . '</div>';
        } elseif (!empty($atts['post_id'])) {
            // If 'post_id' attribute is provided (same as before)
            $views = get_post_meta($atts['post_id'], 'pwc_post_views', true);
            return '<div class="post-count-wrapper" style=" margin: 10px 0; "><span class="dashicons dashicons-visibility"></span>  Post View ' . (empty($views) ? '0' : $views) . '</div>';
        } elseif (is_single()) {
            // If neither 'post_id' nor 'post' attribute is provided and we are on a single post page,
            // automatically retrieve the current post ID and use it to display the view count
            $current_post_id = get_the_ID();
            $views = get_post_meta($current_post_id, 'pwc_post_views', true);
            return '<div class="post-count-wrapper" style=" margin: 10px 0; "><span class="dashicons dashicons-visibility"></span>  Post View ' . (empty($views) ? '0' : $views) . '</div>';
        }

        // If none of the conditions match, return an empty string
        return '';
    }

}
