<?php
require 'config.php'; // Include the database configuration file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the product ID from the form submission
    $product_id = $_POST['product_id'];

    // Construct the SQL query to delete the product
    $query = "DELETE FROM Products WHERE product_id = $product_id";

    // Execute the SQL query
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product deleted successfully!');</script>";
        echo "<script>window.location.href = 'dashboard.php';</script>"; // Redirect back to the dashboard
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

