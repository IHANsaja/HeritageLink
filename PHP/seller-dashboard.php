<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Link Seller Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <link rel="stylesheet" href="../styles/styles-sellerDB.css">
    <script>
        function showMessage(message) {
            const messageDiv = document.getElementById('message');
            messageDiv.textContent = message;
            messageDiv.style.display = 'block';
        }
    </script>
</head>
<body>

    <!-- Header / Top Bar -->
    <div class="top-bar">
        <h2>HeritageLink <span>Seller</span></h2>
        <div class="username">
            <span>MAHINDA</span>
            <div class="seller-icon">
                <img src="../assets/seller-icon.png" alt="User Icon" style="margin-left: 10px; vertical-align: middle;">
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu">
            <a href="#" class="menu-link" onclick="showSection('dashboard')">
                <div class="item1">
                    <i class="ri-dashboard-horizontal-fill"></i>
                    <span class="menu-item">Dashboard</span>
                    <i class="ri-arrow-right-s-fill"></i>
                </div>
            </a>
            <a href="#" class="menu-link" onclick="showSection('products')">
                <div class="item2">
                    <i class="ri-box-1-fill"></i>
                    <span class="menu-item">Products</span>
                    <i class="ri-arrow-right-s-fill"></i>
                </div>
            </a>
            <a href="#" class="menu-link" onclick="showSection('analytics')">
                <div class="item3">
                    <i class="ri-pie-chart-fill"></i>
                    <span class="menu-item">Analytics</span>
                    <i class="ri-arrow-right-s-fill"></i>
                </div>
            </a>
        </div>
        <a href="#" class="settings-link">
            <div class="settings">
                <i class="ri-settings-fill"></i>
                <p class="menu-item">Settings</p>
            </div>
        </a>
    </div>

    <!-- Content Area -->
    <div class="content" id="dashboard">
        <div class="card large"></div>
        <div class="vert">
            <div class="card small1"></div>
            <div class="card small2"></div>
            <div class="card small3"></div>
        </div>
    </div>

    <!-- Products Section -->
    <div id="products" class="products-tab">
        <h3>Manage Products</h3>
        
        <!-- Add Product Form -->
        <div class="add-product" id="add">
            <h3>Add New Product</h3>
            <form id="add-product-form">
                <!-- Your form fields here -->
                <input type="text" name="seller_id" placeholder="Seller ID" required>
                <input type="text" name="product_name" placeholder="Product Name" required>
                <textarea name="description" placeholder="Description"></textarea>
                <input type="number" name="price" placeholder="Price" required>
                <input type="number" name="stock" placeholder="Stock" required>
                <button type="submit">Add Product</button>
            </form>
        </div>
        <div id="message" style="font-weight: 600;color: rgb(43, 255, 43); transition: 1s ease-in-out;"></div>

        <!-- List of Products -->
        <div id="product-list">
            <?php
            require 'config.php'; // Ensure this includes the correct database connection

            $seller_id = 1; // Replace with the actual seller ID if needed

            // Debug: Print the seller_id and SQL query
            echo "<p>Seller ID: $seller_id</p>";

            // Prepare SQL statement
            $query = "SELECT * FROM Products WHERE seller_id = ?";
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("i", $seller_id); // Bind parameters
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                        <div class='product-item'>
                            <h4>{$row['product_name']}</h4>
                            <p>{$row['description']}</p>
                            <p>Price: {$row['price']}</p>
                            <p>Stock: {$row['stock']}</p>
                            <form method='POST' action='../PHP/delete_product.php'>
                                <input type='hidden' name='product_id' value='{$row['product_id']}'>
                                <button type='submit'>Delete</button>
                            </form>
                            <form method='GET' action='../PHP/edit_product.php'>
                                <input type='hidden' name='product_id' value='{$row['product_id']}'>
                                <button type='submit'>Edit</button>
                            </form>
                        </div>";
                    }
                } else {
                    echo "<p>No products found.</p>";
                }

                $stmt->close();
            } else {
                echo "<p>Error preparing the SQL statement: " . $conn->error . "</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>


    <!-- Analytics Section (Hidden by default) -->
    <div class="content" id="analytics" style="display: none;">
        <h2>Analytics</h2>
        <!-- Analytics content here -->
    </div>

    <script src="../scripts/script-sellerDB.js"></script>

</body>
</html>
