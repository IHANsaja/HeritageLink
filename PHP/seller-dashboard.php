<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Link Seller Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <link rel="stylesheet" href="../styles/styles-sellerDB.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
    <script>
        function showMessage(message) {
            const messageDiv = document.getElementById('message');
            messageDiv.textContent = message;
            messageDiv.style.display = 'block';
        }

        function showSection(sectionId) {
            document.querySelectorAll('.content').forEach((section) => {
                section.style.display = 'none';
            });
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>
</head>
<body>
    <!-- Header / Top Bar -->
    <?php
    include 'config.php';
    session_start(); 

    if (isset($_SESSION['seller_id'])) {
        $seller_id = $_SESSION['seller_id'];
        $sql = "SELECT username FROM Sellers WHERE seller_id = '$seller_id'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $seller_username = htmlspecialchars($row['username']);
        } else {
            $seller_username = "Guest";
        }

        // Fetch monthly revenue
        $revenue_query = $conn->prepare("
        SELECT IFNULL(SUM(oi.price * oi.quantity), 0) AS monthly_revenue 
        FROM Orders o 
        JOIN Order_Items oi ON o.order_id = oi.order_id 
        JOIN Products p ON oi.product_id = p.product_id
        WHERE p.seller_id = ? 
        AND o.status = 'completed'
        AND DATE_FORMAT(o.created_at, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')
        ");
        $revenue_query->bind_param("i", $seller_id);
        $revenue_query->execute();
        $revenue_result = $revenue_query->get_result();
        $revenue_data = $revenue_result->fetch_assoc();
        $monthly_revenue = $revenue_data['monthly_revenue'] ? $revenue_data['monthly_revenue'] : 0;

        // Fetch annual revenue
        $annual_revenue_query = $conn->prepare("
        SELECT IFNULL(SUM(oi.price * oi.quantity), 0) AS annual_revenue
        FROM Orders o 
        JOIN Order_Items oi ON o.order_id = oi.order_id 
        JOIN Products p ON oi.product_id = p.product_id
        WHERE p.seller_id = ? 
        AND o.status = 'completed'
        AND YEAR(o.created_at) = YEAR(CURDATE())
        ");
        $annual_revenue_query->bind_param("i", $seller_id);
        $annual_revenue_query->execute();
        $annual_revenue_result = $annual_revenue_query->get_result();
        $annual_revenue_data = $annual_revenue_result->fetch_assoc();
        $annual_revenue = $annual_revenue_data['annual_revenue'] ? $annual_revenue_data['annual_revenue'] : 0;


        // Fetch sales analysis
        $analysis_query = $conn->prepare("
            SELECT COUNT(DISTINCT o.order_id) AS total_sales, AVG(oi.price * oi.quantity) AS avg_order_value 
            FROM Orders o 
            JOIN Order_Items oi ON o.order_id = oi.order_id 
            JOIN Products p ON oi.product_id = p.product_id
            WHERE p.seller_id = ? 
            AND MONTH(o.created_at) = MONTH(CURDATE()) 
            AND YEAR(o.created_at) = YEAR(CURDATE())
        ");
        $analysis_query->bind_param("i", $seller_id);
        $analysis_query->execute();
        $analysis_result = $analysis_query->get_result();
        $analysis_data = $analysis_result->fetch_assoc();
        $total_sales = $analysis_data['total_sales'] ? $analysis_data['total_sales'] : 0;
        $avg_order_value = $analysis_data['avg_order_value'] ? $analysis_data['avg_order_value'] : 0;

        // Close connections
        $revenue_query->close();
        $annual_revenue_query->close();
        $analysis_query->close();
        $conn->close();
    } else {
        $seller_username = "Guest"; 
    }
    ?>


    <div class="top-bar">
        <h2>HeritageLink <span>Seller</span></h2>
        <div class="username">
            <span>Welcome, <?php echo $seller_username; ?>!</span>
            <div class="seller-icon">
                <img src="../assets/seller-icon.png" alt="User Icon" style="margin-left: 10px; vertical-align: middle;">
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu">
            <a href="#" class="menu-link" data-tab="dashboard">
                <div class="item1">
                    <i class="ri-dashboard-horizontal-fill"></i>
                    <span class="menu-item">Dashboard</span>
                    <i class="ri-arrow-right-s-fill"></i>
                </div>
            </a>
            <a href="#" class="menu-link" data-tab="products">
                <div class="item2">
                    <i class="ri-box-1-fill"></i>
                    <span class="menu-item">Products</span>
                    <i class="ri-arrow-right-s-fill"></i>
                </div>
            </a>
            <a href="../index.php">
                <div class="item3">
                    <i class="ri-home-office-fill"></i>
                    <span class="menu-item">Home</span>
                    <i class="ri-arrow-right-s-fill"></i>
                </div>
            </a>
            <a href="museum.php">
                <div class="item4">
                    <i class="ri-ancient-gate-fill"></i>
                    <span class="menu-item">Museum</span>
                    <i class="ri-arrow-right-s-fill"></i>
                </div>
            </a>
            <a href="marketplace.php">
                <div class="item5">
                    <i class="ri-store-fill"></i>
                    <span class="menu-item">Marketplace</span>
                    <i class="ri-arrow-right-s-fill"></i>
                </div>
            </a>
            <p class="sellerid">
                <?php echo 'Your Seller ID: '. $seller_id?>
            </p>
        </div>
        <a href="../html/settings.html" class="settings-link">
            <div class="settings">
                <i class="ri-settings-fill"></i>
                <p class="menu-item">Settings</p>
            </div>
        </a>
    </div>

    <!-- Content Area -->
    <div class="content" id="dashboard">
        <div class="card large">
            <h3>Monthly Revenue</h3>
            <p>$<?php echo number_format($monthly_revenue, 2); ?></p>
        </div>
        <div class="card large">
            <h3>Annual Revenue</h3>
            <p>$<?php echo number_format($annual_revenue, 2); ?></p>
        </div>
        <div class="vert">
            <div class="card small1">
                <h3>Total Sales</h3>
                <p><?php echo $total_sales; ?></p>
            </div>
            <div class="card small2">
                <h3>Average Order Value</h3>
                <p>$<?php echo number_format($avg_order_value, 2); ?></p>
            </div>
            <div class="card small3">
                <h3>Sales Analysis</h3>
                <p>Analyze your sales performance and trends here.</p>
            </div>
        </div>
    </div>


    <!-- Products Section -->
    <div id="products" class="products-tab" style="display: none;">
        <h3 class="man">Manage Products</h3>
        
        <!-- Add Product Form -->
        <div class="add-product" id="add">
            <h3>Add New Product</h3>
            <form id="add-product-form" method="POST" action="../PHP/add_product.php" enctype="multipart/form-data">
                <input type="text" name="seller_id" placeholder="Your Seller ID" required>
                <input type="text" name="product_name" placeholder="Product Name" required>
                <textarea name="description" placeholder="Description"></textarea>
                <input type="number" name="price" placeholder="Price" required>
                <input type="number" name="stock" placeholder="Stock" required>
                <input type="file" name="product_image" accept="image/*" required>
                <button type="submit" id="submit-btn">Add Product</button>
            </form>
        </div>
        <div id="message" style="font-weight: 600; color: rgb(43, 255, 43); transition: 1s ease-in-out;"></div>

        <!-- List of Products -->
        <div id="product-list">
            <?php
            require 'config.php'; 

            $seller_id = $_SESSION['seller_id']; 

            $query = "SELECT * FROM Products WHERE seller_id = ?";
            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("i", $seller_id); 
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
                                <button type='submit' class='delete-button'>Delete</button>
                            </form>
                            <form method='GET' action='edit_product.php'>
                                <input type='hidden' name='product_id' value='{$row['product_id']}'>
                                <button type='submit' class='edit-button'>Edit</button>
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


    <script src="../scripts/script-sellerDB.js"></script>
</body>
</html>
