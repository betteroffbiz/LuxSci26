import { defineConfig } from 'vite';
import { fileURLToPath } from 'node:url';
import path from 'node:path';

export default defineConfig(() => ({
  root: path.resolve(path.dirname(fileURLToPath(import.meta.url))),
  base: '', // keep relative for WordPress theme
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: { 'assets/js/main': path.resolve(path.dirname(fileURLToPath(import.meta.url)), 'assets/js/main.ts') }
    },
    assetsDir: 'assets',
    // Copy static assets during build
    copyPublicDir: false
  },
  // Optimize asset handling
  assetsInclude: ['**/*.svg', '**/*.png', '**/*.jpg', '**/*.jpeg', '**/*.webp'],
  server: {
    host: 'localhost',
    port: 5174,
    strictPort: true,
    cors: true,
    // Enable file watching with polling for better compatibility
    watch: { usePolling: true, interval: 150 },
    // Configure HMR for WordPress development
    hmr: {
      port: 5174,
      // Ensure HMR works with WAMP setup
      clientPort: 5174
    },
    // Headers to allow cross-origin requests from WordPress
    headers: {
      'Access-Control-Allow-Origin': '*',
      'Access-Control-Allow-Methods': 'GET, POST, PUT, DELETE, OPTIONS',
      'Access-Control-Allow-Headers': 'Origin, X-Requested-With, Content-Type, Accept, Authorization'
    }
  }
}));
