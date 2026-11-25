<?php
/**
 * index.php - titik masuk aplikasi (router)
 * Contoh: index.php?page=user/list
 */
session_start();
ob_start(); // memungkinkan redirect dari modul setelah header dimuat

require_once __DIR__ . '/helpers/functions.php';
require_once __DIR__ . '/config/database.php'; // menyediakan $pdo

// Whitelist rute: hanya halaman di sini yang boleh diakses
$routes = [
    'dashboard'   => __DIR__ . '/views/dashboard.php',
    'about'       => __DIR__ . '/views/about.php',
    'user/list'   => __DIR__ . '/modules/user/list.php',
    'user/add'    => __DIR__ . '/modules/user/add.php',
    'user/edit'   => __DIR__ . '/modules/user/edit.php',
    'user/delete' => __DIR__ . '/modules/user/delete.php',
];

$page = $_GET['page'] ?? 'dashboard';

if (!is_string($page) || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $page        = '404';
    $contentFile = __DIR__ . '/views/404.php';
} else {
    $contentFile = $routes[$page];
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';
ob_end_flush();
