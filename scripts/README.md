# WordPress Theme Packaging

This directory contains scripts for building and packaging the theme for WordPress distribution.

## Scripts

### `package-theme.js`
Creates a production-ready zip file of the theme that can be uploaded to WordPress.

## Usage

### Build and Package
```bash
npm run build
```
This will:
1. Build the theme assets with Vite
2. Create a WordPress-ready zip file in `../theme-packages/LuxSci26.zip`

### Package Only (without rebuild)
```bash
npm run package
```
Creates a zip package from the current state without rebuilding.

### Build Only (without packaging)
```bash
npm run build:only
```
Builds the theme assets with Vite without creating a zip package.

## What Gets Packaged

The packaging script includes all necessary WordPress theme files:
- PHP templates
- CSS files
- JavaScript files
- Images and assets
- `style.css` and `theme.json`
- Built files from `dist/` directory

## What Gets Excluded

The following development files are automatically excluded:
- `node_modules/`
- Source files (`src/`, `.ts`, `.tsx`)
- Build configuration files (`vite.config.ts`, `tailwind.config.cjs`, etc.)
- Development PHP files (`dev-*.php`, `test.php`)
- Git files (`.git/`, `.github/`)
- Lock files (`package-lock.json`, `yarn.lock`, etc.)
- Source maps (`*.map`)
- Markdown documentation files (except main `README.md`)
- Placeholder images

## Output Location

Zip files are created in:
```
../theme-packages/LuxSci26.zip
```

This keeps the packages outside the theme directory for easy access and prevents them from being included in subsequent builds.
