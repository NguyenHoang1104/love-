<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clotheez</title>
    <link rel="stylesheet" href="css/index-style.css" type="text/css">
</head>

<body>
    <!-- -----------------------------------------Header Section -->
    <header>
    <a href="index.php"><h2 class="logo"><img src="./img/logo.png" width="150px" alt=""></h2></a>
        <nav class="navigation">
            <ul class="nav_links">
                <li><a href="" class="active">Home</a></li>
                <li><a href="men.php">Men</a></li>
                <li><a href="women.php">Women</a></li>
                <li><a href="kid.php">Kids</a></li>
            </ul>
        </nav>
        <div class="btn">
            <a class="" href="cart.php"><button>Cart</button></a>
            <a class="active" href="account.php"><button>Account</button></a>
        </div>
    </header>
    <!-- -----------------------------------------Header Section -->
    <main>
        <!--------------------------------------------------- Banner -->
        <div class="banner">
            <div class="container">
                    <div class="slider-item">
                        <img src="./img/banner-2.jpg" alt="women's latest fashion sale" class="banner-img">
                        <div class="banner-content">
                            <p class="banner-subtitle">Welcome to </p>
                            <h2><img src="./img/logo.png" width="300px" alt="Clotheez"></h2>
                            <h2 class="banner-title">No. 1 Online Clothing Sales Website</h2>
                        </div>
                    </div>
            </div>
        </div>

        <!--------------------------------------------------- Banner -->

        <!--------------------------------------------------- Category -->
        <div class="product-main">
            <h2 class="title">Category</h2>
            <div class="product-grid">
                <div class="showcase">
                    <div class="showcase-banner">
                        <img src="./img/Icon/men.png" alt="Mens Cloths" width="300" class="product-img">
                    </div>
                    <div class="showcase-content">
                        <a href="men.php" class="showcase-category">Men's Cloths</a>
                    </div>
                </div>

                <div class="showcase">
                    <div class="showcase-banner">
                        <img src="./img/Icon/women.png" alt="Women Cloths" width="300" class="product-img">
                    </div>
                    <div class="showcase-content">
                        <a href="women.php" class="showcase-category">Women's Cloths</a>
                    </div>
                </div>

                <div class="showcase">
                    <div class="showcase-banner">
                        <img src="./img/Icon/kids.png" alt="Kid Cloths" width="300" class="product-img">
                    </div>
                    <div class="showcase-content">
                        <a href="kid.php" class="showcase-category">Kid's Cloths</a>
                    </div>
                </div>
            </div>
        </div>

        <!--------------------------------------------------- Category -->

        <!--------------------------------------------------- About us -->
        <div class="about">
            <div class="container">
                    <div class="about-item">
                        <img src="./img/about-us.png" alt="women's latest fashion sale" class="banner-img">
                        <div class="about-content">
                            <p class="about-subtitle">About Us</p>
                            <h2 class="about-title">Clotheez is your one-stop destination for stylish and trendy
                                clothing for men, women, and kids. We offer a wide range of high-quality,
                                affordable clothes for all ages and sizes. With our easy-to-use e-commerce website,
                                you can conveniently shop for your favorite clothing items from the comfort of
                                your home. Our mission is to provide our customers with the latest fashion trends
                                and exceptional customer service, making every shopping experience a delight.</h2>
                        </div>
                    </div>
            </div>
        </div>

        <!--------------------------------------------------- About us -->

        <!--------------------------------------------------- Services -->
        <div class="service">
            <h2 class="title">Our Services</h2>
            <div class="service-container">

                <div class="service-item">
                    <div class="service-icon">
                        <img src="./img/Icon/ship.png" alt="Ship Icon" width="100" class="service-icon">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Worldwide Delivery</h3>
                        <p class="service-desc">For Order over 5000LKR</p>
                    </div>
                </div>

                <div class="service-item">
                    <div class="service-icon">
                        <img src="./img/Icon/fast-delivery.png" alt="Delivery Icon" width="100" class="service-icon">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Express Delivery</h3>
                        <p class="service-desc">Only Colombo Town</p>
                    </div>
                </div>

                <div class="service-item">
                    <div class="service-icon">
                        <img src="./img/Icon/customer.png" alt="Support Icon" width="100" class="service-icon">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Online Support</h3>
                        <p class="service-desc">24/7 Customer Support</p>
                    </div>
                </div>

                <div class="service-item">
                    <div class="service-icon">
                        <img src="./img/Icon/credit-card.png" alt="Ship Icon" width="100" class="service-icon">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Secure Payment</h3>
                        <p class="service-desc">Latest Encryption Technology</p>
                    </div>
                </div>

                <div class="service-item">
                    <div class="service-icon">
                        <img src="./img/Icon/return.png" alt="Return Icon" width="100" class="service-icon">
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">Free Returns</h3>
                        <p class="service-desc">Within 30 Days Return</p>
                    </div>
                </div>

            </div>
        </div>
        <!--------------------------------------------------- Services -->
    </main>

    <!------------------------------------------------------- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="row">
                <div class="footer-col">
                    <h4>company</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">our services</a></li>
                        <li><a href="#">privacy policy</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>get help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">shipping</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="#">order status</a></li>
                        <li><a href="#">payment options</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Category</h4>
                    <ul>
                        <li><a href="men.php">Men</a></li>
                        <li><a href="women.php">Women</a></li>
                        <li><a href="kid.php">Kid</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>follow us</h4>
                    <div class="social-links">
                        <a href="#">F</a>
                        <a href="#">I</a>
                        <a href="#">W</i></a>
                        <a href="#">Y</i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <p class="copyright">
                    Copyright &copy; <a href="admin-login.php">Clotheez</a> | All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!------------------------------------------------------- Footer -->


    <!------------------------------------------------------- JS -->
    <script src=""></script>
</body>

</html>