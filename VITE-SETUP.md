# Vite + WordPress Development Setup

## Quick Start

1. **Start the Vite development server:**
   ```bash
   npm run dev
   ```

2. **Access your WordPress site:**
   - WAMP: `http://localhost:8888/blog/`
   - The theme will automatically load assets from the Vite dev server

## Configuration

The theme is configured to automatically detect local development and switch between:
- **Development mode**: Loads assets from Vite dev server (localhost:5173)
- **Production mode**: Loads from built assets in `/dist` folder

### Development Mode
When `VITE_DEV` is enabled, the theme loads:
- `http://localhost:5173/@vite/client` (for Hot Module Replacement)
- `http://localhost:5173/assets/js/main.ts` (your main entry file)

### Files Modified for Vite Integration
- `functions.php`: Asset enqueuing logic
- `dev-config.php`: Auto-detects local development environment
- `vite.config.ts`: Configured for WordPress development

## Troubleshooting Server Errors

### 1. Port Issues
If you get "Port already in use" errors:
```bash
# Find what's using the port
lsof -ti:5173

# Kill the process (replace PID with actual process ID)
kill -9 <PID>

# Or use a different port in vite.config.ts
```

### 2. CORS Issues
The Vite config includes CORS headers to allow requests from WordPress. If you still get CORS errors:
- Ensure Vite server is running on localhost:5173
- Check that WordPress is accessing the correct URLs
- Verify the `VITE_SERVER` constant matches your Vite server URL

### 3. Assets Not Loading
If assets aren't loading in development:
1. Check if Vite server is running: `http://localhost:5173`
2. Verify `VITE_DEV` constant is set (should auto-detect)
3. Check browser console for errors
4. Ensure WordPress can reach localhost:5173

### 4. HMR (Hot Module Replacement) Not Working
If changes aren't reflected immediately:
- Check browser console for HMR connection errors
- Ensure no firewall is blocking WebSocket connections
- Try refreshing the page manually

### 5. Build Errors
For production builds:
```bash
# Build for production
npm run build

# Check if manifest.json is created
ls -la dist/

# The theme will automatically switch to production mode
```

## Development Workflow

1. Start Vite: `npm run dev`
2. Edit files in `assets/js/` or `assets/css/`
3. Changes should reflect immediately (HMR)
4. For production: `npm run build`

## File Structure
```
theme/
├── assets/
│   ├── css/main.css          # Main stylesheet
│   └── js/main.ts            # Main TypeScript entry
├── dist/                     # Built assets (production)
├── inc/
│   ├── setup.php
│   └── enqueue.php
├── dev-config.php            # Development configuration
├── functions.php             # Main theme functions
├── vite.config.ts            # Vite configuration
└── package.json
```