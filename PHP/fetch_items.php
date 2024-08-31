<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "heritagelink"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
        echo '<img src="' . $row["image"] . '" alt="' . $row["name"] . '">';
        echo '<h3>' . $row["name"] . '</h3>';
        echo '<p>LKR ' . $row["price"] . '</p>';
        echo '<button>Buy</button>';
        echo '</div>';
    }
} else {
    echo "0 results";
}

$conn->close();
?>
