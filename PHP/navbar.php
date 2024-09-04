<?php
session_start(); // Start the session to access session variables

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "heritagelink";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die('<div class="db-offline" id="db-status" title="Database is offline"><i class="ri-checkbox-circle-fill"></i><p>Offline</p></div>');
}

if (isset($_SESSION['seller_id'])) {
    $seller_id = $_SESSION['seller_id'];
    
    // Prepare SQL statement
    $sql = "SELECT username FROM Sellers WHERE seller_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $seller_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $seller_username = "<a class='sellDB' href='seller-dashboard.php'>" . htmlspecialchars($row['username']) . "</a>";
            $logout_link = "<a href='PHP/logout.php' class='logout-btn'>Logout</a>";
        } else {
            $seller_username = "Guest"; // Default if no username found
            $logout_link = "";
        }
        $stmt->close();
    } else {
        // Print SQL error
        echo 'SQL Error: ' . htmlspecialchars(mysqli_error($conn));
        $seller_username = "Guest";
        $logout_link = "";
    }
} else {
    $seller_username = ""; // Leave blank if not logged in
    $logout_link = ""; // No logout link if not logged in
}
$conn->close();
?>

<!-- Output the username or Guest -->
<?php if ($seller_username): ?>
    <span><?php echo $seller_username; ?></span>
    <?php echo $logout_link; ?>
<?php else: ?>
    <div class="login">
        <div class="login-btn"><a href="PHP/login.php"><button>LOGIN</button></a></div>
        <div class="link-btn"><a href="PHP/signup.php"><button>LINK</button></a></div>
    </div>
<?php endif; ?>