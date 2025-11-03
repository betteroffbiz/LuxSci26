# CSS Organization & FOUC Prevention

## Overview
This document describes how CSS is organized in the theme to maintain clean separation of concerns while preventing Flash of Unstyled Content (FOUC).

## CSS Structure

### 1. Main CSS File (`assets/css/main.css`)
Contains all theme styling organized in layers:

#### Base Layer
- Typography system with Montserrat font
- Global element styles (headings, paragraphs, links)
- Reset and normalization

#### Components Layer
- Navigation components (`.nav-link`, `.nav-dropdown`, etc.)
- Button styles (`.btn-primary`, `.btn-secondary`)
- Typography utility classes (`.text-display`, `.text-headline`, etc.)
- FOUC prevention styles (`.nav-loading` states)

#### Utilities Layer
- Tailwind CSS utilities
- Custom utility classes

### 2. Critical CSS (inline in `header.php`)
Minimal inline CSS to prevent FOUC:
```css
.nav-loading { visibility: hidden; }
.nav-loading header { visibility: visible; display: block; background: #fff; position: sticky; top: 0; z-index: 50; }
.nav-loading .nav-flex { display: flex; align-items: center; justify-content: space-between; height: 4rem; }
@media (min-width: 1024px) { .nav-loading .nav-flex { height: 5rem; } }
```

## FOUC Prevention Strategy

### 1. Loading State Management
- Body gets `nav-loading` class on initial load
- Critical navigation elements remain visible during CSS loading
- Complex navigation elements hidden until styles load
- JavaScript removes loading class when ready

### 2. Progressive Enhancement
- Basic layout works without full CSS
- Enhanced styling applied when CSS loads
- Mobile-first responsive approach
- Graceful degradation for older browsers

### 3. Performance Optimization
- Minimal critical CSS inline (< 1KB)
- Main CSS loaded asynchronously via Vite
- Hot Module Replacement in development
- Optimized builds for production

## Development Workflow

### Development Mode (Vite HMR)
- CSS changes trigger hot updates
- Instant preview of style changes
- Source maps for debugging
- PostCSS processing with Tailwind

### Production Mode
- CSS extracted and minified
- Cache busting via manifest
- Optimized asset delivery
- Critical CSS remains inline for performance

## File Structure
```
assets/css/
├── main.css          # Main stylesheet
└── (generated files in dist/ during build)

header.php            # Contains minimal critical CSS
functions.php         # Asset loading logic
vite.config.ts        # CSS processing configuration
```

## Best Practices

### Adding New Styles
1. Add styles to `main.css` in appropriate `@layer`
2. Use Tailwind utilities where possible
3. Create components for reusable patterns
4. Test with slow connections to verify FOUC prevention

### Critical CSS Guidelines
- Keep inline CSS minimal (< 1KB)
- Only include styles needed for initial render
- Focus on layout and positioning
- Avoid decorative styles in critical CSS

### Performance Considerations
- Use CSS custom properties for theme colors
- Leverage Tailwind's utility classes
- Minimize CSS specificity conflicts
- Test loading performance regularly

## Troubleshooting

### FOUC Issues
- Check if `nav-loading` class is being removed
- Verify critical CSS covers all visible elements
- Test on slow connections
- Ensure JavaScript loading order is correct

### Development Issues
- Restart Vite server if HMR stops working
- Clear browser cache for style changes
- Check browser console for CSS errors
- Verify PostCSS processing is working