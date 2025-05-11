<?php
include '../includes/db.php'; // Include database connection

if (isset($_POST['upload'])) {
    $userId = 1; // Replace with the logged-in user's ID
    $targetDir = "../uploads/";
    $fileName = basename($_FILES["profile_pic"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow only image files
    $allowTypes = ['jpg', 'png', 'jpeg', 'gif'];
    if (in_array(strtolower($fileType), $allowTypes)) {
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $targetFilePath)) {
            // Update the database with the profile picture path
            $update = $conn->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
            $update->bind_param("si", $fileName, $userId);
            if ($update->execute()) {
                echo "Profile picture uploaded successfully.";
            } else {
                echo "Failed to update the database.";
            }
        } else {
            echo "Failed to upload file.";
        }
    } else {
        echo "Only JPG, PNG, JPEG, and GIF files are allowed.";
    }
}
?>
