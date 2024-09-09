<!------ user -Find a account page-(reset password)------>

<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
 
if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $con = new mysqli("localhost", "root", "", "heritagelink");
   
    $stmt = $con->prepare('SELECT * FROM customers WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
       
        header('Location: reset.php?username=' . urlencode($username));
        exit();
    } else {
        echo "<script>alert('User Account Not Found.');</script>";
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
   
	<style>
	body {
          
    font-family: Poppins;
    background-color: #f4f4f9;
         }
     </style>
</head>

<body  >
    <div class="login">
        <video width="100%"  autoplay muted playsinline loop>
          <source src="../assets/pottery.mp4" type="video/mp4">
         </video>

        
        <div class="login-child"></div>
        <form action="Lg.php"method="POST">
            <div class="herritage-link2" style="left:750px; top: 90px;">
                <h1 style="color:#541E3A; text-align: right;">Herritage Link</h1>
            </div>
            <div class="login5" style="left:760px; top: 130px;">
                <h2 style="color:#AD6A6C;text-align: right;">Find your account</h2>
            </div>
		
                                   
            <div class="login-child5" style="top: 30px;">
                <button id="sellerTab" style="border-radius: 4px; color:white"onclick="window.location.href='seller-lg.php'">SELLER</button>
                <button id="userTab" class="active" style="left:740px; border-radius: 4px;"onclick="window.location.href='Lg.php'">USER</button>
            </div>
 <div class="herritage-link2" style="left:670px; top: 180px;">
                <pre style="color:#541E3A; text-align: right;font-family:poppins; font-size:14px;">
           Please enter your username to search 
		   for your account.
		   </pre>
		  <hr>
				</div>
            <div class="username" style="left:630px; top: 280px;"> username
                <div>
                    <input type="text" name="username" style="background-color: #D7C1B9; width:330px;"required>
					
                </div>
            </div>
			
            <div class="login-child52" style="left:830px; top: 400px; width:140px">
             <a href="reset.php">    <button style="border-radius: 5px;width:170px">Reset Password</button>
            </div>
			
             <div class="login-child52" style="left:620px; top: 400px;width:200px ">
                <button type="submit" style="border-radius: 5px;;width:170px"onclick="window.location.href='Login.php'">Back </button>
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
                form.setAttribute('action', 'sellerLogin.php'); 
            });

            userTab.addEventListener('click', (event) => {
                event.preventDefault();
                userTab.classList.add('active');
                sellerTab.classList.remove('active');
                form.setAttribute('action', 'lg.php'); 
            });
        });
    </script>
</body>
</html>
