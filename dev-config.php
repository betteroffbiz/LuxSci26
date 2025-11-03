<?php
/**
 * Development configuration for Vite integration
 * 
 * Add this to your wp-config.php file or include it in your local development setup:
 * 
 * For local development, add these constants to wp-config.php:
 * define('VITE_DEV', true);
 * define('VITE_SERVER', 'http://localhost:5174');
 * 
 * OR include this file in wp-config.php:
 * require_once(ABSPATH . 'wp-content/themes/Luxsci26/dev-config.php');
 */

// Only set these if not already defined and we're in a local environment
if (!defined('VITE_DEV')) {
    // Check if we're likely in a local development environment
    $is_local = (
        (isset($_SERVER['HTTP_HOST']) && (
            strpos($_SERVER['HTTP_HOST'], 'localhost') !== false ||
            strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false ||
            strpos($_SERVER['HTTP_HOST'], '.local') !== false
        )) ||
        (defined('WP_DEBUG') && WP_DEBUG)
    );
    
    if ($is_local) {
        define('VITE_DEV', true);
        define('VITE_SERVER', 'http://localhost:5174');
    }
}