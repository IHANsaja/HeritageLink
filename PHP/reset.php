<!------ user -(reset password page)------>

<?php
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password === $confirm_password) {
            
            $con = new mysqli("localhost", "root", "", "heritagelink");

            
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

           
            $stmt = $con->prepare('UPDATE customers SET password = ? WHERE username = ?');

         
            if ($stmt === false) {
                die("Failed to prepare the SQL statement: " . $con->error);
            }

            
            $stmt->bind_param('ss', $password, $username);

      
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo "<script>alert('Password reset successfully');</script>";
                } else {
                    echo "<script>alert('No changes made or password was not updated');</script>";
                }
            } else {
                echo "<script>alert('Error executing the SQL statement: " . $stmt->error . "');</script>";
            }

            
            $stmt->close();
            $con->close();
        } else {
            echo "<script>alert('Passwords do not match');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="../styles/Login.css" />
	<link rel="icon" type="image/x-icon" href="../assets/favicon.png">
    <title>Heritage Link Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800;900&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;500;900&display=swap" />
    <title>Reset Password</title>
	
</head>
<body style="font-family:poppins;background-color: #f4f4f9;">
    <div class="login">
	
	<video width="100%"  autoplay muted playsinline loop>
  <source src="../assets/tea2.mov" type="video/mp4">
  

</video>

        <div class="form-section"></div>
        <div class="login-child"></div>
        <form method="post">
            <div class="herritage-link2" style="left:750px; top: 90px;">
                <h1 style="color:#7a3e3e; text-align: right;">Herritage Link</h1>
            </div>
            <div class="login5" style="left:780px; top: 130px;">
                <h2 style="color:#bc8f8f;text-align: right;">Reset password</h2>
            </div>
			

            <div class="login-child5" style="top: 30px;">
                <button id="sellerTab" style="border-radius: 4px;"onclick="window.location.href='seller-reset.php'">SELLER</button>
                <button id="userTab" class="active" style="left:740px; border-radius: 4px;"onclick="window.location.href='reset.php'">USER</button>
            </div>
            <div class="password" style="left:630px; top: 200px; width:120px;">
                New Password
                <div>
                    <input type="password" name="password" style="background-color: #bc8f8f; width:330px;" required>
                </div>
            </div>
            <div class="password" style="left:630px; top: 280px;width:150px;">
                Confirm Password
                <div>
                    <input type="password" name="confirm_password" style="background-color: #bc8f8f; width:330px;" required>
                </div>
            </div>
            <div class="login-child52" style="left:815px; top: 400px;width:170px">
                 <button type="submit" style="border-radius: 5px;width:170px">Reset Password</button>
            </div>
            <div class="login-child52" style="left:620px; top: 400px; width:200px">
                <button type="submit" style="border-radius: 5px;width:170px"onclick="window.location.href='Lg.php'">Back</button>
            </div>
            </div>
              <a href="https://www.google.com"><img class="icons8-google-logo-48-11" alt="" style="left:980px; top: 570px;" src="../assets/google.png" /></a>
            <a href="https://www.facebook.com"><img class="icons8-facebook-48-11" alt="" style="left:1030px; top: 570px;" src="../assets/facebook.png" /></a>
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
                form.setAttribute('action', 'sellerLogin.php'); // Set the action for the SELLER
            });

            userTab.addEventListener('click', (event) => {
                event.preventDefault();
                userTab.classList.add('active');
                sellerTab.classList.remove('active');
                form.setAttribute('action', 'lg.php'); // Set the action for the USER
            });
        });
		
		
    </script>
</body>
</html>
