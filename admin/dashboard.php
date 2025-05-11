<?php
// dashboard.php

include 'db.php';
include '../includes/header.php';

// Query total counts for dashboard
$totalUsers = $conn->query("SELECT COUNT(*) AS count FROM users")->fetch_assoc()['count'];
$totalProducts = $conn->query("SELECT COUNT(*) AS count FROM products")->fetch_assoc()['count'];
$totalSales = $conn->query("SELECT COUNT(*) AS count FROM orders")->fetch_assoc()['count'];
?>
<div class="admin-dashboard">
    <h1>Admin Dashboard</h1>
    <div class="stats">
        <div class="stat-item">
            <a href="view_users.php" class="stat-link">
                <h3>Total Users</h3>
                <p><?php echo $totalUsers; ?></p>
            </a>
        </div>
        <div class="stat-item">
            <a href="view_products.php" class="stat-link">
                <h3>Total Products</h3>
                <p><?php echo $totalProducts; ?></p>
            </a>
        </div>
        <div class="stat-item">
            <a href="view_sales.php" class="stat-link">
                <h3>Total Sales</h3>
                <p><?php echo $totalSales; ?></p>
            </a>
        </div>
    </div>
</div>

<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
        color: #333;
    }

    h1 {
        text-align: center;
        color: #222;
        margin: 20px 0;
    }

    /* Dashboard Container */
    .admin-dashboard {
        padding: 20px;
    }

    /* Statistics Section */
    .stats {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        margin: 20px auto;
        max-width: 1200px;
        gap: 20px;
    }

    /* Individual Stat Item */
    .stat-item {
        flex: 1;
        min-width: 250px;
        padding: 20px;
        background: #007BFF;
        color: white;
        text-align: center;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-item h3 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #f0f0f0;
    }

    .stat-item p {
        font-size: 40px;
        font-weight: bold;
        margin: 0;
    }

    .stat-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }

    /* Stat Link */
    .stat-link {
        text-decoration: none;
        color: white;
    }

    .stat-link:hover {
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .stats {
            flex-direction: column;
            align-items: center;
        }
    }
</style>

<?php
include '../includes/footer.php';
?>
