<?php
/**
 * PHP Built-in Server Router
 * This script emulates Apache's mod_rewrite for the PHP built-in server.
 */

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// 1. Handle /product/slug -> product.php?slug=slug
if (preg_match('#^/product/([^/]+)/?$#', $path, $matches)) {
    $_GET['slug'] = $matches[1];
    include __DIR__ . '/product.php';
    exit;
}

// 2. Handle /collection/slug -> collection.php?category=slug
if (preg_match('#^/collection/([^/]+)/?$#', $path, $matches)) {
    $_GET['category'] = $matches[1];
    include __DIR__ . '/collection.php';
    exit;
}

// 3. Serve static files if they exist
if (file_exists(__DIR__ . $path) && is_file(__DIR__ . $path)) {
    return false;
}

// 4. Default: serve index.php or let server handle 404
if ($path === '/' || $path === '/index.php') {
    include __DIR__ . '/index.php';
    exit;
}

return false;
