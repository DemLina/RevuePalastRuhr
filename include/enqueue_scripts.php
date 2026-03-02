<?php
/**
 * Enqueue scripts and styles.
 */
function enqueue_scripts() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-blocks-style' );
    wp_dequeue_style( 'classic-theme-styles' );
    wp_dequeue_style( 'global-styles' );

    wp_enqueue_style('slick_css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.css', [], null);


    $main_css_path = get_template_directory() . '/dist/style.css';
    wp_enqueue_style('main_css', get_template_directory_uri() . '/dist/style.css', [], filemtime($main_css_path));


    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js', false, '3.7.1', true);
    wp_enqueue_script('jquery');


    wp_enqueue_script('lazy_js', 'https://cdn.jsdelivr.net/npm/jquery-lazy@1.7.11/jquery.lazy.min.js', ['jquery'], '1.7.9', true);
    wp_enqueue_script('slick_js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], '1.8.1', true);


    $main_js_path = get_template_directory() . '/dist/main.js';
    wp_enqueue_script('main_js', get_template_directory_uri() . '/dist/main.js', ['jquery'], filemtime($main_js_path), true);

    wp_localize_script('main_js', 'default_params', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'themeurl' => get_template_directory_uri()
    ]);
}
add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
