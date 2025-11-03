# Placeholder Images

This directory contains placeholder and fallback images for the theme:

## Files to add:
- `default-post.jpg` - Default featured image for posts without thumbnails
- `avatar-placeholder.png` - Default user avatar
- `hero-placeholder.jpg` - Default hero section background
- `logo-placeholder.svg` - Placeholder logo during development

## Usage:
```php
<!-- Default post thumbnail -->
<?php if (has_post_thumbnail()) : ?>
  <?php the_post_thumbnail('grid-thumbnail'); ?>
<?php else: ?>
  <img src="<?php echo get_theme_image('placeholders/default-post.jpg'); ?>" alt="Default post image">
<?php endif; ?>
```