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

    // Image Upload Handling
    $target_dir = "../uploads/"; // Ensure the uploads folder exists and is writable
    $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a valid image type
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);
    if ($check === false) {
        die("File is not an image.");
    }

    // Check file size (optional, example: limit to 2MB)
    if ($_FILES["product_image"]["size"] > 2000000) {
        die("Sorry, your file is too large.");
    }

    // Allow certain file formats
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Sorry, only JPG, JPEG, PNG, and GIF files are allowed.");
    }

    // Attempt to move the uploaded file to the target directory
    if (!move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
        die("Sorry, there was an error uploading your file.");
    }

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
            $query = "INSERT INTO Products (seller_id, product_name, description, price, stock, image_path) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("issdis", $seller_id, $product_name, $description, $price, $stock, $target_file);

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
