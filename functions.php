<?php
require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';

function perf_enqueue_assets() {
  $theme_version = wp_get_theme()->get('Version');
  $theme_dir = get_template_directory();
  $theme_uri = get_template_directory_uri();

  // DEV: Load from Vite server
  if (defined('VITE_DEV') && VITE_DEV) {
    $devServer = defined('VITE_SERVER') ? VITE_SERVER : 'http://localhost:5174';
    // Load the Vite client for HMR + your entry
    wp_enqueue_script('vite-client', $devServer . '/@vite/client', [], null, true);
    wp_enqueue_script('perf-main', $devServer . '/assets/js/main.ts', [], null, true);
    
    // Add module type to both scripts
    add_filter('script_loader_tag', 'perf_add_module_to_vite_script', 10, 3);
    return;
  }

  // PROD: Load from built manifest
  $manifest_path = $theme_dir . '/dist/manifest.json';
  if (!file_exists($manifest_path)) return;

  $manifest = json_decode(file_get_contents($manifest_path), true);
  $entryKey = 'assets/js/main.ts';
  if (!isset($manifest[$entryKey])) return;

  $entry = $manifest[$entryKey];

  if (!empty($entry['css'])) {
    foreach ($entry['css'] as $css) {
      wp_enqueue_style('perf-style', $theme_uri . '/dist/' . $css, [], $theme_version);
    }
  }
  if (!empty($entry['file'])) {
    wp_enqueue_script('perf-main', $theme_uri . '/dist/' . $entry['file'], [], $theme_version, true);
  }
}

// Add type="module" to Vite scripts
function perf_add_module_to_vite_script($tag, $handle, $src) {
  // Only add module type for Vite-related scripts
  if (in_array($handle, ['vite-client', 'perf-main']) && strpos($src, 'localhost') !== false) {
    $tag = '<script type="module" src="' . esc_url($src) . '"></script>' . "\n";
  }
  return $tag;
}

add_action('wp_enqueue_scripts', 'perf_enqueue_assets', 20);