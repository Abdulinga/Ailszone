<?php
// Include database connection
include('db.php');

// Check for the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - View Sellers</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 220px;
            background-color: #232f3e;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
            color: white;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #37475a;
        }

        .main {
            margin-left: 220px;
            padding: 40px;
        }

        h1 {
            color: #232f3e;
            text-align: center;
            margin-bottom: 30px;
        }

        .table-container {
            background: white;
            padding: 20px;
            max-width: 100%;
            margin: auto;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #232f3e;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #888;
            font-size: 13px;
        }

        .action-btn {
            background-color: #ff9900;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .action-btn:hover {
            background-color: #e68a00;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Ailszone Admin</h2>
        <a href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
        <a href="add_sellers.php"><i class="fas fa-user-plus"></i> Add Seller</a>
        <a href="view_sellers.php"><i class="fas fa-users"></i> View Sellers</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>

    <div class="main">
        <h1>View Sellers</h1>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Seller Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ensure the query works
                    $query = "SELECT * FROM sellers"; // Assuming 'sellers' table exists
                    $result = mysqli_query($conn, $query);
                    
                    if (mysqli_num_rows($result) > 0) {
                        $counter = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $counter++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                            echo "<td>
                                    <a href='edit_seller.php?id=" . $row['id'] . "' class='action-btn'><i class='fas fa-edit'></i> Edit</a>
                                    <a href='delete_seller.php?id=" . $row['id'] . "' class='action-btn' onclick='return confirm(\"Are you sure you want to delete this seller?\");'><i class='fas fa-trash-alt'></i> Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align:center;'>No sellers found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="footer">
            &copy; <?= date("Y") ?> Ailszone. All rights reserved.
        </div>
    </div>

</body>
</html>
