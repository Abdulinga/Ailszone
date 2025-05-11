<?php
// add_product.php

include 'db.php';
include '../includes/header.php';

// Fetch categories from the database
$categories = [];
$stmt = $conn->prepare("SELECT id, name FROM categories");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['product_name'];
    $productDescription = $_POST['product_description'];
    $Quantity = $_POST['Quantity'];
    $productPrice = $_POST['product_price'];
    $productCategory = $_POST['product_category'];

    // Handle image upload
    $targetDir = "../uploads/";
    $fileName = basename($_FILES["product_image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array(strtolower($fileType), $allowedTypes)) {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFilePath)) {
            // Insert product into the database
            $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock, category, image) VALUES (?, ?, ?, ?, ? ,?)");
            $stmt->bind_param("ssdsss", $productName, $productDescription, $productPrice, $Quantity, $productCategory, $fileName);
            if ($stmt->execute()) {
                echo "<p class='success-message'>Product added successfully!</p>";
            } else {
                echo "<p class='error-message'>Failed to add product.</p>";
            }
        } else {
            echo "<p class='error-message'>Failed to upload image.</p>";
        }
    } else {
        echo "<p class='error-message'>Invalid file type.</p>";
    }
}
?>

<div class="add-product">
    <h1>Add Product</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="product_name">Product Name:</label>
        <input type="text" name="product_name" required>

        <label for="product_description">Product Description:</label>
        <textarea name="product_description" required></textarea>

        <label for="Quantity">Quantity:</label>
        <input type="number" name="Quantity" step="1" required>

        <label for="product_price">Price:</label>
        <input type="number" name="product_price" step="0.01" required>

        <label for="product_category">Category:</label>
        <select name="product_category" required>
            <option value="" disabled selected>Select a category</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="product_image">Upload Image:</label>
        <input type="file" name="product_image" accept="image/*" required>

        <button type="submit">Add Product</button>
    </form>
</div>
<style>
    .add-product {
    width: 50%;
    margin: auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    font-family: Arial, sans-serif;
}

.add-product h1 {
    text-align: center;
    color: #333;
}

.add-product label {
    display: block;
    margin: 15px 0 5px;
    font-weight: bold;
    color: #555;
}

.add-product input,
.add-product textarea,
.add-product select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.add-product button {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    background-color: #007BFF;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

.add-product button:hover {
    background-color: #0056b3;
}

.success-message {
    color: #28a745;
    font-weight: bold;
    text-align: center;
}

.error-message {
    color: #dc3545;
    font-weight: bold;
    text-align: center;
}

</style>
<?php
include '../includes/footer.php';
?>
