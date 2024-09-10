<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="../styles/NavBar.css">
    <link rel="stylesheet" href="../styles/museum.css">
    <link rel="stylesheet" href="../styles/Footer.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800;900&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;500;900&display=swap"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.png">
    <title>Heritage Link Museum</title>
</head>

<body>

    <div class="nav-bar">
        <img src="../assets/logoLarge.jpeg" alt="logo" class="logo">
        <div class="brandname">
            <h2>HerritageLink</h2>
        </div>
        <div class="nav-links">
            <a href="../index.php"><div class="home">HOME</div></a>
            <a href="museum.php"><div class="museum">MUSEUM</div></a>
            <a href="marketplace.php"><div class="market">MARKET</div></a>
            <a href="https://en.wikipedia.org/wiki/List_of_World_Heritage_Sites_in_Sri_Lanka" target="_blank"><div class="protect">PROTECT</div></a>
        </div>
        <div class="login">
            <?php
            session_start(); 
            if (isset($_SESSION['seller_username'])) {
                // Seller 
                echo "<div class='welcome'>Welcome, <a class='welcome' href='seller-dashboard.php'>" . htmlspecialchars($_SESSION['seller_username']) . "</a></div>";
                echo "<a href='logout.php'><button class='logout-btn'>LOGOUT</button></a>";
            } elseif (isset($_SESSION['username'])) {
                // Normal user 
                echo "<div class='welcome'>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</div>";
                echo "<a href='logout.php'><button class='logout-btn'>LOGOUT</button></a>";
            } else {
                // No user is logged in
                echo '<div class="login-btn"><a href="login.php"><button>LOGIN</button></a></div>';
                echo '<div class="link-btn"><a href="signup.php"><button>LINK</button></a></div>';
            }
            ?>
        </div>
        <div class="menu-toggle">
            <i class="ri-menu-line"></i>
        </div>
    </div>

    <div class="mobile-menu">
        <div class="close-menu">
            <i class="ri-close-line"></i>
        </div>
        <div class="mobile-nav-links">
            <a href="../index.php"><div class="home">HOME</div></a>
            <a href="museum.php"><div class="museum">MUSEUM</div></a>
            <a href="marketplace.php"><div class="market">MARKET</div></a>
            <a href="https://en.wikipedia.org/wiki/List_of_World_Heritage_Sites_in_Sri_Lanka" target="_blank"><div class="protect">PROTECT</div></a>
        </div>
        <div class="mobile-login">
            <?php
            if (isset($_SESSION['seller_username'])) {
                echo "<div class='welcome'>Welcome, <a class='welcome' href='seller-dashboard.php'>" . htmlspecialchars($_SESSION['seller_username']) . "</a></div>";
                echo "<a href='logout.php'><button class='logout-btn'>LOGOUT</button></a>";
            } elseif (isset($_SESSION['username'])) {
                echo "<div class='welcome'>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</div>";
                echo "<a href='logout.php'><button class='logout-btn'>LOGOUT</button></a>";
            } else {
                echo '<div class="login-btn"><a href="login.php"><button>LOGIN</button></a></div>';
                echo '<div class="link-btn"><a href="signup.php"><button>LINK</button></a></div>';
            }
            ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuToggle = document.querySelector('.menu-toggle');
            const mobileMenu = document.querySelector('.mobile-menu');
            const closeMenu = document.querySelector('.close-menu');

            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.add('show');
            });

            closeMenu.addEventListener('click', () => {
                mobileMenu.classList.remove('show');
            });
            });
    </script>

    <div class="container" style="background-color: #E8D6CB;">
        <h2>Trending</h2>
        <div class="slider">
            <div class="slide-track">
                <div class="slide"><img src="../assets/product1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/kulla.jpg" alt=""></div>
                <div class="slide"><img src="../assets/mask1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/product3.jpeg" alt=""></div>
                <div class="slide"><img src="../assets/product2.jpg" alt=""></div>
                <div class="slide"><img src="../assets/product1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/kulla.jpg" alt=""></div>
                <div class="slide"><img src="../assets/mask2.jpg" alt=""></div>
                <div class="slide"><img src="../assets/product3.jpeg" alt=""></div>
                <div class="slide"><img src="../assets/kulla.jpg" alt=""></div>
                <div class="slide"><img src="../assets/mask1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/product3.jpeg" alt=""></div>
                <div class="slide"><img src="../assets/product2.jpg" alt=""></div>
                <div class="slide"><img src="../assets/product1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/kulla.jpg" alt=""></div>
                <div class="slide"><img src="../assets/mask2.jpg" alt=""></div>
                <div class="slide"><img src="../assets/product3.jpeg" alt=""></div>
            </div>
        </div>
    </div>

    <div class="container" style="background-color: #D0ADA7;">
        <h2>VR place visits</h2>
        <div class="slider">
            <div class="slide-track">
                <div class="slide"><img src="../assets/sigiriya1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/gallefort.jpg" alt=""></div>
                <div class="slide"><img src="../assets/amb.jpg" alt=""></div>
                <div class="slide"><img src="../assets/place1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/temple.jpg" alt=""></div>
                <div class="slide"><img src="../assets/templetooth.jpg" alt=""></div>
                <div class="slide"><img src="../assets/thuparamaya.jpeg" alt=""></div>
                <div class="slide"><img src="../assets/watadageya.jpeg" alt=""></div>
                <div class="slide"><img src="../assets/yapahuwa1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/sigiriya1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/gallefort.jpg" alt=""></div>
                <div class="slide"><img src="../assets/amb.jpg" alt=""></div>
                <div class="slide"><img src="../assets/place1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/temple.jpg" alt=""></div>
                <div class="slide"><img src="../assets/templetooth.jpg" alt=""></div>
                <div class="slide"><img src="../assets/thuparamaya.jpeg" alt=""></div>
                <div class="slide"><img src="../assets/watadageya.jpeg" alt=""></div>
            </div>
        </div>
    </div>

<div class="container" style="background-color: #AD6A6C;">
        <h2>Recommend for you</h2>
        <div class="slider">
            <div class="slide-track">
                <div class="slide"><img src="../assets/sigiriya1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/kulla.jpg" alt=""></div>
                <div class="slide"><img src="../assets/amb.jpg" alt=""></div>
                <div class="slide"><img src="../assets/product3.jpeg" alt=""></div>
                <div class="slide"><img src="../assets/temple.jpg" alt=""></div>
                <div class="slide"><img src="../assets/product1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/thuparamaya.jpeg" alt=""></div>
                <div class="slide"><img src="../assets/mask1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/yapahuwa1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/kulla.jpg" alt=""></div>
                <div class="slide"><img src="../assets/gallefort.jpg" alt=""></div>
                <div class="slide"><img src="../assets/product3.jpeg" alt=""></div>
                <div class="slide"><img src="../assets/place1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/product1.jpg" alt=""></div>
                <div class="slide"><img src="../assets/templetooth.jpg" alt=""></div>
                <div class="slide"><img src="../assets/mask3.jpg" alt=""></div>
                <div class="slide"><img src="../assets/watadageya.jpeg" alt=""></div>
            </div>
        </div>
    </div>

    <div class="footer">
        
        <div class="home-parent">
            <div class="home2">Home</div>
            <div class="museum2">MUSEUM</div>
            <div class="marketplace1">MARKETPLACE</div>
            <div class="contact-us">CONTACT US</div>
        </div>
        <div class="socials">
            <i class="ri-whatsapp-fill"></i>
            <i class="ri-facebook-circle-fill"></i>
            <i class="ri-youtube-fill"></i>
            <i class="ri-instagram-fill"></i>
        </div>
        <div class="heritage-map">
            <h3>HERITAGE MAP</h3>
            <img class="heritage-map-img" alt="" src="../assets/heritagemap.gif" >
        </div>
    </div>
    
    <div class="heritageconnect-sri-lanka">
        © 2024 HeritageLink Sri Lanka. All rights reserved.
    </div>
    <script src="../scripts/script.js"></script>
</body>

</html>