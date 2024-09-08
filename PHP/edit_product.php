<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HeritageLink";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    
    $sql = "UPDATE Products SET product_name=?, description=?, price=?, stock=? WHERE product_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdii", $product_name, $description, $price, $stock, $product_id);

    if ($stmt->execute()) {
        header("Location: seller-dashboard.php"); 
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch product details for editing
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    $sql = "SELECT * FROM Products WHERE product_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="../styles/styles-sellerDB.css">
</head>
<body>
    <div class="edit-product-form-container">
        <h2>Edit Product</h2>
        <form method="POST" action="" class="edit-product-form">
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
            <label for="description">Description</label>
            <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            <label for="stock">Stock</label>
            <input type="number" id="stock" name="stock" value="<?php echo htmlspecialchars($product['stock']); ?>" required>
            <button type="submit" name="update_product">Update Product</button>
        </form>
    </div>
</body>
</html>
