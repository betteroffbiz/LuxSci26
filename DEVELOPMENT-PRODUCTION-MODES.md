# Development vs Production Asset Loading

## Overview
The theme supports both development (with Vite HMR) and production (built assets) modes with automatic detection and manual override options.

## How It Works

### Automatic Detection (Default)
The theme automatically detects whether to use development or production assets based on:

1. **Environment Detection**: Checks if running on localhost, 127.0.0.1, or .local domains
2. **Vite Server Check**: Verifies if the Vite development server is actually running on port 5174
3. **Fallback to Production**: If the server isn't running, uses built assets from `dist/` folder

### Manual Override Options

#### Option 1: Using dev-mode.php (Recommended)
```php
// In functions.php, uncomment this line for development:
require_once get_template_directory() . '/dev-mode.php';

// Comment it out for production:
// require_once get_template_directory() . '/dev-mode.php';
```

#### Option 2: WordPress Constants
Add to your `wp-config.php`:
```php
// For development
define('VITE_DEV', true);
define('VITE_SERVER', 'http://localhost:5174');

// For production
define('VITE_DEV', false);
```

## Development Workflow

### Development Mode
1. Start Vite server: `npm run dev`
2. Ensure dev-mode.php is included in functions.php (optional, auto-detection should work)
3. Assets load from `http://localhost:5174` with HMR

### Production Testing
1. Build assets: `npm run build`
2. Stop Vite server or comment out dev-mode.php
3. Assets load from `dist/` folder

### Production Deployment
1. Run `npm run build` to generate production assets
2. Ensure `dist/` folder is deployed with the theme
3. Remove or comment out dev-mode.php inclusion
4. Theme automatically uses production assets

## Asset Loading Logic

### Development Mode (VITE_DEV = true)
- CSS: Injected by Vite automatically
- JavaScript: Loaded from `http://localhost:5174/assets/js/main.ts`
- HMR: Active for instant updates

### Production Mode (VITE_DEV = false)
- Reads `dist/.vite/manifest.json` for asset mapping
- CSS: Loaded from `dist/assets/main-[hash].css`
- JavaScript: Loaded from `dist/assets/assets/js/main-[hash].js`
- Cache busting via file hashes

## File Structure
```
dist/
├── .vite/
│   └── manifest.json      # Asset mapping for production
├── assets/
│   ├── main-[hash].css    # Compiled CSS
│   └── assets/js/
│       └── main-[hash].js # Compiled JavaScript
```

## Troubleshooting

### Assets Not Loading in Production
1. **Check if build succeeded**: Ensure `dist/.vite/manifest.json` exists
2. **Verify file paths**: Check that assets exist in `dist/assets/`
3. **Clear cache**: Browser and any caching plugins
4. **Check console**: Look for 404 errors or CORS issues

### Development Server Issues
1. **Port conflicts**: Ensure port 5174 is available
2. **CORS errors**: Check Vite server headers configuration
3. **HMR not working**: Restart Vite server, check polling settings
4. **File watching**: Verify `usePolling: true` in vite.config.ts

### Switching Between Modes
1. **Auto-detection not working**: Use manual override methods
2. **Cached assets**: Clear browser cache when switching modes
3. **Mixed assets**: Ensure consistent mode across all pages

## Best Practices

### Development
- Always start with `npm run dev` before coding
- Use browser dev tools to verify HMR is working
- Check network tab to confirm assets are loading from localhost:5174

### Production Testing
- Test production build locally before deployment
- Verify all assets load correctly without Vite server
- Check that file hashes change when assets are updated

### Deployment
- Include `dist/` folder in deployment
- Don't include `node_modules/` or source files
- Ensure production environment doesn't have dev-mode.php enabled

## Commands Reference
```bash
# Development
npm run dev          # Start Vite dev server

# Production
npm run build        # Build production assets
npm run preview      # Preview production build

# Utilities
lsof -i :5174       # Check if Vite server is running
```