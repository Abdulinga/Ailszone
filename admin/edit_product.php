<?php
include 'db.php';
include '../includes/header.php';

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch the product data
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    // Fetch all categories
    $categories = $conn->query("SELECT name FROM categories");
} else {
    echo "Invalid Product ID.";
    exit;
}

// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];
    $productCategory = $_POST['product_category'];

    // Handle image upload
    $fileName = $product['image']; // Default to the existing image
    if (!empty($_FILES["product_image"]["name"])) {
        $targetDir = "../uploads/";
        $fileName = basename($_FILES["product_image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($fileType), $allowedTypes)) {
            move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath);
        } else {
            echo "Invalid file type.";
            exit;
        }
    }

    // Update the product in the database
    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, category = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssdssi", $productName, $productDescription, $productPrice, $productCategory, $fileName, $productId);

    if ($stmt->execute()) {
        echo "Product updated successfully!";
        header("Location: manage_products.php");
        exit;
    } else {
        echo "Failed to update product.";
    }
}
?>

<div class="edit-product">
    <h1>Edit Product</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" value="<?php echo $product['name']; ?>" required>

        <label for="product_description">Product Description:</label>
        <textarea name="product_description" required><?php echo $product['description']; ?></textarea>

        <label for="product_price">Price:</label>
        <input type="number" name="product_price" step="0.01" value="<?php echo $product['price']; ?>" required>

        <label for="product_category">Category:</label>
        <select name="product_category" required>
            <?php while ($category = $categories->fetch_assoc()) { ?>
                <option value="<?php echo $category['name']; ?>" <?php echo ($category['name'] == $product['category']) ? 'selected' : ''; ?>>
                    <?php echo $category['name']; ?>
                </option>
            <?php } ?>
        </select>

        <label for="product_image">Upload Image:</label>
        <input type="file" name="product_image" accept="image/*">
        <p>Current Image: <img src="../uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="width: 50px;"></p>

        <button type="submit">Update Product</button>
    </form>
</div>
<style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333;
}

/* Form Styles */
form {
    width: 50%;
    margin: auto;
    padding: 20px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
    color: #333;
}

form input, form textarea, form select, form button {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

form button {
    background: #007BFF;
    color: white;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease;
}

form button:hover {
    background: #0056b3;
}

/* Table Styles */
.manage-products table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background: white;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.manage-products th, .manage-products td {
    padding: 10px 15px;
    text-align: center;
    border: 1px solid #ddd;
}

.manage-products th {
    background: #007BFF;
    color: white;
}

.manage-products td img {
    border-radius: 5px;
}

/* Links */
a {
    color: #007BFF;
    text-decoration: none;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

/* Page Specific Styles */
.add-product, .edit-product, .manage-products {
    padding: 20px;
}

</style>
<?php
include '../includes/footer.php';
?>
