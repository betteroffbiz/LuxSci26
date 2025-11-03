<?php
/**
 * Simple production-only asset loading
 * This bypasses all development detection
 */

function simple_production_assets() {
  $theme_version = wp_get_theme()->get('Version');
  $theme_dir = get_template_directory();
  $theme_uri = get_template_directory_uri();
  
  // Add debug comment
  add_action('wp_head', function() {
    echo "<!-- SIMPLE PRODUCTION MODE - " . date('H:i:s') . " -->\n";
  });
  
  // PRODUCTION: Load from built manifest
  $manifest_path = $theme_dir . '/dist/.vite/manifest.json';
  if (file_exists($manifest_path)) {
    $manifest = json_decode(file_get_contents($manifest_path), true);
    $entryKey = 'assets/js/main.ts';
    if (isset($manifest[$entryKey])) {
      $entry = $manifest[$entryKey];

      if (!empty($entry['css'])) {
        foreach ($entry['css'] as $css) {
          wp_enqueue_style('simple-prod-style', $theme_uri . '/dist/' . $css, [], $theme_version);
        }
      }
      if (!empty($entry['file'])) {
        wp_enqueue_script('simple-prod-main', $theme_uri . '/dist/' . $entry['file'], [], $theme_version, true);
      }
    }
  }
}

add_action('wp_enqueue_scripts', 'simple_production_assets', 25);

// Simple image function that always uses production paths
function simple_get_asset_image($filename) {
  return get_template_directory_uri() . "/assets/images/{$filename}";
}