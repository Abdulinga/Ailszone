<?php
include('db.php');

// Default values
$success = false;
$message = "";

// Handle POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['seller_id']) ? intval($_POST['seller_id']) : 0;
    $name = trim($_POST['seller_name']);
    $email = trim($_POST['seller_email']);
    $phone = trim($_POST['seller_phone']);
    $password = trim($_POST['seller_password']);

    if ($id && $name && $email && $phone) {
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE sellers SET name = ?, email = ?, phone = ?, password = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $name, $email, $phone, $hashed_password, $id);
        } else {
            $stmt = $conn->prepare("UPDATE sellers SET name = ?, email = ?, phone = ? WHERE id = ?");
            $stmt->bind_param("sssi", $name, $email, $phone, $id);
        }

        if ($stmt->execute()) {
            $success = true;
            $message = "Seller details updated successfully.";
        } else {
            $message = "Error updating seller: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Please fill in all required fields.";
    }
} else {
    $message = "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Update Status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 40px;
        }
        .status-box {
            max-width: 600px;
            margin: 80px auto;
            background: white;
            border-left: 6px solid <?= $success ? '#2ecc71' : '#e74c3c' ?>;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        h2 {
            color: <?= $success ? '#2ecc71' : '#e74c3c' ?>;
            margin-bottom: 10px;
        }
        p {
            color: #555;
        }
        .btn-back {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 18px;
            background: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s ease;
        }
        .btn-back:hover {
            background: #2980b9;
        }
    </style>
    
</head>
<body>
    <div class="status-box">
        <h2><?= $success ? 'Success' : 'Error' ?></h2>
        <p><?= htmlspecialchars($message) ?></p>
        <a href="manage-sellers.php" class="btn-back">Go Back to Seller Management</a>
    </div>
</body>
</html>
