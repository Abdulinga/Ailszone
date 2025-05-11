<?php
// view_users.php

include 'db.php';
include '../includes/header.php';

// Fetch all users
$query = "SELECT * FROM users"; // Replace with your actual table name
$result = $conn->query($query);
?>

<div class="admin-dashboard">
    <h1>View Users</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $counter++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td>
                            <a href='edit_user.php?id=" . $row['id'] . "' class='action-btn'>Edit</a>
                            <a href='delete_user.php?id=" . $row['id'] . "' class='action-btn' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .table-container {
        background: white;
        padding: 20px;
        margin: auto;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
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
        background-color: #007BFF;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .action-btn {
        background-color: #ff9900;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        text-decoration: none;
    }

    .action-btn:hover {
        background-color: #e68a00;
    }
</style>

<?php
include '../includes/footer.php';
?>
