<?php include('db.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Add Seller</title>
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

        .form-container {
            background: white;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        h1 {
            color: #232f3e;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            font-weight: 600;
            margin-top: 15px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #ff9900;
            color: white;
            padding: 12px;
            width: 100%;
            margin-top: 20px;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e68a00;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #888;
            font-size: 13px;
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
        <div class="form-container">
            <h1>Add New Seller</h1>

            <form id="sellerForm" action="add-seller-process.php" method="POST">
                <label for="seller-name">Seller Name</label>
                <input type="text" id="seller-name" name="seller_name" required>

                <label for="seller-email">Seller Email</label>
                <input type="email" id="seller-email" name="seller_email" required>

                <label for="seller-phone">Seller Phone</label>
                <input type="text" id="seller-phone" name="seller_phone" required>

                <label for="seller-password">Password</label>
                <input type="password" id="seller-password" name="seller_password" required>

                <button type="submit">Add Seller</button>
            </form>
        </div>

        <div class="footer">
            &copy; <?= date("Y") ?> Ailszone. All rights reserved.
        </div>
    </div>

    <!-- JavaScript Validation -->
    <script>
        document.getElementById('sellerForm').addEventListener('submit', function(e) {
            const phone = document.getElementById('seller-phone').value;
            if (!/^[0-9]{10,14}$/.test(phone)) {
                alert('Please enter a valid phone number (10-14 digits).');
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
