<?php
/**
 * Export leads as CSV (date range optional)
 */
require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../config/database.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: /admin/login.php');
    exit;
}

$start = $_GET['start_date'] ?? null;
$end = $_GET['end_date'] ?? null;

$params = [];
$where = [];

if ($start) {
    $where[] = "created_at >= :start";
    $params[':start'] = $start . ' 00:00:00';
}
if ($end) {
    $where[] = "created_at <= :end";
    $params[':end'] = $end . ' 23:59:59';
}

$sql = "SELECT id, full_name, email, phone, course_name, message, status, created_at FROM leads";
if (!empty($where)) {
    $sql .= ' WHERE ' . implode(' AND ', $where);
}
$sql .= ' ORDER BY created_at DESC';

try {
    $stmt = $pdo->prepare($sql);
    foreach ($params as $k => $v) $stmt->bindValue($k, $v);
    $stmt->execute();
} catch (Exception $e) {
    die('Query error');
}

$filename = 'leads';
if ($start || $end) {
    $filename .= '_' . ($start ? $start : 'start') . '_to_' . ($end ? $end : 'end');
}
$filename .= '.csv';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');
// BOM for Excel to open UTF-8 correctly
fwrite($output, "\xEF\xBB\xBF");

// Header row
fputcsv($output, ['ID','Full Name','Email','Phone','Course','Message','Status','Created At']);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, [
        $row['id'],
        $row['full_name'],
        $row['email'],
        $row['phone'],
        $row['course_name'],
        $row['message'],
        $row['status'],
        $row['created_at']
    ]);
}

fclose($output);
exit;
?>