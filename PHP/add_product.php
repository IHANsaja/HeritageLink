<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $seller_id = 1; // replace with dynamic seller ID

    $query = "INSERT INTO Products (seller_id, product_name, description, price, stock) VALUES ($seller_id, '$product_name', '$description', $price, $stock)";
    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php"); // Redirect back to the dashboard
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
