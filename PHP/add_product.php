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
    $check_query = "SELECT * FROM Sellers WHERE seller_id = '$seller_id'";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Insert product into the database
        $query = "INSERT INTO Products (seller_id, product_name, description, price, stock) 
                  VALUES ('$seller_id', '$product_name', '$description', '$price', '$stock')";

        if (mysqli_query($conn, $query)) {
            echo "Product added successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Seller ID does not exist.";
    }
}
?>
