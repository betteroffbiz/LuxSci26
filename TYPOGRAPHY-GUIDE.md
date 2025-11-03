# Montserrat Typography Setup

## What I've Added

### 1. **Google Fonts Integration**
- Added Montserrat font import with multiple weights (300-800) and italic styles
- Font loads with `display=swap` for better performance

### 2. **Tailwind Configuration**
- Set Montserrat as the default `sans` font family
- Added custom `heading` font family specifically for headings
- Extended font weights to include all Montserrat variants

### 3. **Base Typography Styles**
- **Body text**: Montserrat, weight 400, line-height 1.6
- **Headings**: Montserrat, weight 600, line-height 1.2
- **Links**: Blue with hover effects and smooth transitions
- **Bold/Strong**: Weight 600 for better readability

### 4. **Responsive Typography Scale**
```css
H1: 4xl mobile → 5xl desktop (font-bold)
H2: 3xl mobile → 4xl desktop (font-semibold) 
H3: 2xl mobile → 3xl desktop (font-semibold)
H4: xl mobile → 2xl desktop (font-medium)
H5: lg mobile → xl desktop (font-medium)
H6: base mobile → lg desktop (font-medium)
```

### 5. **Utility Classes**
Ready-to-use typography classes for your WordPress templates:

#### Display Classes
- `.text-display` - Large hero text (5xl/6xl)
- `.text-headline` - Section headlines (3xl/4xl)
- `.text-subheading` - Subheadings (xl/2xl)

#### Body Text Classes
- `.text-body-large` - Large body text (lg)
- `.text-body` - Default body text (base)
- `.text-body-small` - Small body text (sm)
- `.text-caption` - Captions/labels (xs, uppercase)

#### WordPress-Specific Classes
- `.entry-title` - Blog post titles
- `.entry-content` - Blog post content with prose styling

## Usage Examples

### In PHP Templates
```php
<!-- Hero Section -->
<h1 class="text-display text-center mb-8">
    Welcome to Our Blog
</h1>

<!-- Page Title -->
<h1 class="entry-title">
    <?php the_title(); ?>
</h1>

<!-- Section Headline -->
<h2 class="text-headline mb-6">
    Latest Articles
</h2>

<!-- Blog Content -->
<div class="entry-content">
    <?php the_content(); ?>
</div>

<!-- Large Call-to-Action Text -->
<p class="text-body-large text-center">
    Ready to get started?
</p>
```

### With Tailwind Classes
```php
<!-- Custom styling with Montserrat -->
<h1 class="font-heading text-4xl font-bold mb-4">
    Custom Heading
</h1>

<p class="font-sans text-lg font-normal leading-relaxed">
    This paragraph uses Montserrat font family.
</p>
```

## Testing Your Typography

1. **Visit your site**: `http://localhost:8888/blog/`
2. **Check browser dev tools**: Verify Montserrat is loading
3. **Test responsive design**: Resize browser to see scaling
4. **View blog posts**: Typography should be applied automatically

## Font Weights Available
- `font-light` (300)
- `font-normal` (400) 
- `font-medium` (500)
- `font-semibold` (600)
- `font-bold` (700)
- `font-extrabold` (800)

The typography system is now ready to use throughout your WordPress theme!