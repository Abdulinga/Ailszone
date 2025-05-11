<?php
// db.php

// Include configuration settings
include_once '../config.php';

// Create connection to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Function to securely escape input
function escapeInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

// Function to close the database connection
function closeDbConnection() {
    global $conn;
    $conn->close();
}
?>
