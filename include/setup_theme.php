<?php
if ( ! function_exists( 'wp_theme_setup' ) ) :
    function wp_theme_setup() {
        add_theme_support( 'title-tag' );

        add_theme_support( 'post-thumbnails' );

        remove_action('wp_head', 'feed_links_extra', 3);
        remove_action('wp_head', 'feed_links', 2);
        remove_action('wp_head', 'rsd_link');
        remove_action('wp_head', 'wlwmanifest_link');
        remove_action('wp_head', 'index_rel_link');
        remove_action('wp_head', 'parent_post_rel_link', 10);
        remove_action('wp_head', 'start_post_rel_link', 10);
        remove_action('wp_head', 'adjacent_posts_rel_link', 10);
        remove_action('wp_head', 'wp_generator');
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'rest_output_link_wp_head');
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('wp_print_styles', 'print_emoji_styles');
    }
endif;
add_action( 'after_setup_theme', 'wp_theme_setup' );


// Remove gutenberg from theme
add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type)
{
    if ($post_type === 'post' || $post_type === 'page') return false;
    return $current_status;
}

add_action('init', 'init_remove_support', 100);
function init_remove_support(){
//    remove_post_type_support( 'post', 'editor');
    remove_post_type_support( 'page', 'editor');
}


// Removing comments from the theme
add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;

    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});

// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});


// Enable the formats dropdown in the tiny mce editor.
add_filter( 'mce_buttons', function( $buttons ) {
    array_push( $buttons, 'styleselect' );
    return $buttons;
} );


// REMOVE COMMENTS ICON FROM WP ADMIN BAR
function remove_comments(){
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'remove_comments' );

// REMOVE EDITOR FROM POSTS
add_action( 'init', function() {
    remove_post_type_support( 'post', 'editor' );
}, 99);



// REMOVE CONTACT FORM 7 AUTO P
add_filter('wpcf7_autop_or_not', '__return_false');



// REMOVE H1 FROM TINY MCE FIELD
function my_format_TinyMCE( $in ) {
    $in['block_formats'] = "Paragraph=p; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6;Preformatted=pre";
    return $in;
}
add_filter( 'tiny_mce_before_init', 'my_format_TinyMCE' );

// Change dashboard Posts to News
add_action( 'init', 'cp_change_post_object' );
function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
    $labels->name = 'Journals';
    $labels->singular_name = 'Journal';
    $labels->add_new = 'Add Journal';
    $labels->add_new_item = 'Add Journal';
    $labels->edit_item = 'Edit Journal';
    $labels->new_item = 'Journal';
    $labels->view_item = 'View Journal';
    $labels->search_items = 'Search Journal';
    $labels->not_found = 'No Journal found';
    $labels->not_found_in_trash = 'No Journal found in Trash';
    $labels->all_items = 'All Journals';
    $labels->menu_name = 'Journals';
    $labels->name_admin_bar = 'Journal';
}

// ADD SUPPORT OF JQUERY LAZY LOAD FOR wp_get_attachment_image FUNCTION
function alter_att_attributes_wpse_102079($attr) {
    if(!is_admin()){
        if($attr['class'] !== 'skip-lazy'){
            $attr['data-src'] = isset($attr['src']) ? $attr['src'] : '';
            $attr['data-srcset'] = isset($attr['srcset']) ? $attr['srcset'] : '';
            $attr['data-sizes'] = isset($attr['sizes']) ? $attr['sizes'] : '';
            $attr['class'] = $attr['class'] . ' lazy';

            $attr['src'] = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';
            $attr['srcset'] = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=';

        }
    }

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'alter_att_attributes_wpse_102079');
