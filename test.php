<?php
// Simple test file to verify PHP changes are working
// Visit: localhost:8888/blog/wp-content/themes/Luxsci26/test.php

echo "Current time: " . date('Y-m-d H:i:s') . "\n";
echo "VITE_DEV defined: " . (defined('VITE_DEV') ? 'YES' : 'NO') . "\n";
echo "VITE_DEV value: " . (defined('VITE_DEV') ? (VITE_DEV ? 'TRUE' : 'FALSE') : 'NOT DEFINED') . "\n";

// Test if functions.php constants are loaded
if (file_exists('functions.php')) {
    echo "functions.php exists\n";
} else {
    echo "functions.php not found\n";
}