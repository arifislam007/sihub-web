<?php

declare(strict_types=1);

function respond(array $payload, int $statusCode = 200): void
{
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($payload);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(['success' => false, 'message' => 'Method not allowed.'], 405);
}

$fullName = trim((string) ($_POST['fullName'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$course = trim((string) ($_POST['course'] ?? ''));
$message = trim((string) ($_POST['message'] ?? ''));

if (mb_strlen($fullName) < 3) {
    respond(['success' => false, 'message' => 'Name must be at least 3 characters.'], 422);
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(['success' => false, 'message' => 'Invalid email address.'], 422);
}

if (!preg_match('/^[0-9+\-()\s]{8,20}$/', $phone)) {
    respond(['success' => false, 'message' => 'Invalid phone number.'], 422);
}

if ($course === '') {
    respond(['success' => false, 'message' => 'Please select a course.'], 422);
}

$ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$entry = [
    'time' => gmdate('c'),
    'name' => $fullName,
    'email' => $email,
    'phone' => $phone,
    'course' => $course,
    'message' => $message,
    'ip' => $ipAddress,
];

$logPath = __DIR__ . '/storage/contact-submissions.log';
$storageDir = dirname($logPath);
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0775, true);
}

$written = file_put_contents($logPath, json_encode($entry) . PHP_EOL, FILE_APPEND | LOCK_EX);
if ($written === false) {
    respond(['success' => false, 'message' => 'Failed to save your request. Please try again.'], 500);
}

respond([
    'success' => true,
    'message' => 'Message received successfully.',
]);
