<?php
// Include necessary files
include_once '../includes/header.php';
include_once '../includes/db.php';

// Fetch products from the database
$productStmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 6");
$products = $productStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch categories from the database
$categoryStmt = $pdo->query("SELECT DISTINCT category FROM products");
$categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1>Welcome to Ailszone</h1>
    <p>Shop the best products at unbeatable prices!</p>

    <!-- Category Links -->
    <div class="categories">
        <?php foreach ($categories as $category): ?>
            <a href="category.php?category=<?php echo urlencode($category['category']); ?>">
                <?php echo htmlspecialchars($category['category']); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Product Grid -->
    <div class="product-grid">
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="../uploads/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p>N<?php echo number_format($product['price'], 2); ?></p>
                <a href="product.php?id=<?php echo $product['id']; ?>">View Product</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Floating Cart Icon -->
<a href="../pages/cart.php" id="floating-cart" title="Go to Cart 🛒">
    🛒
</a>

<style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        text-align: center;
    }

    /* Page Title */
    h1 {
        font-size: 36px;
        margin-bottom: 10px;
        color: black;
    }

    /* Category Links */
    .categories {
        margin: 20px 0;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .categories a {
        text-decoration: none;
        color: #fff;
        background-color: black;
        padding: 10px 20px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .categories a:hover {
        background-color: indigo;
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    /* Product Card */
    .product-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

    /* Floating Cart Icon */
    #floating-cart {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: white;
        border-radius: 50%;
        padding: 20px;
        font-size: 24px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
        text-decoration: none; /* Remove underline */
    }

    #floating-cart:hover {
        background-color: #0056b3;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .product-card {
            margin-bottom: 20px;
        }

        .categories {
            flex-wrap: wrap;
        }
    }
</style>

<?php
include_once '../includes/footer.php';
?>
