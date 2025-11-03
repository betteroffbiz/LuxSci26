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
    
    // Add menu support
    register_nav_menus([
        'primary' => __('Primary Menu', 'perf-starter'),
    ]);
}
add_action('after_setup_theme', 'perf_theme_setup');