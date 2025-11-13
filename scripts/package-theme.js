#!/usr/bin/env node

/**
 * Package WordPress Theme
 * Creates a production-ready zip file for WordPress theme upload
 */

import { createWriteStream, existsSync, mkdirSync, readFileSync } from 'fs';
import { resolve, dirname, basename } from 'path';
import { fileURLToPath } from 'url';
import archiver from 'archiver';

const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);
const THEME_DIR = resolve(__dirname, '..');
const PACKAGE_JSON_PATH = resolve(THEME_DIR, 'package.json');

// Read theme name from package.json or use directory name
let themeName = basename(THEME_DIR); // Default to directory name (LuxSci26)
try {
  const pkg = JSON.parse(readFileSync(PACKAGE_JSON_PATH, 'utf8'));
  // Use directory name for theme folder, package name is just for npm
  themeName = basename(THEME_DIR);
} catch (error) {
  console.warn('Could not read package.json, using directory name');
  themeName = basename(THEME_DIR);
}

const OUTPUT_DIR = resolve(THEME_DIR, '..', 'theme-packages');
const OUTPUT_FILE = resolve(OUTPUT_DIR, `${themeName}.zip`);

// Files and directories to exclude from the package
const EXCLUDE_PATTERNS = [
  'node_modules',
  'scripts',
  '.git',
  '.github',
  '.vscode',
  '*.log',
  'package-lock.json',
  'yarn.lock',
  'pnpm-lock.yaml',
  '.DS_Store',
  'Thumbs.db',
  '.env*',
  '**/*.map',
  'vite.config.ts',
  'postcss.config.cjs',
  'tailwind.config.cjs',
  'tsconfig.json',
  '*.md',
  'test.php',
  'dev-*.php',
  'simple-production.php',
  'images/placeholders'
];

console.log('📦 Packaging WordPress Theme...');
console.log(`Theme: ${themeName}`);
console.log(`Output: ${OUTPUT_FILE}\n`);

// Create output directory if it doesn't exist
if (!existsSync(OUTPUT_DIR)) {
  mkdirSync(OUTPUT_DIR, { recursive: true });
}

// Create a file to stream archive data to
const output = createWriteStream(OUTPUT_FILE);
const archive = archiver('zip', {
  zlib: { level: 9 } // Maximum compression
});

// Listen for archive events
output.on('close', () => {
  const sizeInMB = (archive.pointer() / 1024 / 1024).toFixed(2);
  console.log(`\n✅ Package created successfully!`);
  console.log(`📊 Total size: ${sizeInMB} MB`);
  console.log(`📍 Location: ${OUTPUT_FILE}`);
  console.log(`\n🚀 Ready to upload to WordPress!`);
});

archive.on('warning', (err) => {
  if (err.code === 'ENOENT') {
    console.warn('⚠️  Warning:', err.message);
  } else {
    throw err;
  }
});

archive.on('error', (err) => {
  console.error('❌ Error creating package:', err);
  process.exit(1);
});

// Pipe archive data to the file
archive.pipe(output);

// Add files to archive with exclusions
console.log('Adding theme files...');

// List of glob patterns to ignore
const ignorePatterns = [
  '.git/**',
  '.github/**',
  '.vscode/**',
  'node_modules/**',
  'scripts/**',
  '*.log',
  'package-lock.json',
  'yarn.lock',
  'pnpm-lock.yaml',
  'package.json',
  '.DS_Store',
  'Thumbs.db',
  '.env*',
  '**/*.map',
  'vite.config.ts',
  'postcss.config.cjs',
  'tailwind.config.cjs',
  'tsconfig.json',
  'BUTTON-SYSTEM.md',
  'CSS-ORGANIZATION.md',
  'DEVELOPMENT-PRODUCTION-MODES.md',
  'FOOTER-IMPLEMENTATION.md',
  'GRID-LAYOUT.md',
  'IMAGE-MANAGEMENT.md',
  'LOGO-INTEGRATION.md',
  'NAVIGATION.md',
  'SIDEBAR-LAYOUT.md',
  'TYPOGRAPHY-GUIDE.md',
  'VITE-SETUP.md',
  'test.php',
  'dev-*.php',
  'images/placeholders/**',
  'assets/js/**',
  'assets/css/main.css'
];

// Add files using glob with ignore patterns
archive.glob('**', {
  cwd: THEME_DIR,
  ignore: ignorePatterns,
  dot: true, // Include hidden files/folders like .vite
  nodir: false
}, {
  prefix: themeName
});

// Finalize the archive
archive.finalize();
