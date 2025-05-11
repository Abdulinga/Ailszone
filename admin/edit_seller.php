<?php
include('db.php');

// Validate and get seller ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid seller ID.";
    exit;
}

$id = intval($_GET['id']);

// Fetch seller details
$stmt = $conn->prepare("SELECT * FROM sellers WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Seller not found.";
    exit;
}

$seller = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Seller</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h2>Edit Seller</h2>
    <form action="process-seller-edit.php" method="POST">
        <input type="hidden" name="seller_id" value="<?php echo $seller['id']; ?>">

        <label for="seller_name">Name:</label>
        <input type="text" id="seller_name" name="seller_name" value="<?php echo htmlspecialchars($seller['name']); ?>" required>

        <label for="seller_email">Email:</label>
        <input type="email" id="seller_email" name="seller_email" value="<?php echo htmlspecialchars($seller['email']); ?>" required>

        <label for="seller_phone">Phone:</label>
        <input type="text" id="seller_phone" name="seller_phone" value="<?php echo htmlspecialchars($seller['phone']); ?>" required>

        <label for="seller_password">New Password (leave blank to keep old one):</label>
        <input type="password" id="seller_password" name="seller_password">

        <button type="submit">Update Seller</button>
    </form>
</body>
</html>
