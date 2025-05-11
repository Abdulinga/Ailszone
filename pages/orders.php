<?php
include_once '../includes/header.php';
include_once '../includes/db.php';



// Ensure the user is logged in
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit;
}

// Fetch orders for the logged-in user
$stmt = $pdo->prepare("SELECT id, total_amount, payment_method, created_at FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        color: #333;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #007bff;
        color: white;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
    .view-button {
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
    }
    .view-button:hover {
        background-color: #0056b3;
    }
</style>

<div class="container">
    <h1>Your Orders</h1>
    <?php if (count($orders) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['id']) ?></td>
                        <td>N<?= number_format($order['total_amount'], 2) ?></td>
                        <td><?= ucfirst(htmlspecialchars($order['payment_method'])) ?></td>
                        <td><?= date('d-m-Y H:i', strtotime($order['created_at'])) ?></td>
                        <td>
                            <a class="view-button" href="order_details.php?order_id=<?= $order['id'] ?>">View Items</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no orders yet. <a href="products.php">Start shopping!</a></p>
    <?php endif; ?>
</div>

<?php
include_once '../includes/footer.php';
?>
