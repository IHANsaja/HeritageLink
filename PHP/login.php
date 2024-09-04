<!------ user -login page------>

<?php
session_start(); // Start the session at the beginning of the script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];  // Get the password input

    // Database connection
    $con = new mysqli("localhost", "root", "", "heritagelink");

    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        // Prepare and bind the SQL statement
        $stmt = $con->prepare("SELECT * FROM customers WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();

            // Direct comparison of passwords (consider using password hashing for security)
            if ($password === $data['password']) {
                // Set session variables
                $_SESSION['seller_id'] = $data['seller_id']; // Assuming 'seller_id' is a column in your table
                $_SESSION['username'] = $data['username'];

                // Redirect to the seller dashboard
                header("Location: ../index.php");
                exit();
            } else {
                echo "<script>alert('Incorrect password.');</script>";
            }
        } else {
            echo "<script>alert('Username not found.');</script>";
        }

        $stmt->close();
        $con->close();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="../styles/Login.css" />
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
    <title>Heritage Link Login</title>
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800;900&display=swap"/>
    
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap"/>
    
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;500;900&display=swap"/>
    
	
</head>
<body   style="font-family:poppins;background-color: #f4f4f9;">

   <div class="login">
       <video width="100%"  autoplay muted playsinline loop>
            <source src="../assets/Sigiriya3.mp4" type="video/mp4">
        </video>
        <div class="login-child"></div>
        <form action="Login.php"method="POST">
            <div class="herritage-link2" style="left:750px; top: 90px;">
                <h1 style="color:#541E3A; text-align: right;">Herritage Link</h1>
            </div>
            <div class="login5" style="left:910px; top: 130px;">
                <h2 style="color:#AD6A6C;text-align: right;">Login</h2>
            </div>
			<div>
          

        
            <div class="login-child5" style="top: 30px;">
			
                <button id="sellerTab" style="border-radius: 4px;" onclick="window.location.href='seller-login.php'">SELLER</button>
                <button id="userTab" class="active" style="left:740px; border-radius: 4px;" onclick="window.location.href='login.php'">USER</button>
           
		   </div>

            <div class="username" style="left:630px; top: 190px;"> Username
                <div>
                    <input type="text" name="username" style="background-color: #D7C1B9; width:330px;"required>
					
                </div>
            </div>

            <div class="password" style="left:630px; top: 270px;">Password
                <div>
                    <input type="password" name="password" style="background-color: #D7C1B9; width:330px; "required>
			   </div>
				<div style="width:550px;"><a style="color:#541E3A ;left:800px;font-family:poppins; font-size:14px;" onclick="window.location.href='Lg.php'">Forgot password?</a></div>
            </div>
	
            <div class="login-child52" style="left:880px; top: 400px;">
               <button type="submit" style="border-radius: 5px;" >LOGIN</button></a>
            </div>
            <div class="login-child52" style="left:880px; top: 470px;">
                <button type="submit" style="border-radius: 5px; "onclick="window.location.href='signup.php'">SIGNUP</button>
            </div>

           <a href="https://www.google.com"> <img class="icons8-google-logo-48-11" alt="" style="left:638px; top: 400px;" src="../assets/google.png"  /> </a>
          <a href="https://www.facebook.com">  <img class="icons8-facebook-48-11" alt="" style="left:705px; top: 400px;" src="../assets/facebook.png" /><a href="www.facebook.com"></a>
            <div class="if-you-dont" style="left:630px; top: 470px;">
             <pre style="font-family:poppins; font-size:14px;">
If you don’t have an account, 
please register here.<pre>
            </div>
        </form>
		
    </div>

    <script>
       
        document.addEventListener('DOMContentLoaded', function () {
            const sellerTab = document.querySelector('#sellerTab');
            const userTab = document.querySelector('#userTab');
            const form = document.querySelector('form');

           
            sellerTab.addEventListener('click', (event) => {
                event.preventDefault();
                sellerTab.classList.add('active');
                userTab.classList.remove('active');
                form.setAttribute('action', 'seller-login.php'); // Set the action for the SELLER
            });

            userTab.addEventListener('click', (event) => {
                event.preventDefault();
                userTab.classList.add('active');
                sellerTab.classList.remove('active');
                form.setAttribute('action', 'login.php'); // Set the action for the USER
            });
        });
		
    </script>
</body>
</html>
