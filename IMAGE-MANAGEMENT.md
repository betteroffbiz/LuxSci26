# Image Management Guide

## 📁 **Directory Structure**

### **1. `/assets/images/` - Processed Images**
**Processed by Vite during build**
- **Purpose**: Images imported in CSS/JS that benefit from optimization
- **Processing**: Vite will optimize, hash filenames, and copy to `/dist/assets/`
- **Access**: Import in CSS/JS or reference in build manifest

```
assets/images/
├── icons/          # SVG icons, small graphics
├── backgrounds/    # Hero images, section backgrounds  
├── logos/          # Company logos, brand assets
└── ui/            # UI elements, buttons, decorations
```

**Usage Example:**
```css
/* In CSS */
.hero-bg {
  background-image: url('../images/backgrounds/hero.jpg');
}
```

```typescript
// In TypeScript
import logoSrc from '../images/logos/logo.svg';
```

### **2. `/images/` - Static Images**
**Directly accessible, not processed**
- **Purpose**: Images referenced directly in PHP templates
- **Processing**: None - served as-is
- **Access**: Via `get_template_directory_uri()`

```
images/
├── placeholders/   # Default/fallback images
├── admin/         # WordPress admin interface images
└── static/        # Any images that don't need processing
```

**Usage Example:**
```php
<!-- In PHP templates -->
<img src="<?php echo get_template_directory_uri(); ?>/images/placeholders/default-post.jpg" alt="Default">
```

## 📸 **Image Types & Locations**

### **Theme Design Images** → `/assets/images/`
- **Navigation icons** (hamburger, arrows, etc.)
- **Background patterns** or textures
- **UI elements** (borders, decorations)
- **Logo variations** (light/dark themes)
- **Hero section backgrounds**

### **Content Images** → `/images/`
- **Default post thumbnails**
- **Placeholder avatars**
- **Fallback images** for missing content
- **Admin interface graphics**
- **Theme screenshot** (`screenshot.png` in root)

### **User Content** → WordPress Media Library
- **Blog post featured images**
- **Article content images**
- **User uploaded content**
- **Gallery images**

## ⚙️ **WordPress Integration**

### **Helper Functions**
Add these to your `functions.php` for easy image access:

```php
// Get asset image URL (processed by Vite)
function get_asset_image($filename) {
  $manifest_path = get_template_directory() . '/dist/manifest.json';
  if (file_exists($manifest_path)) {
    $manifest = json_decode(file_get_contents($manifest_path), true);
    $asset_key = "assets/images/{$filename}";
    if (isset($manifest[$asset_key])) {
      return get_template_directory_uri() . '/dist/' . $manifest[$asset_key]['file'];
    }
  }
  return get_template_directory_uri() . "/assets/images/{$filename}";
}

// Get static image URL
function get_theme_image($filename) {
  return get_template_directory_uri() . "/images/{$filename}";
}
```

### **Usage in Templates**
```php
<!-- Processed asset image -->
<img src="<?php echo get_asset_image('logos/logo.svg'); ?>" alt="Logo">

<!-- Static theme image -->
<img src="<?php echo get_theme_image('placeholders/default-post.jpg'); ?>" alt="Default">

<!-- WordPress media image -->
<?php the_post_thumbnail('large'); ?>
```

## 🎨 **Image Optimization Guidelines**

### **File Formats**
- **SVG**: Icons, logos, simple graphics
- **WebP**: Modern browsers, best compression
- **AVIF**: Cutting-edge format, even better compression
- **PNG**: Transparency needed, fallback for icons
- **JPG**: Photos, complex images without transparency

### **Size Guidelines**
```
Icons:          24x24, 32x32, 48x48px (SVG preferred)
Logos:          200-400px width (SVG preferred)
Thumbnails:     400x225px (16:9 ratio - matches grid-thumbnail)
Hero Images:    1920x1080px minimum
Backgrounds:    1920px+ width, optimized file size
```

### **Vite Image Processing**
Vite automatically:
- **Optimizes** file sizes
- **Generates hashed filenames** for cache busting
- **Copies** to `/dist/assets/` folder
- **Updates references** in CSS/JS

## 📱 **Responsive Images**

### **WordPress Sizes**
Your theme already includes:
```php
add_image_size('grid-thumbnail', 400, 225, true); // 16:9 for blog grid
```

### **Additional Recommended Sizes**
Add to `inc/setup.php`:
```php
add_image_size('hero-large', 1920, 1080, true);   // Hero images
add_image_size('card-medium', 600, 338, true);    // Larger cards
add_image_size('avatar-small', 64, 64, true);     // User avatars
```

## 🚀 **Performance Best Practices**

### **Optimization**
1. **Compress images** before adding to theme
2. **Use appropriate formats** (WebP/AVIF for modern browsers)
3. **Implement lazy loading** for content images
4. **Use CSS sprites** for multiple small icons
5. **Serve different sizes** for different screen densities

### **Loading Strategy**
```php
<!-- Critical images (above fold) -->
<img src="hero.jpg" alt="Hero" loading="eager">

<!-- Non-critical images -->
<img src="content.jpg" alt="Content" loading="lazy">
```

## 🔄 **Development Workflow**

### **Adding New Images**
1. **Design/UI images** → Save to `/assets/images/` subdirectory
2. **Static/fallback images** → Save to `/images/` subdirectory  
3. **Reference in code** using appropriate method
4. **Vite will process** assets automatically during build

### **Testing**
- **Development**: Images served from `/assets/` and `/images/`
- **Production**: Processed images served from `/dist/assets/`
- **WordPress**: User images managed via Media Library

This structure provides flexibility, optimization, and clear organization for all image needs in your WordPress theme!