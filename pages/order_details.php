<?php
include_once '../includes/header.php';
include_once '../includes/db.php';



// Ensure the user is logged in
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit;
}

// Validate the order ID
$order_id = $_GET['order_id'] ?? null;
if (!$order_id) {
    echo "<p>Invalid order ID.</p>";
    exit;
}

// Check if the order belongs to the logged-in user
$stmt = $pdo->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
$stmt->execute([$order_id, $user_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo "<p>Order not found or access denied.</p>";
    exit;
}

// Fetch the order items
$stmt = $pdo->prepare("SELECT oi.product_id, p.name, oi.quantity, oi.price 
                       FROM order_items oi 
                       JOIN products p ON oi.product_id = p.id 
                       WHERE oi.order_id = ?");
$stmt->execute([$order_id]);
$order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .container {
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
</style>

<div class="container">
    <h1>Order Details</h1>
    <p><strong>Order ID:</strong> <?= htmlspecialchars($order['id']) ?></p>
    <p><strong>Total Amount:</strong> N<?= number_format($order['total_amount'], 2) ?></p>
    <p><strong>Payment Method:</strong> <?= ucfirst(htmlspecialchars($order['payment_method'])) ?></p>
    <p><strong>Order Date:</strong> <?= date('d-m-Y H:i', strtotime($order['created_at'])) ?></p>

    <h2>Items</h2>
    <?php if (count($order_items) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_items as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>N<?= number_format($item['price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No items found for this order.</p>
    <?php endif; ?>
</div>

<?php
include_once '../includes/footer.php';
?>
