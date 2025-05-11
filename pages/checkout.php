<?php
include_once '../includes/header.php';
include_once '../includes/db.php';

// Ensure the user is logged in
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    header("Location: login.php");
    exit;
}

// Retrieve cart items from session
$cart_items = [];
if (isset($_SESSION['cart'])) {
    // Get product details from the database
    $product_ids = array_keys($_SESSION['cart']);
    if (!empty($product_ids)) {
        $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
        $stmt = $pdo->prepare("
            SELECT id, name, price FROM products WHERE id IN ($placeholders)
        ");
        $stmt->execute($product_ids);
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Map products to session data
        foreach ($products as $product) {
            $product_id = $product['id'];
            $cart_items[] = [
                'product_id' => $product_id,
                'quantity' => $_SESSION['cart'][$product_id]['quantity'],
                'name' => $product['name'],
                'price' => $product['price'],
                'total_price' => $_SESSION['cart'][$product_id]['quantity'] * $product['price']
            ];
        }
    }
}

// Calculate total cart value
$total_price = array_sum(array_column($cart_items, 'total_price'));

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $password = $_POST['password'];
    $payment_method = $_POST['payment_method'];

    // Verify user's password
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $stored_password = $stmt->fetchColumn();

    if (!password_verify($password, $stored_password)) {
        echo "<script>alert('Incorrect password. Please try again.');</script>";
    } else {
        // Process the order
        $pdo->beginTransaction();
        try {
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_amount, payment_method) 
                                   VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $total_price, $payment_method]);

            $order_id = $pdo->lastInsertId();

            foreach ($cart_items as $item) {
                $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) 
                                       VALUES (?, ?, ?, ?)");
                $stmt->execute([$order_id, $item['product_id'], $item['quantity'], $item['price']]);
            }

            // Clear the cart
            unset($_SESSION['cart']);

            $pdo->commit();
            echo "<script>alert('Order placed successfully!'); window.location.href = 'orders.php';</script>";
        } catch (Exception $e) {
            $pdo->rollBack();
            echo "<script>alert('Failed to place the order. Please try again.');</script>";
        }
    }
}
?>

<div class="container">
    <h1>Checkout</h1>
    <div>
        <h3>Your Cart:</h3>
        <?php if (!empty($cart_items)): ?>
            <table border="1" style="width: 100%; text-align: left; border-collapse: collapse; margin-bottom: 20px;">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td>N<?= number_format($item['price'], 2) ?></td>
                            <td>N<?= number_format($item['total_price'], 2) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total:</strong></td>
                        <td><strong>N<?= number_format($total_price, 2) ?></strong></td>
                    </tr>
                </tfoot>
            </table>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <form id="checkout-form" method="post">
        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="bank">Bank</option>
            <option value="paypal">PayPal</option>
        </select>
        <button type="button" id="place-order">Place Order</button>
    </form>
</div>

<div id="password-modal" class="modal">
    <div class="modal-content">
        <h2>Enter Password</h2>
        <form id="password-form" method="post">
            <input type="hidden" name="payment_method" id="hidden-payment-method">
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit">Confirm Order</button>
            <button type="button" id="close-modal" style="background-color: #dc3545;">Cancel</button>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('password-modal');
    const placeOrderButton = document.getElementById('place-order');
    const closeModalButton = document.getElementById('close-modal');
    const paymentMethodSelect = document.getElementById('payment_method');
    const hiddenPaymentMethod = document.getElementById('hidden-payment-method');

    placeOrderButton.addEventListener('click', () => {
        hiddenPaymentMethod.value = paymentMethodSelect.value;
        modal.style.display = 'flex';
    });

    closeModalButton.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>

<?php
include_once '../includes/footer.php';
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
        max-width: 600px;
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
    label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }
    select, button {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
        font-size: 16px;
    }
    button {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }
    .modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        text-align: center;
        width: 400px;
    }
    .modal-content input {
        width: 90%;
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    .modal-content button {
        width: 100%;
    }
</style>
