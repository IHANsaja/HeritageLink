<?php
// Database configuration
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "heritagelink";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$reg_error = "";
$reg_success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $role = $_POST['role'];
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];
    $contact_number = $_POST['contact_number'];
    $business_name = $role === 'seller' ? $_POST['business_name'] : '';

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $reg_error = "Please enter a valid email!";
    }
    // Validate contact number length
    elseif (strlen($contact_number) < 10) {
        $reg_error = "Please enter a valid Phone Number!";
    }
    // Validate passwords
    elseif ($pass !== $confirm_pass) {
        $reg_error = "Passwords do not match!";
    } else {
        // Check if username is taken
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $reg_error = "Username is already taken!";
        } else {
            // Hash password
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Insert into users table
            $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, first_name, last_name, contact_number, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $user, $email, $hashed_password, $role, $_POST['first_name'], $_POST['last_name'], $contact_number, $_POST['address']);

            // Execute and check if the statement was successful
            if ($stmt->execute()) {
                // Get the inserted user ID
                $user_id = $stmt->insert_id;

                // If role is seller, insert into sellers table
                if ($role === 'seller') {
                    $stmt = $conn->prepare("INSERT INTO sellers (user_id, business_name) VALUES (?, ?)");
                    $stmt->bind_param("is", $user_id, $business_name);
                    $stmt->execute();
                }

                $reg_success = "Registration successful! You can now log in.";
            } else {
                $reg_error = "Error: " . $stmt->error;
            }
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Link Registration</title>
    <link rel="stylesheet" href="../styles/signupstyles.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
</head>
<body>
<div class="container">
    <div class="left-side">
        <div class="role-selection">
            <button class="role-button active" onclick="selectRole('seller')">SELLER</button>
            <button class="role-button" onclick="selectRole('user')">USER</button>
        </div>
        <h1 class="logo">Heritage Link</h1>
        <h2 class="sub-heading">Register</h2>
        <?php if ($reg_error): ?>
            <p class="error"><?php echo $reg_error; ?></p>
        <?php endif; ?>
        <?php if ($reg_success): ?>
            <p class="success"><?php echo $reg_success; ?></p>
        <?php endif; ?>
        <!--form-->
        <form id="regForm" action="login.php" method="POST">
            <!-- Role Selection -->
            <input type="hidden" id="role" name="role" value="seller">
            <!-- Tab 1 -->
            <div class="tab">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            <!-- Tab 2 -->
            <div class="tab">
            <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number" required>
                </div>
            </div>
            <!--Tab 3-->
            <div class="tab">
            <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" required>
                </div>
            </div>
            <!-- Tab 4 -->
            <div class="tab">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group seller-only">
                    <label for="business_name">Business Name</label>
                    <input type="text" id="business_name" name="business_name">
                </div>
            </div>
            <!-- Navigation and Submit Buttons -->
            <div class="pagination-dots">
                <span class="dot" onclick="currentTab(0)"></span>
                <span class="dot" onclick="currentTab(1)"></span>
                <span class="dot" onclick="currentTab(2)"></span>                
                <span class="dot" onclick="currentTab(3)"></span>
            </div>
            <div class="navigation-buttons">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </form>
        <div class="social-login">
            <button class="social-btn google" onclick="redirectToGoogle()">
                    <img src="../assets/google.png" alt="Google">
            </button>
            <button class="social-btn facebook" onclick="window.location.href='https://web.facebook.com/login/'">
                <img src="../assets/facebook.png" alt="Facebook">
            </button>
        </div>
        <p class="login-para">If you already have an account, <a href="login.php">please login here.</a> 
        <button onclick="window.location.href='login.php'" class="login-btn">Login</button><!--Redirect to login page-->
        </p>
    </div>
    <div class="right-side">
        <img src="../assets/sigiriya1.jpg" alt="Sigiriya" class="hero-image">
    </div>
</div>
<script>
// Switch roles
document.addEventListener('DOMContentLoaded', function() {
    var sellerButton = document.querySelector('.role-button:nth-child(1)');
    var userButton = document.querySelector('.role-button:nth-child(2)');

    sellerButton.addEventListener('click', function() {
        sellerButton.classList.add('active');
        userButton.classList.remove('active');
        document.getElementById('role').value = 'seller';
        document.querySelector('.seller-only').style.display = 'block';
    });

    userButton.addEventListener('click', function() {
        userButton.classList.add('active');
        sellerButton.classList.remove('active');
        document.getElementById('role').value = 'user';
        document.querySelector('.seller-only').style.display = 'none';
    });
});

// Form Navigation
var currentTab = 0;
showTab(currentTab);

function showTab(n) {
    var x = document.getElementsByClassName("tab");
    var dots = document.getElementsByClassName("dot");
    x[n].style.display = "block";
    
    // Update buttons based on current tab
    document.getElementById("prevBtn").style.display = n == 0 ? "none" : "inline";
    document.getElementById("nextBtn").innerHTML = n == (x.length - 1) ? "Register" : "Next";
    
    // Remove "active" class from all dots and add to the current one
    for (var i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    dots[n].className += " active";
}

function nextPrev(n) {
    var x = document.getElementsByClassName("tab");
    
    // Validate current tab
    if (n == 1 && !validateForm()) return false;
    
    // Hide current tab
    x[currentTab].style.display = "none";
    
    // Move to the next or previous tab
    currentTab += n;
    
    // If reached the end of the form, submit the form
    if (currentTab >= x.length) {
        document.getElementById("regForm").submit();
        return false;
    }
    
    // Otherwise, display the correct tab
    showTab(currentTab);
}

function validateForm() {
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    
    // Check if all required fields are filled
    for (i = 0; i < y.length; i++) {
        if (y[i].value == "" && y[i].hasAttribute('required')) {
            y[i].className += " invalid";
            valid = false;
        } else {
            y[i].className = y[i].className.replace(" invalid", "");
        }
    }
    
    return valid;
}

function redirectToGoogle() {
    window.location.href = "https://accounts.google.com/v3/signin/identifier?continue=https%3A%2F%2Faccounts.google.com%2F&followup=https%3A%2F%2Faccounts.google.com%2F&ifkv=Ab5oB3ooj-VsT7uomJnZGfMDgOiDdyeKG4QgJGgXg8XhZgVh0GOnuyopA8TDckNpv1ovAAqctYBSvQ&passive=1209600&flowName=GlifWebSignIn&flowEntry=ServiceLogin&dsh=S-2093685414%3A1724759757742554&ddm=0";
}

</script>

</body>
</html>
