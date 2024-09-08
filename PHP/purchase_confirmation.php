<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heritagelink";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle stock quantity update
if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    $update_stock_query = "UPDATE Products SET stock = stock - 1 WHERE product_id = $product_id";
    if ($conn->query($update_stock_query) === TRUE) {
        echo "";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid product ID.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Confirmation</title>
    <link rel="stylesheet" href="../styles/confirmation.css">
</head>
<body>
    <div class="confirmation-container">
        <h1>Purchase Successful!</h1>
        <p>Thank you for your purchase. Your order has been confirmed.</p>
        <a href="marketplace.php" class="done-button">Done</a>
    </div>
</body>
</html>
