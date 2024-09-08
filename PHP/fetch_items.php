<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heritagelink";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Assuming you have the customer ID stored in the session
$customer_id = isset($_SESSION['customer_id']) ;

// Fetch products from database
$sql = "SELECT product_id, product_name, price, image_path FROM Products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
        $image = !empty($row["image_path"]) ? $row["image_path"] : '../assets/sigiriya1.jpg';
        echo '<img src="' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($row["product_name"]) . '">';
        echo '<h3>' . htmlspecialchars($row["product_name"]) . '</h3>';
        echo '<p>USD ' . htmlspecialchars($row["price"]) . '</p>';
        echo '<form method="POST" action="purchase_confirmation.php" class="buy-form">';
        echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($row['product_id']) . '">';
        echo '<input type="hidden" name="quantity" value="1">';
        echo '<input type="hidden" name="status" value="completed">';
        echo '<input type="hidden" name="customer_id" value="' . htmlspecialchars($customer_id) . '">';
        echo '<button type="submit" class="buy-button">Buy</button>';
        echo '</form>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

$conn->close();
?>
