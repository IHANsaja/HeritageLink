<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $query = "DELETE FROM Products WHERE product_id = $product_id";
    
    if (mysqli_query($conn, $query)) {
        header("Location: dashboard.php"); // Redirect back to the dashboard
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>
