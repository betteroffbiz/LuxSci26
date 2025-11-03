<?php
/**
 * Development Mode Toggle
 * 
 * Quick way to switch between development and production asset loading
 * 
 * Usage:
 * - For development (with Vite server running): require_once 'dev-mode.php';
 * - For production: comment out or don't include this file
 */

// Force development mode
define('VITE_DEV', true);
define('VITE_SERVER', 'http://localhost:5174');