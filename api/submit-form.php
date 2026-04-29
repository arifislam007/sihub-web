<?php
/**
 * Contact Form Submission API
 * Saves form data to PostgreSQL database
 */

header('Content-Type: application/json');

// Include configuration
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../config/database.php');

// Validate request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get form data
$fullName = sanitizeInput($_POST['full_name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$courseName = sanitizeInput($_POST['course_name'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');
$lang = sanitizeInput($_POST['lang'] ?? 'en');

// Validate required fields
$errors = [];

if (empty($fullName)) {
    $errors[] = t('required_field');
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = t('invalid_email');
}

if (empty($phone)) {
    $errors[] = t('required_field');
}

if (empty($courseName)) {
    $errors[] = t('required_field');
}

// Return validation errors
if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => implode(', ', $errors)
    ]);
    exit;
}

try {
    // Prevent rapid duplicate submissions: check if same email+course exists in last 60 seconds
    $dupStmt = $pdo->prepare("SELECT id, created_at FROM leads WHERE email = :email AND course_name = :course_name AND created_at >= NOW() - INTERVAL '60 seconds' ORDER BY created_at DESC LIMIT 1");
    $dupStmt->bindParam(':email', $email);
    $dupStmt->bindParam(':course_name', $courseName);
    $dupStmt->execute();
    $dup = $dupStmt->fetch(PDO::FETCH_ASSOC);
    if ($dup) {
        // Return success but avoid inserting duplicate
        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => t('form_success'),
            'lead_id' => $dup['id'],
            'note' => 'duplicate_detected'
        ]);
        exit;
    }

    // Prepare SQL statement
    $stmt = $pdo->prepare("
        INSERT INTO leads (full_name, email, phone, course_name, message, ip_address)
        VALUES (:full_name, :email, :phone, :course_name, :message, :ip_address)
    ");

    // Bind parameters
    $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    
    $stmt->bindParam(':full_name', $fullName, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':course_name', $courseName, PDO::PARAM_STR);
    $stmt->bindParam(':message', $message, PDO::PARAM_STR);
    $stmt->bindParam(':ip_address', $ipAddress, PDO::PARAM_STR);

    // Execute query
    if ($stmt->execute()) {
        // Get the inserted ID
        $leadId = $pdo->lastInsertId();

        // Send confirmation email (optional)
        sendConfirmationEmail($email, $fullName, $courseName, $lang);

        // Send admin notification
        sendAdminNotification($fullName, $email, $phone, $courseName, $message, $lang);

        http_response_code(200);
        echo json_encode([
            'success' => true,
            'message' => t('form_success'),
            'lead_id' => $leadId
        ]);
    } else {
        throw new Exception('Failed to insert lead');
    }

} catch (PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => t('form_error')
    ]);
} catch (Exception $e) {
    error_log('Error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => t('form_error')
    ]);
}

/**
 * Sanitize user input
 */
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Send confirmation email to user
 */
function sendConfirmationEmail($email, $name, $course, $lang) {
    $subject = ($lang === 'bn') ? 'আপনার আবেদন পেয়েছি' : 'Application Received';
    
    $body = ($lang === 'bn') 
        ? "আপনার আগ্রহের জন্য ধন্যবাদ! আমরা আপনার আবেদন সফলভাবে পেয়েছি। শীঘ্রই আমরা আপনার সাথে যোগাযোগ করব।"
        : "Thank you for your interest! We have successfully received your application. We will contact you soon.";
    
    $headers = "From: " . SITE_EMAIL . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Uncomment to enable email sending
    // mail($email, $subject, $body, $headers);
}

/**
 * Send notification to admin
 */
function sendAdminNotification($name, $email, $phone, $course, $message, $lang) {
    $subject = "New Lead: " . $name;
    
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Course: $course\n";
    $body .= "Message: $message\n";
    
    $headers = "From: " . SITE_EMAIL . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Uncomment to enable email sending
    // mail(ADMIN_EMAIL, $subject, $body, $headers);
}
?>
