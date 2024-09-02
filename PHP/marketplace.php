<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Link Marketplace</title>
    <link rel="stylesheet" href="../styles/marketstyles.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <header>
        <img src="../assets/logoLarge.jpeg" alt="logo" class="logo">
        <div class="nav-links">
            <a href="../index.html"><div class="home">HOME</div></a>
            <a href="../museum.html"><div class="museum">MUSEUM</div></a>
            <a href="marketplace.php"><div class="market">MARKET</div></a>
            <a href="https://en.wikipedia.org/wiki/List_of_World_Heritage_Sites_in_Sri_Lanka" target="_blank"><div class="protect">PROTECT</div></a>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search product...">
            <button><i class="fa-solid fa-magnifying-glass"></i><p>search</p></button>
        </div>
        <div class="user-profile">
            <?php
            $servername = "localhost";
            $username = "root"; 
            $password = ""; 
            $dbname = "heritagelink"; 
            
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            if (!$conn) {
                die('<div class="db-offline" id="db-status" title="Database is offline"><i class="ri-checkbox-circle-fill"></i><p>Offline</p></div>');
            }
            session_start(); // Start the session to access session variables

            if (isset($_SESSION['seller_id'])) {
                $seller_id = $_SESSION['seller_id'];

                // Query to get the seller's username
                $sql = "SELECT username FROM Sellers WHERE seller_id = '$seller_id'";
                $result = mysqli_query($conn, $sql);

                // Fetch the result and display the username
                if ($row = mysqli_fetch_assoc($result)) {
                    $seller_username = "<a class='sellDB' href='seller-dashboard.php'>" . htmlspecialchars($row['username']) . "</a>";
                } else {
                    $seller_username = "Guest"; // Default if no username found
                }
            } else {
                $seller_username = "Guest"; // If 'seller_id' is not set, show as Guest
            }
            ?>
            <span><?php echo $seller_username; ?></span>
            <div class="icon">
                <img src="../assets/seller-icon.png" alt="User">
            </div>
        </div>
    </header>
    <main>
        <section class="product-list">
            <?php include 'fetch_items.php'; ?>
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

        setInterval(loadItems, 10000); 
    </script>
</body>
</html>
