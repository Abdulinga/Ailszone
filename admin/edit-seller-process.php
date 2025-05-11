<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['seller_id'];
    $name = $_POST['seller_name'];
    $email = $_POST['seller_email'];
    $phone = $_POST['seller_phone'];
    $password = $_POST['seller_password'];

    // If password is provided, hash it; otherwise, leave the current password unchanged
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE sellers SET name = '$name', email = '$email', phone = '$phone', password = '$password' WHERE id = $id";
    } else {
        $query = "UPDATE sellers SET name = '$name', email = '$email', phone = '$phone' WHERE id = $id";
    }

    if (mysqli_query($conn, $query)) {
        echo "Seller updated successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
