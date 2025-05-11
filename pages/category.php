<?php
include_once '../includes/header.php';
include_once '../includes/db.php';

// Validate and fetch the selected category from the URL
$category = isset($_GET['category']) ? htmlspecialchars($_GET['category']) : null;

if ($category) {
    // Fetch products from the selected category
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category = ?");
    $stmt->execute([$category]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If no category is selected, redirect back to the home page
    $products = [];
}
?>

<div class="container">
    <h1>Products in Category: <?php echo htmlspecialchars($category); ?></h1>

    <div class="product-grid">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p>N<?php echo number_format($product['price'], 2); ?></p>
                    <a href="product.php?id=<?php echo $product['id']; ?>">View Product</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No products found in this category.</p>
        <?php endif; ?>
    </div>
</div>

<?php
include_once '../includes/footer.php';
?>
<style>
    /* Category Title */
h1 {
    font-size: 36px;
    margin-bottom: 20px;
    color: black;
    text-align: center;
}

/* Product Grid */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-top: 20px;
    justify-content: center;
}

/* Product Card */
.product-card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
}

.product-card h3 {
    font-size: 18px;
    margin: 10px 0;
}

.product-card p {
    font-size: 16px;
    color: #28a745;
    font-weight: bold;
}

.product-card a {
    text-decoration: none;
    color: #fff;
    background-color: black;
    padding: 10px 15px;
    border-radius: 5px;
    display: inline-block;
    margin-top: 10px;
    transition: background-color 0.3s ease;
}

.product-card a:hover {
    background-color: indigo;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

</style>