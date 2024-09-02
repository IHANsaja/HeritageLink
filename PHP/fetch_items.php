<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "heritagelink"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Adjust the SQL query to select the columns that actually exist in your table
$sql = "SELECT product_name, price FROM Products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
        // Use placeholder image since 'image' column is missing
        $image = '../assets/sigiriya1.jpg';
        echo '<img src="' . $image . '" alt="' . htmlspecialchars($row["product_name"]) . '">';
        echo '<h3>' . htmlspecialchars($row["product_name"]) . '</h3>';
        echo '<p>USD ' . htmlspecialchars($row["price"]) . '</p>';
        echo '<button>Buy</button>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

$conn->close();
?>
