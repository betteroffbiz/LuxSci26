<?php
// Production mode - constants managed elsewhere

require_once get_template_directory() . '/inc/setup.php';
require_once get_template_directory() . '/inc/enqueue.php';

// Temporary: Use simple production asset loading
require_once get_template_directory() . '/simple-production.php';

// Uncomment the line below to force development mode
// require_once get_template_directory() . '/dev-mode.php';

// require_once get_template_directory() . '/dev-config.php';

function perf_enqueue_assets() {
  $theme_version = wp_get_theme()->get('Version');
  $theme_dir = get_template_directory();
  $theme_uri = get_template_directory_uri();

  // Debug: Add HTML comment showing current mode
  add_action('wp_head', function() {
    $timestamp = date('Y-m-d H:i:s');
    echo "<!-- Asset Loading Mode: FORCED PRODUCTION - {$timestamp} -->\n";
  });

  // TEMPORARILY DISABLED DEV MODE - FORCE PRODUCTION
  // if (defined('VITE_DEV') && VITE_DEV) {
  //   $devServer = defined('VITE_SERVER') ? VITE_SERVER : 'http://localhost:5174';
  //   // Load the Vite client for HMR + your entry
  //   wp_enqueue_script('vite-client', $devServer . '/@vite/client', [], null, true);
  //   wp_enqueue_script('perf-main', $devServer . '/assets/js/main.ts', [], null, true);
  //   
  //   // Add module type to both scripts
  //   add_filter('script_loader_tag', 'perf_add_module_to_vite_script', 10, 3);
  //   return;
  // }

  // PROD: Load from built manifest
  $manifest_path = $theme_dir . '/dist/.vite/manifest.json';
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

// TEMPORARILY DISABLED
// add_action('wp_enqueue_scripts', 'perf_enqueue_assets', 20);

/**
 * Image helper functions
 */

// Get asset image URL (processed by Vite)
function get_asset_image($filename) {
  $theme_dir = get_template_directory();
  $theme_uri = get_template_directory_uri();
  
  // TEMPORARILY DISABLED DEV MODE - FORCE PRODUCTION FOR IMAGES TOO
  // if (defined('VITE_DEV') && VITE_DEV) {
  //   // In development, serve directly from assets folder via Vite server
  //   $vite_server = defined('VITE_SERVER') ? VITE_SERVER : 'http://localhost:5174';
  //   $url = $vite_server . "/assets/images/{$filename}";
  //   error_log("get_asset_image DEV mode: {$filename} -> {$url}");
  //   return $url;
  // }
  
  // Production: check manifest for hashed filename
  $manifest_path = $theme_dir . '/dist/.vite/manifest.json';
  if (file_exists($manifest_path)) {
    $manifest = json_decode(file_get_contents($manifest_path), true);
    $asset_key = "assets/images/{$filename}";
    if (isset($manifest[$asset_key])) {
      return $theme_uri . '/dist/' . $manifest[$asset_key]['file'];
    }
  }
  
  // Final fallback to direct asset path
  return $theme_uri . "/assets/images/{$filename}";
}

// Get static theme image URL
function get_theme_image($filename) {
  return get_template_directory_uri() . "/images/{$filename}";
}

// Get optimized image with multiple formats (WebP fallback)
function get_responsive_image($filename, $alt = '', $classes = '', $loading = 'lazy') {
  $base_url = get_template_directory_uri() . "/images/{$filename}";
  $webp_url = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $base_url);
  
  $output = '<picture>';
  $output .= '<source srcset="' . esc_url($webp_url) . '" type="image/webp">';
  $output .= '<img src="' . esc_url($base_url) . '" alt="' . esc_attr($alt) . '"';
  if ($classes) {
    $output .= ' class="' . esc_attr($classes) . '"';
  }
  $output .= ' loading="' . esc_attr($loading) . '">';
  $output .= '</picture>';
  
  return $output;
}

/**
 * Add custom fields to user profiles
 */
function add_custom_user_profile_fields($user) {
  ?>
  <h3>Author Profile Information</h3>
  <table class="form-table">
    <tr>
      <th><label for="profile_image">Profile Image</label></th>
      <td>
        <input type="file" name="profile_image" id="profile_image" accept="image/*" />
        <?php 
        $profile_image = get_user_meta($user->ID, 'profile_image', true);
        if ($profile_image): ?>
          <br><br>
          <img src="<?php echo esc_url($profile_image); ?>" alt="Profile Image" style="max-width: 150px; height: auto; border-radius: 50%;" />
          <br><small>Current profile image</small>
        <?php endif; ?>
        <br><span class="description">Upload a profile image to display in author bio boxes.</span>
      </td>
    </tr>
    <tr>
      <th><label for="facebook_url">Facebook URL</label></th>
      <td>
        <input type="url" name="facebook_url" id="facebook_url" value="<?php echo esc_attr(get_user_meta($user->ID, 'facebook_url', true)); ?>" class="regular-text" />
        <br><span class="description">Enter your Facebook profile or page URL</span>
      </td>
    </tr>
    <tr>
      <th><label for="instagram_url">Instagram URL</label></th>
      <td>
        <input type="url" name="instagram_url" id="instagram_url" value="<?php echo esc_attr(get_user_meta($user->ID, 'instagram_url', true)); ?>" class="regular-text" />
        <br><span class="description">Enter your Instagram profile URL</span>
      </td>
    </tr>
    <tr>
      <th><label for="twitter_url">X (Twitter) URL</label></th>
      <td>
        <input type="url" name="twitter_url" id="twitter_url" value="<?php echo esc_attr(get_user_meta($user->ID, 'twitter_url', true)); ?>" class="regular-text" />
        <br><span class="description">Enter your X (Twitter) profile URL</span>
      </td>
    </tr>
    <tr>
      <th><label for="linkedin_url">LinkedIn URL</label></th>
      <td>
        <input type="url" name="linkedin_url" id="linkedin_url" value="<?php echo esc_attr(get_user_meta($user->ID, 'linkedin_url', true)); ?>" class="regular-text" />
        <br><span class="description">Enter your LinkedIn profile URL</span>
      </td>
    </tr>
  </table>
  <?php
}
add_action('show_user_profile', 'add_custom_user_profile_fields');
add_action('edit_user_profile', 'add_custom_user_profile_fields');

/**
 * Save custom user profile fields
 */
function save_custom_user_profile_fields($user_id) {
  if (!current_user_can('edit_user', $user_id)) {
    return false;
  }

  // Handle profile image upload
  if (!empty($_FILES['profile_image']['name'])) {
    $upload = wp_handle_upload($_FILES['profile_image'], array('test_form' => false));
    if ($upload && !isset($upload['error'])) {
      update_user_meta($user_id, 'profile_image', $upload['url']);
    }
  }

  // Save social media URLs
  if (isset($_POST['facebook_url'])) {
    update_user_meta($user_id, 'facebook_url', sanitize_url($_POST['facebook_url']));
  }
  if (isset($_POST['instagram_url'])) {
    update_user_meta($user_id, 'instagram_url', sanitize_url($_POST['instagram_url']));
  }
  if (isset($_POST['twitter_url'])) {
    update_user_meta($user_id, 'twitter_url', sanitize_url($_POST['twitter_url']));
  }
  if (isset($_POST['linkedin_url'])) {
    update_user_meta($user_id, 'linkedin_url', sanitize_url($_POST['linkedin_url']));
  }
}
add_action('personal_options_update', 'save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'save_custom_user_profile_fields');

/**
 * Add enctype to user profile form to support file uploads
 */
function add_profile_form_enctype() {
  echo 'enctype="multipart/form-data"';
}
add_action('user_edit_form_tag', 'add_profile_form_enctype');

/**
 * Get author bio box HTML
 */
function get_author_bio_box($author_id = null) {
  // Get author ID from current post if not provided
  if (!$author_id) {
    $author_id = get_the_author_meta('ID');
  }
  
  // Get author information
  $author_name = get_the_author_meta('display_name', $author_id);
  $author_bio = get_the_author_meta('description', $author_id);
  $profile_image = get_user_meta($author_id, 'profile_image', true);
  
  // Get social media URLs
  $facebook_url = get_user_meta($author_id, 'facebook_url', true);
  $instagram_url = get_user_meta($author_id, 'instagram_url', true);
  $twitter_url = get_user_meta($author_id, 'twitter_url', true);
  $linkedin_url = get_user_meta($author_id, 'linkedin_url', true);
  
  // Don't show bio box if there's no bio
  if (empty($author_bio)) {
    return '';
  }
  
  // Fallback to default avatar if no profile image
  if (empty($profile_image)) {
    $profile_image = get_avatar_url($author_id, array('size' => 120));
  }
  
  ob_start();
  ?>
  <div class="author-bio-box bg-gray-50 border border-gray-200 rounded-lg p-6 mt-8">
    <!-- Header with profile picture and name -->
    <div class="flex gap-4 items-center mb-3">
      <div class="flex-shrink-0">
        <img src="<?php echo esc_url($profile_image); ?>" 
             alt="<?php echo esc_attr($author_name); ?>" 
             class="w-16 h-16 rounded-full object-cover border-2 border-gray-300">
      </div>
      <h3 class="text-lg font-semibold text-gray-900">
        About <?php echo esc_html($author_name); ?>
      </h3>
    </div>
    
    <!-- Bio content spans full width -->
    <div class="text-gray-600 leading-relaxed mb-3 text-sm">
      <?php echo wpautop(esc_html($author_bio)); ?>
    </div>
    
    <!-- Social Media Links -->
    <?php if ($facebook_url || $instagram_url || $twitter_url || $linkedin_url): ?>
      <div class="flex gap-2 items-center">
        <span class="text-xs text-gray-500 font-medium">Follow:</span>
        
        <?php if ($facebook_url): ?>
          <a href="<?php echo esc_url($facebook_url); ?>" 
             target="_blank" 
             rel="noopener noreferrer"
             class="text-gray-400 hover:text-blue-600 transition-colors duration-200"
             aria-label="<?php echo esc_attr($author_name); ?> on Facebook">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
          </a>
        <?php endif; ?>
        
        <?php if ($instagram_url): ?>
          <a href="<?php echo esc_url($instagram_url); ?>" 
             target="_blank" 
             rel="noopener noreferrer"
             class="text-gray-400 hover:text-pink-600 transition-colors duration-200"
             aria-label="<?php echo esc_attr($author_name); ?> on Instagram">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.418-3.323c.875-.875 2.026-1.297 3.323-1.297s2.448.422 3.323 1.297c.928.875 1.418 2.026 1.418 3.323s-.49 2.448-1.418 3.244c-.875.807-2.026 1.297-3.323 1.297z"/>
            </svg>
          </a>
        <?php endif; ?>
        
        <?php if ($twitter_url): ?>
          <a href="<?php echo esc_url($twitter_url); ?>" 
             target="_blank" 
             rel="noopener noreferrer"
             class="text-gray-400 hover:text-gray-900 transition-colors duration-200"
             aria-label="<?php echo esc_attr($author_name); ?> on X (Twitter)">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
              <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
          </a>
        <?php endif; ?>
        
        <?php if ($linkedin_url): ?>
          <a href="<?php echo esc_url($linkedin_url); ?>" 
             target="_blank" 
             rel="noopener noreferrer"
             class="text-gray-400 hover:text-blue-700 transition-colors duration-200"
             aria-label="<?php echo esc_attr($author_name); ?> on LinkedIn">
            <img src="<?php echo get_asset_image('logos/Linkedin-Logo.svg'); ?>" 
                 alt="LinkedIn" 
                 class="w-20 h-5"
                 style="width: 79px; height: 20px;">
          </a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
  <?php
  return ob_get_clean();
}

/**
 * Display author bio box
 */
function display_author_bio_box($author_id = null) {
  echo get_author_bio_box($author_id);
}