<?php
// manage_products.php

include 'db.php';
include '../includes/header.php';



// Handle delete product request
if (isset($_GET['delete'])) {
    $productId = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id = $productId");
    echo "Product deleted successfully!";
}

// Fetch all products
$result = $conn->query("SELECT * FROM products");
?>
<div class="manage-products">
    <h1>Manage Products</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><img src="../uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width: 50px;"></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
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
