<?php
/**
 * Admin Dashboard - View and manage leads
 */

require_once(__DIR__ . '/../config/config.php');
require_once(__DIR__ . '/../config/database.php');

// Simple authentication check (you should implement proper auth)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: /admin/login.php');
    exit;
}

// Get all leads
try {
    $page = $_GET['page'] ?? 1;
    $perPage = 20;
    $offset = ($page - 1) * $perPage;

    // Get total count
    $countStmt = $pdo->query("SELECT COUNT(*) as total FROM leads");
    $total = $countStmt->fetch()['total'];
    $totalPages = ceil($total / $perPage);

    // Get leads
    $stmt = $pdo->prepare("SELECT * FROM leads ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $leads = $stmt->fetchAll();

} catch (Exception $e) {
    $leads = [];
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Sombhabona</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
        }

        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .admin-header {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .admin-header h1 {
            font-size: 2rem;
            color: #333;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: #c82333;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }

        .stat-card h3 {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }

        .stat-card .number {
            font-size: 2.5rem;
            color: #0056b3;
            font-weight: bold;
        }

        .leads-table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #0056b3;
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background: #f9f9f9;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-new {
            background: #d4edda;
            color: #155724;
        }

        .status-contacted {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-enrolled {
            background: #c3e6cb;
            color: #155724;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #0056b3;
        }

        .pagination a:hover {
            background: #f0f0f0;
        }

        .pagination .active {
            background: #0056b3;
            color: white;
        }

        .action-btn {
            padding: 5px 10px;
            margin-right: 5px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .view-btn {
            background: #0056b3;
            color: white;
        }

        .edit-btn {
            background: #28a745;
            color: white;
        }

        .delete-btn {
            background: #dc3545;
            color: white;
        }

        @media (max-width: 768px) {
            table {
                font-size: 0.9rem;
            }

            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1><i class="fa-solid fa-chart-line"></i> Admin Dashboard</h1>
            <a href="/admin/logout.php" class="logout-btn">Logout</a>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3>Total Leads</h3>
                <div class="number"><?php echo $total; ?></div>
            </div>
            <div class="stat-card">
                <h3>New Leads</h3>
                <div class="number"><?php 
                    $newCount = $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'new'")->fetch()['count'];
                    echo $newCount;
                ?></div>
            </div>
            <div class="stat-card">
                <h3>Contacted</h3>
                <div class="number"><?php 
                    $contactedCount = $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'contacted'")->fetch()['count'];
                    echo $contactedCount;
                ?></div>
            </div>
            <div class="stat-card">
                <h3>Enrolled</h3>
                <div class="number"><?php 
                    $enrolledCount = $pdo->query("SELECT COUNT(*) FROM leads WHERE status = 'enrolled'")->fetch()['count'];
                    echo $enrolledCount;
                ?></div>
            </div>
        </div>

        <div style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; gap: 1rem; flex-wrap:wrap;">
            <form method="GET" action="/admin/export-leads.php" style="display:flex; gap:8px; align-items:center;">
                <label for="start_date">From:</label>
                <input type="date" name="start_date" id="start_date">
                <label for="end_date">To:</label>
                <input type="date" name="end_date" id="end_date">
                <button type="submit" class="action-btn view-btn">Export CSV</button>
            </form>

            <div style="margin-left:auto;">
                <a href="/admin/export-leads.php" class="action-btn view-btn">Export All</a>
            </div>
        </div>

        <div class="leads-table">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leads as $lead): ?>
                        <tr>
                            <td><?php echo $lead['id']; ?></td>
                            <td><?php echo htmlspecialchars($lead['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($lead['email']); ?></td>
                            <td><?php echo htmlspecialchars($lead['phone']); ?></td>
                            <td><?php echo htmlspecialchars($lead['course_name']); ?></td>
                            <td>
                                <span class="status-badge status-<?php echo $lead['status']; ?>">
                                    <?php echo ucfirst($lead['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('M d, Y', strtotime($lead['created_at'])); ?></td>
                            <td>
                                <a href="/admin/view-lead.php?id=<?php echo $lead['id']; ?>" class="action-btn view-btn">View</a>
                                <a href="/admin/edit-lead.php?id=<?php echo $lead['id']; ?>" class="action-btn edit-btn">Edit</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <?php
            if ($page > 1) {
                echo '<a href="?page=1">First</a>';
                echo '<a href="?page=' . ($page - 1) . '">Previous</a>';
            }
            
            for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++) {
                if ($i == $page) {
                    echo '<span class="active">' . $i . '</span>';
                } else {
                    echo '<a href="?page=' . $i . '">' . $i . '</a>';
                }
            }
            
            if ($page < $totalPages) {
                echo '<a href="?page=' . ($page + 1) . '">Next</a>';
                echo '<a href="?page=' . $totalPages . '">Last</a>';
            }
            ?>
        </div>
    </div>
</body>
</html>
