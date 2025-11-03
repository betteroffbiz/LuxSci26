# Perf Starter (WordPress + Tailwind + Vite)

A tiny, fast base theme for excellent Core Web Vitals. Classic PHP templates, Tailwind for styles, Vite for bundling.

## Quick Start (Theme-only)

1. Copy this `perf-starter` folder into `wp-content/themes/`.
2. In this folder:
   ```bash
   npm install
   npm run build
   ```
3. Activate **Perf Starter** in `wp-admin` → Appearance → Themes.

### Dev server (optional)
- In `wp-config.php`, set `define('VITE_DEV', true);`
- Run `npm run dev`
- The theme will load assets from `http://localhost:5173`

## Tailwind purge
`tailwind.config.cjs` scans PHP/TS files to keep CSS tiny. Adjust `content` paths if you add custom locations.

## Images
Use appropriate custom sizes in `inc/setup.php` and set featured images for LCP templates. Consider AVIF/WebP via server or plugin.

## Fonts
Prefer system fonts or self-hosted WOFF2 with `font-display: swap`. Preload only when measured improvements justify it.

## Build & Ship
```bash
npm run build
```
Uploads hashed assets to `/dist` with a `manifest.json`. `inc/enqueue.php` enqueues the correct files.
Optionally:
```bash
npm run zip
```
to create a distributable zip one level up.

## Notes
- No jQuery; keep JS modular and minimal.
- Defer/async third-party scripts, and remove unused ones.
- Use a page cache and long static TTLs for best CWV.
