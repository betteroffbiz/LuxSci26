<?php
/**
 * Theme setup functions
 */

function perf_theme_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);
    
    // Add custom image sizes for grid layout
    add_image_size('grid-thumbnail', 400, 225, true); // 16:9 aspect ratio for grid
    
    // Add menu support
    register_nav_menus([
        'primary' => __('Primary Menu', 'perf-starter'),
    ]);
}
add_action('after_setup_theme', 'perf_theme_setup');

// Register sidebar widget areas
function perf_widgets_init() {
    register_sidebar(array(
        'name'          => 'Primary Sidebar',
        'id'            => 'sidebar-1',
        'description'   => 'Add widgets here to appear in your sidebar.',
        'before_widget' => '<div id="%1$s" class="widget bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-lg font-semibold mb-4">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'perf_widgets_init');