<?php
include_once '../includes/header.php';
include_once '../includes/db.php';

// Start session to store cart items


// Get product ID from URL
$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "<p>Product not found!</p>";
        include_once '../includes/footer.php';
        exit;
    }
} else {
    header("Location: home.php");
    exit;
}

// Handle adding to the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Initialize the cart in session if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product already exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // Update the quantity
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Add new product to the cart
        $_SESSION['cart'][$product_id] = [
            'id' => $product_id,
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'quantity' => $quantity,
        ];
    }

    
}
?>


<div class="container">
    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
    <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
    <p><?php echo htmlspecialchars($product['description']); ?></p>
    <p>Price: N<?php echo number_format($product['price'], 2); ?></p>
    <form method="post">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1">
        <button type="submit">Add to Cart</button>
    </form>
</div>

<?php
include_once '../includes/footer.php';
?>


<style>
.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

h1 {
    font-size: 2rem;
    margin-bottom: 20px;
}

img {
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
    border-radius: 10px;
}

p {
    font-size: 1rem;
    margin-bottom: 15px;
}

form {
    margin-top: 20px;
}

label {
    font-size: 1rem;
    margin-right: 10px;
}

input[type="number"] {
    width: 60px;
    padding: 5px;
    font-size: 1rem;
    margin-right: 10px;
}

button {
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #218838;
}
</style>