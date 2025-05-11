<?php
include('db.php');

// Fetch sellers from the database
$query = "SELECT * FROM sellers";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sellers</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-bottom: 30px;
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead {
            background-color: #2c3e50;
            color: white;
        }
        th, td {
            padding: 14px 20px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
        }
        a.button {
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 14px;
            margin-right: 5px;
        }
        a.edit {
            background-color: #3498db;
            color: white;
        }
        a.delete {
            background-color: #e74c3c;
            color: white;
        }
        @media (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead {
                display: none;
            }
            tr {
                margin-bottom: 15px;
                background: #fff;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
                padding: 10px;
                border-radius: 8px;
            }
            td {
                padding: 10px;
                position: relative;
                padding-left: 50%;
            }
            td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                top: 10px;
                font-weight: bold;
                color: #333;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Sellers</h1>
        <table>
            <thead>
                <tr>
                    <th>Seller Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td data-label="Seller Name"><?php echo $row['name']; ?></td>
                    <td data-label="Email"><?php echo $row['email']; ?></td>
                    <td data-label="Phone"><?php echo $row['phone']; ?></td>
                    <td data-label="Actions">
                        <a class="button edit" href="edit-seller.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a class="button delete" href="delete-seller.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this seller?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
