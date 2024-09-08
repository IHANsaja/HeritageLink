<?php
require 'config.php'; // Ensure this includes the correct database connection

// Check if product_id is set
if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']); // Sanitize input

    // Prepare SQL statement to delete the product
    $stmt = $conn->prepare("DELETE FROM Products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        // Success
        echo "<script>
            alert('Product deleted successfully!');
            window.location.href='../PHP/seller-dashboard.php';
        </script>";
    } else {
        // Error
        echo "<script>
            alert('Error deleting record: " . $conn->error . "');
            window.location.href='../PHP/seller-dashboard.php';
        </script>";
    }

    $stmt->close();
} else {
    // No product ID provided
    echo "<script>
        alert('No product ID provided.');
        window.location.href='../PHP/seller-dashboard.php';
    </script>";
}

$conn->close();
?>
