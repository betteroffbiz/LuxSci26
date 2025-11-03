# Asset Images

This directory contains images that are processed by Vite during the build process:

## Subdirectories:

### `/icons/`
- SVG icons used in the theme
- Small graphics and UI elements
- Navigation icons, social icons, etc.

### `/backgrounds/`
- Hero section backgrounds
- Section backgrounds
- Pattern/texture images

### `/logos/`
- Company logos
- Brand assets
- Logo variations (light/dark, different sizes)

## Usage:
Images in this directory can be imported in CSS or JavaScript:

```css
.hero {
  background-image: url('../images/backgrounds/hero.jpg');
}
```

```typescript
import logoSrc from '../images/logos/logo.svg';
```

During build, Vite will:
1. Optimize the images
2. Generate hashed filenames
3. Copy to `/dist/assets/`
4. Update references in your code