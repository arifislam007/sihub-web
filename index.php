<?php
/**
 * Main Router - index.php
 * Routes requests to appropriate pages
 */

// Start session and include config
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once(__DIR__ . '/config/config.php');
require_once(__DIR__ . '/config/database.php');

// Get current page and language
$page = $_GET['page'] ?? 'home';
$lang = $_GET['lang'] ?? DEFAULT_LANGUAGE;

// Validate page parameter
$validPages = ['home', 'courses', 'contact', 'about'];
if (!in_array($page, $validPages)) {
    $page = 'home';
}

// Set language in session
if (in_array($lang, SUPPORTED_LANGUAGES)) {
    $_SESSION['language'] = $lang;
} else {
    $lang = $_SESSION['language'] ?? DEFAULT_LANGUAGE;
}

// Include header
include(__DIR__ . '/includes/header.php');

// Include page
$pageFile = __DIR__ . '/pages/' . $page . '.php';
if (file_exists($pageFile)) {
    include($pageFile);
} else {
    include(__DIR__ . '/pages/home.php');
}

// Include footer
include(__DIR__ . '/includes/footer.php');
?>
