<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Link Marketplace</title>
    <link rel="stylesheet" href="../styles/marketstyles.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="../scripts/script.js"></script>
</head>
<body>
    <?php
    session_start(); // Start the session at the top of the PHP script

    // Database connection
    $con = new mysqli("localhost", "root", "", "heritagelink");

    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    }

    // Initialize search query and results
    $search_query = '';
    $results = [];

    // Handle the search form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_query'])) {
        $search_query = trim($_POST['search_query']);
        
        // Prepare and execute the SQL statement
        $stmt = $con->prepare("SELECT * FROM products WHERE product_name LIKE ?");
        $search_term = "%" . $search_query . "%";
        $stmt->bind_param("s", $search_term);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $results = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $results = []; // No results found
        }

        $stmt->close();
    }

    $con->close();
    ?>
    <header>
        <img src="../assets/logoLarge.jpeg" alt="logo" class="logo">
        <div class="nav-links">
            <a href="../index.php"><div class="home">HOME</div></a>
            <a href="museum.php"><div class="museum">MUSEUM</div></a>
            <a href="marketplace.php"><div class="market">MARKET</div></a>
            <a href="https://en.wikipedia.org/wiki/List_of_World_Heritage_Sites_in_Sri_Lanka" target="_blank"><div class="protect">PROTECT</div></a>
        </div>
        <div class="search-bar">
            <form method="POST" action="marketplace.php" class="search-form">
                <input type="text" name="search_query" placeholder="Search product..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i><p>search</p></button>
            </form>
        </div>
        <div class="user-profile">
            <?php
            if (isset($_SESSION['username']) || isset($_SESSION['seller_username'])) {
                if (isset($_SESSION['username'])) {
                    // Normal user is logged in
                    echo "<div class='welcome'>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</div>";
                }
                if (isset($_SESSION['seller_username'])) {
                    // Seller is logged in, make username clickable to go to the seller dashboard
                    echo "Welcome, <a class='welcome' href='seller-dashboard.php'>" . htmlspecialchars($_SESSION['seller_username']) . "</a>";
                }                
            } else {
                // No user is logged in
                echo '<div class="login"><div class="login-btn"><a href="login.php"><button>LOGIN</button></a></div>';
                echo '<div class="link-btn"><a href="signup.php"><button>LINK</button></a></div></div>';
            }
            ?>
            <div class="icon">
                <img src="../assets/seller-icon.png" alt="User">
            </div>
        </div>
    </header>
    <main>
        <section class="product-list">
            <?php if (!empty($search_query)): ?>
                <h2 class="searchhead">Search Results for "<?php echo htmlspecialchars($search_query); ?>"</h2>
                <div class="product-list-search">
                    <?php if (!empty($results)): ?>
                        <?php foreach ($results as $product): ?>
                            <div class="search-card">
                                <img src="../assets/sigiriya1.jpg" alt="<?php echo htmlspecialchars($product['product_name']); ?>">
                                <div class="search-info">
                                    <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                                    <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                                    <div class="buttons">
                                        <button>Buy</button>
                                        <button>Cart</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No products found.</p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <?php include 'fetch_items.php'; ?>
            <?php endif; ?>
        </section>
    </main>
    <script>
        function loadItems() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_items.php', true);
            xhr.onload = function() {
                if (this.status == 200) {
                    document.querySelector('.product-list').innerHTML = this.responseText;
                }
            }
            xhr.send();
        }
        document.addEventListener('DOMContentLoaded', function () {
        const loginButton = document.querySelector('.login-btn button');
        const linkButton = document.querySelector('.link-btn button');

        if (loginButton && linkButton) {
            loginButton.addEventListener('mouseenter', function () {
            loginButton.style.backgroundColor = '#AD6A6C';
            loginButton.style.borderColor = '#AD6A6C';
            loginButton.style.color = '#fff';
            linkButton.style.backgroundColor = '#5D2E46';
            linkButton.style.borderColor = '#AD6A6C';
            linkButton.style.color = '#E8D6CB';
        });

        loginButton.addEventListener('mouseleave', function () {
            loginButton.style.backgroundColor = '#5D2E46';
            loginButton.style.borderColor = '#AD6A6C';
            loginButton.style.color = '#E8D6CB';
            linkButton.style.backgroundColor = '#AD6A6C';
            linkButton.style.borderColor = '#AD6A6C';
            linkButton.style.color = '#E8D6CB';
        });

        linkButton.addEventListener('mouseenter', function () {
            loginButton.style.backgroundColor = '#AD6A6C';
            loginButton.style.borderColor = '#AD6A6C';
            loginButton.style.color = '#E8D6CB';
            linkButton.style.backgroundColor = '#5D2E46';
            linkButton.style.borderColor = '#AD6A6C';
            linkButton.style.color = '#fff';
        });

        linkButton.addEventListener('mouseleave', function () {
            loginButton.style.backgroundColor = '#5D2E46';
            loginButton.style.borderColor = '#AD6A6C';
            loginButton.style.color = '#E8D6CB';
            linkButton.style.backgroundColor = '#AD6A6C';
            linkButton.style.borderColor = '#AD6A6C';
            linkButton.style.color = '#E8D6CB';
        });
        }});
    
        
    </script>
    
</body>
</html>
