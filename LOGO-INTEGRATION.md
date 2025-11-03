# Logo Integration Guide

## Current Setup

### Logo File
- **Location**: `/assets/images/logos/horizontal-logo-dark.svg`
- **Format**: SVG (scalable vector graphics)
- **Dimensions**: 270x48 pixels (16:9 aspect ratio)
- **Colors**: LuxSci brand colors (blue tones)

### Implementation
The logo is integrated into the navigation header using the `get_asset_image()` helper function:

```php
<img src="<?php echo get_asset_image('logos/horizontal-logo-dark.svg'); ?>" 
     alt="<?php bloginfo('name'); ?>" 
     class="h-8 lg:h-10 w-auto">
```

### Responsive Sizing
- **Mobile/Tablet**: `h-8` (32px height)
- **Desktop (lg+)**: `h-10` (40px height)
- **Width**: `w-auto` (maintains aspect ratio)

## How It Works

### Development Mode
When `VITE_DEV` is enabled:
- Logo served directly from Vite server: `http://localhost:5174/assets/images/logos/horizontal-logo-dark.svg`
- Real-time updates when logo file changes
- No build process required

### Production Mode
When built for production:
- Vite processes and optimizes the SVG
- Generates hashed filename for cache busting
- References updated in manifest.json
- Served from `/dist/assets/` directory

### Helper Function Flow
1. **Development**: Serves from Vite server directly
2. **Production**: Checks manifest.json for processed filename
3. **Fallback**: Direct asset path if manifest unavailable

## Logo Variations

### Adding Additional Logos
You can add more logo variations to `/assets/images/logos/`:

```
logos/
├── horizontal-logo-dark.svg      # Current logo
├── horizontal-logo-light.svg     # Light version for dark backgrounds
├── logo-icon.svg                # Icon-only version for mobile
└── logo-stacked.svg              # Vertical stacked version
```

### Usage Examples
```php
<!-- Light version for dark headers -->
<img src="<?php echo get_asset_image('logos/horizontal-logo-light.svg'); ?>" alt="Logo">

<!-- Icon only for mobile -->
<img src="<?php echo get_asset_image('logos/logo-icon.svg'); ?>" alt="Logo" class="h-8 w-8">

<!-- Conditional logo based on theme -->
<?php if (is_dark_theme()) : ?>
  <img src="<?php echo get_asset_image('logos/horizontal-logo-light.svg'); ?>" alt="Logo">
<?php else : ?>
  <img src="<?php echo get_asset_image('logos/horizontal-logo-dark.svg'); ?>" alt="Logo">
<?php endif; ?>
```

## Styling

### Current Styles
- **Hover Effect**: `hover:opacity-80` - subtle opacity change
- **Transition**: `transition-opacity duration-200` - smooth animation
- **Container**: `flex-shrink-0` - prevents logo from shrinking

### Customization Options
```css
/* Custom logo styles */
.logo-container {
  /* Add drop shadow */
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

.logo-container:hover {
  /* Scale on hover */
  transform: scale(1.05);
}

/* Responsive logo sizing */
@media (max-width: 640px) {
  .logo-mobile {
    height: 24px; /* Smaller on very small screens */
  }
}
```

## SEO & Accessibility

### Current Implementation
- **Alt Text**: Uses WordPress site name (`bloginfo('name')`)
- **Semantic HTML**: Proper link structure with image
- **File Format**: SVG for crisp rendering at all sizes

### Best Practices
```php
<!-- Enhanced accessibility -->
<a href="<?php echo esc_url(home_url('/')); ?>" 
   class="logo-link" 
   aria-label="<?php bloginfo('name'); ?> - Return to homepage">
  <img src="<?php echo get_asset_image('logos/horizontal-logo-dark.svg'); ?>" 
       alt="<?php bloginfo('name'); ?> logo" 
       class="logo-image h-8 lg:h-10 w-auto"
       width="270" 
       height="48">
</a>
```

## Performance

### SVG Benefits
- **Scalable**: Crisp at any size
- **Small file size**: Vector format, typically smaller than raster images
- **Cacheable**: Browser caching and CDN friendly
- **Inline option**: Can be inlined in HTML for faster loading

### Optimization
- **Vite processing**: Automatically optimizes SVG during build
- **Cache busting**: Hashed filenames prevent stale cache
- **Gzip compression**: SVG text compresses well

## Troubleshooting

### Logo Not Showing
1. **Check file path**: Ensure logo exists at `/assets/images/logos/horizontal-logo-dark.svg`
2. **Verify Vite server**: Should be running on port 5174
3. **Check console**: Browser dev tools for 404 errors
4. **Clear cache**: Browser cache or WordPress cache

### Development vs Production
- **Development**: Logo served from `localhost:5174`
- **Production**: Logo served from `/dist/assets/` with hashed filename
- **Fallback**: Direct asset path if other methods fail

The logo integration is now fully functional and optimized for both development and production environments!