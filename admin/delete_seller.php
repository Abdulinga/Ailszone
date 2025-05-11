<?php
include('db.php');

// Check if ID is provided and is a number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM sellers WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $message = "Seller deleted successfully!";
        $message_type = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $message_type = "error";
    }

    $stmt->close();
} else {
    $message = "Invalid ID.";
    $message_type = "error";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Delete Seller</title>
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

        .message {
            background-color: #f4f4f4;
            padding: 20px;
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .message.success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .message.error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
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
            padding: 10px 20px;
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
        <h1>Delete Seller</h1>

        <div class="message <?php echo $message_type; ?>">
            <p><?php echo $message; ?></p>
            <?php if ($message_type == "success") : ?>
                <a href="view_sellers.php" class="action-btn">Back to Seller List</a>
            <?php else : ?>
                <a href="view_sellers.php" class="action-btn">Go Back</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">
        &copy; <?= date("Y") ?> Ailszone. All rights reserved.
    </div>

</body>
</html>
