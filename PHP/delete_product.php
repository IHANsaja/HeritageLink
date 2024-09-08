<?php
require 'config.php'; 

// Check if product_id is set
if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']); // Sanitize input

    $stmt = $conn->prepare("DELETE FROM Products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        
        echo "<script>
            alert('Product deleted successfully!');
            window.location.href='../PHP/seller-dashboard.php';
        </script>";
    } else {
        
        echo "<script>
            alert('Error deleting record: " . $conn->error . "');
            window.location.href='../PHP/seller-dashboard.php';
        </script>";
    }

    $stmt->close();
} else {
    
    echo "<script>
        alert('No product ID provided.');
        window.location.href='../PHP/seller-dashboard.php';
    </script>";
}

$conn->close();
?>
