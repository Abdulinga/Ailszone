<?php
// Turn on error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize the input data
    $name = trim($_POST['seller_name']);
    $email = trim($_POST['seller_email']);
    $phone = trim($_POST['seller_phone']);
    $password_raw = $_POST['seller_password'];

    // Validate required fields
    if (empty($name) || empty($email) || empty($phone) || empty($password_raw)) {
        echo "❌ All fields are required!";
        exit;
    }

    // Hash the password
    $password = password_hash($password_raw, PASSWORD_DEFAULT);

    // Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO sellers (name, email, phone, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $password);

    if ($stmt->execute()) {
        echo "✅ New seller added successfully!";
        echo '<br><a href="add_sellers.php">Back to Add Seller Form</a>';
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "❌ Invalid request method.";
}
?>
