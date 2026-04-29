<?php
/**
 * Global Configuration
 */

// Site configuration
define('SITE_NAME', 'Sombhabona Learning Hub and Innovation Hub');
define('SITE_URL', 'http://localhost');
define('SITE_EMAIL', 'info@sombhabona.com');
define('SITE_PHONE', '01835350647');
define('SITE_ADDRESS', '756 West Sewrapara, Mirpur, Dhaka');

// Supported languages
define('SUPPORTED_LANGUAGES', ['en', 'bn']);
define('DEFAULT_LANGUAGE', 'en');

// Get current language from URL or session
function getCurrentLanguage() {
    if (isset($_GET['lang']) && in_array($_GET['lang'], SUPPORTED_LANGUAGES)) {
        $_SESSION['language'] = $_GET['lang'];
        return $_GET['lang'];
    }
    return $_SESSION['language'] ?? DEFAULT_LANGUAGE;
}

// Get text in current language
function t($key, $default = '') {
    global $translations;
    $lang = getCurrentLanguage();
    
    if (!isset($translations[$lang])) {
        include(__DIR__ . '/../languages/' . $lang . '.php');
    }
    
    return $translations[$lang][$key] ?? $default;
}

// Email configuration (for contact form)
define('ADMIN_EMAIL', getenv('ADMIN_EMAIL') ?: 'admin@sombhabona.com');
define('SMTP_HOST', getenv('SMTP_HOST') ?: 'localhost');
define('SMTP_PORT', getenv('SMTP_PORT') ?: 587);
define('SMTP_USER', getenv('SMTP_USER') ?: '');
define('SMTP_PASS', getenv('SMTP_PASS') ?: '');

// Session timeout
define('SESSION_TIMEOUT', 3600); // 1 hour

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
