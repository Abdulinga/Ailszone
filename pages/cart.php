<?php
include_once '../includes/header.php';

// Start session to access cart

// Fetch cart items from session
$cart_items = $_SESSION['cart'] ?? [];
?>


<div class="container">
    <h1>Your Cart</h1>
    <?php if ($cart_items): ?>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td><img src="../uploads/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>"></td>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>N<?php echo number_format($item['price'], 2); ?></td>
                        <td>N<?php echo number_format($item['quantity'] * $item['price'], 2); ?></td>
                        <td>
                            <form method="post" action="remove_cart_item.php">
                                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                <button type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="checkout.php">Proceed to Checkout</a>
    <?php else: ?>
        <p>Your cart is empty!</p>
    <?php endif; ?>
</div>

<?php
include_once '../includes/footer.php';
?>


<style>
.container {
    max-width: 1000px;
    margin: 20px auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

h1 {
    font-size: 2rem;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

table th {
    background-color: #f8f9fa;
    font-size: 1rem;
    font-weight: bold;
}

table td img {
    max-width: 100px;
    height: auto;
    border-radius: 5px;
}

button {
    padding: 5px 10px;
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 0.9rem;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #c82333;
}

a {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background-color: ;
    color: red;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

a:hover {
    background-color: ;
}
</style>