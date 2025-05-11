<?php
include_once '../includes/header.php';
include_once '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$message = '';

// Handle profile picture upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic'])) {
    $image = $_FILES['profile_pic']['name'];
    $target = '../uploads/' . basename($image);

    if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target)) {
        $stmt = $pdo->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
        $stmt->execute([$image, $user_id]);
        $message = "Profile picture updated successfully!";
    } else {
        $message = "Failed to upload image. Please try again.";
    }
}

// Handle user details update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_details'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
    $stmt->execute([
        $username,
        $email,
        password_hash($password, PASSWORD_DEFAULT),
        $user_id
    ]);
    $message = "Account details updated successfully!";
}

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?></h1>
    <?php if ($message): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    <div class="profile">
        <div class="profile-section">
            <img src="../uploads/<?php echo htmlspecialchars($user['profile_pic'] ?? 'default.png'); ?>" alt="Profile Picture" class="profile-pic">
            <form method="post" enctype="multipart/form-data">
                <label for="profile_pic">Upload Profile Picture:</label>
                <input type="file" id="profile_pic" name="profile_pic" accept="image/*" required>
                <button type="submit">Upload</button>
            </form>
        </div>
        <div class="account-section">
            <h2>Update Account Details</h2>
            <form method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Enter a new password">

                <button type="submit" name="update_details">Update Details</button>
            </form>
        </div>
    </div>
</div>

<?php
include_once '../includes/footer.php';
?>
<style>
    body {
    font-family: 'Arial', sans-serif;
    background-color: #f5f5f5;
    color: #333;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 50px auto;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

h1 {
    text-align: center;
    font-size: 2rem;
    color: #2c3e50;
}

.message {
    color: green;
    text-align: center;
    font-size: 1rem;
    margin-bottom: 10px;
}

.profile {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.profile-section,
.account-section {
    flex: 1;
    min-width: 300px;
}

.profile-section {
    text-align: center;
}

.profile-pic {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    border: 3px solid #3498db;
    object-fit: cover;
    margin-bottom: 15px;
}

form {
    margin-top: 10px;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

label {
    font-weight: bold;
    color: #34495e;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="file"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1rem;
    width: 100%;
}

button {
    background-color: #3498db;
    color: #fff;
    padding: 10px 15px;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #2980b9;
}

h2 {
    color: #2c3e50;
    margin-bottom: 10px;
}

@media (max-width: 768px) {
    .profile {
        flex-direction: column;
        gap: 20px;
    }
}

</style>