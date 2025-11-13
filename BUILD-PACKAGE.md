# WordPress Theme Build & Package System

## Overview
Automated build and packaging system for creating WordPress-ready theme zip files.

## Quick Start

### Build and Package Theme
```bash
npm run build
```
This command will:
1. Compile TypeScript and CSS with Vite
2. Create an optimized production build in `dist/`
3. Package everything into a WordPress-ready zip file
4. Output: `../theme-packages/LuxSci26.zip`

### Other Commands

**Build only (no packaging)**
```bash
npm run build:only
```

**Package only (skip build)**
```bash
npm run package
```

## What Gets Packaged

### ✅ Included Files
- **PHP Templates**: `*.php` files (header, footer, functions, etc.)
- **Built Assets**: Compiled CSS & JS from `dist/`
- **Images**: Icons and logos from `assets/images/`
- **Theme Files**: `style.css`, `theme.json`, `README.md`
- **Includes**: Files from `inc/` directory

### ❌ Excluded Files
- Development files (`node_modules/`, `.git/`, `.vscode/`)
- Source files (`assets/js/*.ts`, `assets/css/main.css`)
- Build configuration (`vite.config.ts`, `tailwind.config.cjs`, etc.)
- Development PHP files (`dev-*.php`, `test.php`)
- Documentation (`.md` files except README.md)
- Placeholder images
- Package management files (`package.json`, `package-lock.json`)

## Package Details

- **Location**: `../theme-packages/LuxSci26.zip`
- **Size**: ~0.05 MB (optimized and compressed)
- **Structure**: Root folder named `LuxSci26/` containing all theme files
- **Compression**: Maximum (level 9)

## Uploading to WordPress

1. Run `npm run build`
2. Navigate to `../theme-packages/`
3. Upload `LuxSci26.zip` via WordPress Admin → Appearance → Themes → Add New → Upload Theme

## Troubleshooting

**Package is too large**: Check if `node_modules/` is being excluded. The script automatically excludes it.

**Missing files in package**: Check the `ignorePatterns` array in `scripts/package-theme.js`

**Build fails**: Ensure you have run `npm install` and all dependencies are installed.

## Customization

To modify what gets included/excluded, edit the `ignorePatterns` array in `scripts/package-theme.js`.
