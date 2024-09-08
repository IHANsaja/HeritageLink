<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "heritagelink";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$reg_error = "";
$reg_success = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];
    $contact_number = $_POST['contact_number'];
    $business_name = $_POST['business_name'];
    $address = $_POST['address'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $reg_error = "Please enter a valid email!";
    }
    
    elseif (strlen($contact_number) < 10) {
        $reg_error = "Please enter a valid Phone Number!";
    }
    
    elseif ($pass !== $confirm_pass) {
        $reg_error = "Passwords do not match!";
    } else {
        
        $stmt = $conn->prepare("SELECT seller_id FROM Sellers WHERE username = ?");
        if ($stmt === false) {
            die("MySQL prepare statement error: " . $conn->error);
        }
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $reg_error = "Username is already taken!";
        } else {
            
            $plain_password = $pass;

            $stmt = $conn->prepare("INSERT INTO Sellers (username, email, password, business_name, contact_number, address) VALUES (?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die("MySQL prepare statement error: " . $conn->error);
            }
            $stmt->bind_param("ssssss", $user, $email, $plain_password, $business_name, $contact_number, $address);

            if ($stmt->execute()) {
                $reg_success = "Registration successful! You can now log in.";
                
                header("Location: login.php");
                exit();
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
    <title>Heritage Link - Seller Registration</title>
    <link rel="stylesheet" href="../styles/signupstyles.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
</head>
<body>
<div class="container">
    <div class="left-side">
        <div class="role-selection">
        <button onclick="window.location.href='seller-signup.php'" class="role-button active">SELLER</button>
        <button onclick="window.location.href='signup.php'" class="role-button">USER</button>
        </div>
        <div>
            <h1 class="logo">Heritage Link</h1>
            <h2 class="sub-heading">Seller Register</h2>
        </div>
        <?php if ($reg_error): ?>
            <p class="error"><?php echo $reg_error; ?></p>
        <?php endif; ?>
        <?php if ($reg_success): ?>
            <p class="success"><?php echo $reg_success; ?></p>
        <?php endif; ?>
        <!--form-->
        <form id="regForm" action="" method="POST">
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

            <!-- Tab 3 -->
            <div class="tab">
                <div class="form-group">
                    <label for="business_name">Business Name</label>
                    <input type="text" id="business_name" name="business_name" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
            </div>

            <!-- Navigation and Submit Buttons -->
            <div class="pagination-dots">
                <span class="dot" onclick="showTab(0)"></span>
                <span class="dot" onclick="showTab(1)"></span>
                <span class="dot" onclick="showTab(2)"></span> 
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
        <button onclick="window.location.href='login.php'" class="login-btn">Login</button></p>
    </div>
    <div class="right-side">
        <img src="../assets/sigiriya1.jpg" alt="Sigiriya" class="hero-image">
    </div>
</div>
<script>
    
    // Form Navigation
    var currentTab = 0;
    showTab(currentTab);

    function showTab(n) {
        var x = document.getElementsByClassName("tab");
        var dots = document.getElementsByClassName("dot");
        for (var i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[n].style.display = "block";
        
        document.getElementById("prevBtn").style.display = n === 0 ? "none" : "inline";
        document.getElementById("nextBtn").innerHTML = n === (x.length - 1) ? "Register" : "Next";
        
        for (var i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        dots[n].className += " active";
    }

    function nextPrev(n) {
        var x = document.getElementsByClassName("tab");
        
        if (n === 1 && !validateForm()) return false;
        x[currentTab].style.display = "none";
        currentTab += n;
        if (currentTab >= x.length) {
            document.getElementById("regForm").submit();
            return false;
        }

        showTab(currentTab);
    }

    function validateForm() {
        var x, y, i, valid = true;
        x = document.getElementsByClassName("tab");
        y = x[currentTab].getElementsByTagName("input");
        
        for (i = 0; i < y.length; i++) {
            if (y[i].value.trim() === "" && y[i].hasAttribute('required')) {
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
