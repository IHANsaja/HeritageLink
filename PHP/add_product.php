<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "heritagelink"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die('Database not connected!');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $seller_id = $_POST['seller_id'];
    $product_name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Check if the seller_id exists in the Sellers table
    $check_query = "SELECT * FROM Sellers WHERE seller_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("i", $seller_id);
    $stmt->execute();
    $check_result = $stmt->get_result();

    if ($check_result->num_rows > 0) {
        // Check if the product already exists
        $product_check_query = "SELECT * FROM Products WHERE seller_id = ? AND product_name = ?";
        $stmt = $conn->prepare($product_check_query);
        $stmt->bind_param("is", $seller_id, $product_name);
        $stmt->execute();
        $product_check_result = $stmt->get_result();

        if ($product_check_result->num_rows == 0) {
            // Insert product into the database
            $query = "INSERT INTO Products (seller_id, product_name, description, price, stock) 
                      VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("issdi", $seller_id, $product_name, $description, $price, $stock);

            if ($stmt->execute()) {
                echo "Product added successfully!";
            } else {
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "Error: Product already exists.";
        }
    } else {
        echo "Error: Seller ID does not exist.";
    }

    $stmt->close();
    $conn->close();
}
?>
