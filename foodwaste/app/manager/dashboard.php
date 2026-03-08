
<?php
session_start();

// Adjust this path to match your project structure
require_once __DIR__ . '/../../includes/activity-logger.php';

// 1. Simple access control (change "manager_id" to match your login system)
if (!isset($_SESSION['manager_id'])) {
    header('Location: ../login.php'); // adjust path if needed
    exit;
}

$managerId   = $_SESSION['manager_id'];
$managerName = $_SESSION['manager_name'] ?? 'Manager';

// 2. Example: log that the manager opened the dashboard
log_activity('manager_dashboard_view', 'Manager opened dashboard', [
    'manager_id'   => $managerId,
    'manager_name' => $managerName,
]);

// 3. (Optional) Load data from your database
// Include your DB connection here if you have one
// require_once __DIR__ . '/../../includes/db.php';

// Example placeholder numbers; replace with real queries.
$totalDonations   = 25;
$totalFoodWaste   = 8;   // in kg
$totalPartners    = 5;
$pendingRequests  = 3;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manager Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- You can replace this with Bootstrap or your own CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
        }
        .navbar {
            background: #2c3e50;
            color: #fff;
            padding: 10px 20px;
        }
        .navbar a {
            color: #fff;
            margin-right: 15px;
            text-decoration: none;
        }
        .container {
            padding: 20px;
        }
        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .card {
            background: #fff;
            border-radius: 6px;
            padding: 15px;
            flex: 1 1 200px;
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card h3 {
            margin-top: 0;
        }
        .footer {
            text-align: center;
            padding: 10px;
            color: #888;
            font-size: 14px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <span>FoodWaste Management - Manager Dashboard</span>
    <span style="float:right;">
        Logged in as: <?php echo htmlspecialchars($managerName); ?>
        | <a href="../logout.php">Logout</a>
    </span>
</div>

<div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($managerName); ?></h1>
    <p>Here is an overview of the current status:</p>

    <div class="cards">
        <div class="card">
            <h3>Total Donations</h3>
            <p><?php echo (int)$totalDonations; ?></p>
        </div>

        <div class="card">
            <h3>Total Food Waste (kg)</h3>
            <p><?php echo (int)$totalFoodWaste; ?></p>
        </div>

        <div class="card">
            <h3>Active Partners</h3>
            <p><?php echo (int)$totalPartners; ?></p>
        </div>

        <div class="card">
            <h3>Pending Requests</h3>
            <p><?php echo (int)$pendingRequests; ?></p>
        </div>
    </div>

    <!-- You can add tables/charts for recent activities, requests, etc. -->
    <h2 style="margin-top:30px;">Recent Activity</h2>
    <p>This section can show recent donations, pickups, or alerts.</p>
</div>

<div class="footer">
    &copy; <?php echo date('Y'); ?> FoodWaste Management
</div>

</body>
</html>
