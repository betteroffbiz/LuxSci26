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
    }
  },
  server: {
    host: 'localhost',           // change to '0.0.0.0' if you want LAN devices
    port: 5173,
    strictPort: true,
    // Windows + file watchers (use if HMR seems flaky):
    watch: { usePolling: true, interval: 150 },
    // If your local WP runs on HTTPS, uncomment and set HTTPS here:
    // https: { key: fs.readFileSync('C:/path/to/localhost-key.pem'),
    //          cert: fs.readFileSync('C:/path/to/localhost-cert.pem') },
    // If a firewall/proxy blocks websockets, pin clientPort:
    // hmr: { clientPort: 5173 }
  }
}));
