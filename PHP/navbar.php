<?php
session_start(); // Start the session

// Mock user login check. Replace this with your actual authentication logic
if (isset($_SESSION['user_id'])) {
    // Assume you have a function to fetch the username based on user_id
    $user_id = $_SESSION['user_id'];
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "heritagelink"; 

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT username FROM sellers WHERE seller_id = $user_id"; // Modify this query if needed
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = htmlspecialchars($row['username']);
        echo '<div class="user-profile">';
        echo '<div class="username"><a href="PHP/sellerdashboard.php?seller_id=' . $user_id . '">' . $username . '</a></div>';
        echo '</div>';
    } else {
        echo '<div class="login-btn"><a href="PHP/login.php"><button>LOGIN</button></a></div>';
        echo '<div class="link-btn"><a href="PHP/signup.php"><button>LINK</button></a></div>';
    }

    $conn->close();
} else {
    echo '<div class="login-btn"><a href="PHP/login.php"><button>LOGIN</button></a></div>';
    echo '<div class="link-btn"><a href="PHP/signup.php"><button>LINK</button></a></div>';
}
?>
