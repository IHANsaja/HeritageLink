<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="assets/favicon.png">
  <link rel="stylesheet" href="about.css">
  <title>Heritage Link</title>
  <link rel="stylesheet" href="styles/style.css">
  <link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;800;900&display=swap"
/>
<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap"
/>
<link
  rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;500;900&display=swap"
/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">

</head>
<body>
  <div class="nav-bar">
          <img src="assets/logoLarge.jpeg" alt="logo" class="logo">
          <div class="nav-links">
              <a href="index.php"><div class="home">HOME</div></a>
              <a href="PHP/museum.php"><div class="museum">MUSEUM</div></a>
              <a href="PHP/marketplace.php"><div class="market">MARKET</div></a>
              <a href="https://en.wikipedia.org/wiki/List_of_World_Heritage_Sites_in_Sri_Lanka" target="_blank"><div class="protect">PROTECT</div></a>
          </div>
          <div class="login">
            <?php
              session_start(); // Start the session at the beginning of the script
              if (isset($_SESSION['seller_username'])) {
                  // Seller is logged in
                  echo "<div class='welcome'>Welcome, <a class='welcome' href='PHP/seller-dashboard.php'>" . htmlspecialchars($_SESSION['seller_username']) . "</a></div>";
                  echo "<a href='PHP/logout.php'><button class='logout-btn'>LOGOUT</button></a>";
              } elseif (isset($_SESSION['username'])) {
                  // Normal user is logged in
                  echo "<div class='welcome'>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</div>";
                  echo "<a href='PHP/logout.php'><button class='logout-btn'>LOGOUT</button></a>";
              } else {
                  // No user is logged in
                  echo '<div class="login-btn"><a href="PHP/login.php"><button>LOGIN</button></a></div>';
                  echo '<div class="link-btn"><a href="PHP/signup.php"><button>LINK</button></a></div>';
              }
              ?>
          </div>
  </div>

<div class="mobile-menu">
    <div class="close-menu">
        <i class="ri-close-line"></i>
    </div>
    <div class="mobile-nav-links">
        <div class="home">HOME</div>
        <div class="museum">MUSEUM</div>
        <div class="market">MARKET</div>
        <div class="protect">PROTECT</div>
    </div>
    <div class="mobile-login">
      <?php
      session_start();
      if (isset($_SESSION['username'])) {
        // User is logged in
        echo "<div class='welcome'>Welcome, " . htmlspecialchars($_SESSION['username']) . "!</div>";
        echo "<a href='PHP/logout.php'><button>LOGOUT</button></a>";
      } else {
        // User is not logged in
        echo '<div class="login-btn"><a href="PHP/login.php"><button>LOGIN</button></a></div>';
        echo '<div class="link-btn"><a href="PHP/signup.php"><button>LINK</button></a></div>';
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
<!-- -------------------------------------------container--------------------------------------------------------- -->
<div class="container">
  <div class="box1">
    <div class="about">
      <div class="who-we-are">
        <table>
          <tr>
            <td>
              <h1>WHO WE ARE?</h1>
            </td>
            <td>
              <img src="assets/heritage.jpg" alt="">
            </td>
          </tr>
        </table>
       
      </div>
      <div class="dis">
        <p>HerritageLink Sri Lanka is a dedicated platform committed to preserving
          and celebrating the rich cultural heritage of Sri Lanka. In a rapidly
          modernizing world, our mission is to bridge the gap between tradition
          and the present by connecting artisans, historians, and the public. We
          offer an online marketplace where traditional craftsmen can showcase and
          sell their unique creations, ensuring that ancient crafts are passed
          down to future generations.</p>
      </div>  
    </div>
   
  </div>
  
  <!-- --------------------------------------------NEW CODE-------------------------------------------------------------- -->
  <div class="box2">
    <div class="attention">ATTENTION!</div>
    
   
    <div class="image-text-container">
      <img class="yapahuwa" src="assets/yapahuwa.jpg"/>

    <div class="yapahuwa-dis">
      Yapahuwa, an ancient rock fortress in Sri Lanka, was once the island's
      capital in the 13th century. Its iconic stone stairway leads to the
      ruins of a royal palace, showcasing the rich history and architectural
      brilliance of the era.
    </div> 
    </div>
    <div class="more"><a href="https://en.wikipedia.org/wiki/Yapahuwa"><button>MORE</button></a></div>
    

    
    <div class="image-text-container">
    
    <div class="sigiriya-dis">
      Sigiriya, a UNESCO World Heritage site, is a towering rock fortress in
      Sri Lanka, known for its stunning frescoes and the ancient ruins of a
      royal palace. Built in the 5th century, it stands as a testament to the
      island's rich history and architectural ingenuity.
    </div>
    <img class="sigiriya" src="assets/sigiriya.jpg"/>
    </div>
    <div class="more1"><a href="https://en.wikipedia.org/wiki/Sigiriya"><button>MORE</button> </a></div>
    
    

  </div>
<!-- --------------------------------------------footer-------------------------------------------------------------- -->
  <div class="footer">
        
    <div class="home-parent">
        <div class="home2">HOME</div>
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
        <img class="heritage-map-img" alt="" src="assets/heritagemap.gif" >
    </div>
</div>

<div class="heritageconnect-sri-lanka">
    © 2024 HeritageLink Sri Lanka. All rights reserved.
</div>
<script src="scripts/script.js"></script>
</body>
</html>