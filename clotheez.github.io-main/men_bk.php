


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clotheez | Men</title>
    <link rel="stylesheet" href="css/product-style.css">
</head>
<body>
    <!-- -----------------------------------------Header Section -->
    <header>
    <a href="index.php"><h2 class="logo"><img src="./img/logo.png" width="150px" alt=""></h2></a>
        <nav class="navigation">
            <ul class="nav_links">
                <li><a href="index.php">Home</a></li>
                <li><a href=""class="active">Men</a></li>
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

    
       <!--------------------------------------------------- Banner -->
       <div class="banner">
            <div class="container">
                    <div class="slider-item">
                        <img src="./img/men-banner-1.png" alt="Mens Banner" class="banner-img">
                        <div class="banner-content">
                            <p class="banner-subtitle">Welcome to </p>
                            <h2><img src="./img/logo.png" width="300px" alt="Clotheez"></h2>
                            <h2 class="banner-title">No. 1 Online Clothing Sales Website</h2>
                        </div>
                    </div>
            </div>
        </div>

        <!--------------------------------------------------- Banner -->
    <main>
        <?php

            while($row = mysqli_fetch_assoc($all_product)){
        ?>
        <div class="card">
            <div class="image">
                <img src="<?php echo $row["product_image"];?>" alt="Cloth" class="product-image">
            </div>
            <div class="caption">
                <p class="product_name"><?php echo $row["product_name"]; ?></p>
                <p class="price">LKR. <?php echo $row["price"]; ?></p>
                <p class="discount"><del>LKR. <?php echo $row["discount"]; ?></del></p>
            </div>
            <form action="" method="POST">
            <input type="hidden" name="product_id" value="<?= $row['product_id']; ?>">
            <input type="hidden" name="product_price" value="<?= $row['price']; ?>">
            <input type="submit" name="add_to_cart" value="Add to Cart" class="btn-cart">

            </form>
        </div>
        <?php
            }
        ?>
    </main>
    <!--------------------------------------------------- Banner -->
    <div class="banner">
        <div class="container">
            <div class="slider-item">
                <img src="./img/men-banner-3.png" alt="Mens Banner" class="banner-img">
            </div>
        </div>
    </div>

    <!--------------------------------------------------- Banner -->
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
                        <li><a href="">Men</a></li>
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
                    Copyright &copy; <a href="admin-login.php">Clotheez</a> | all rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <!------------------------------------------------------- Footer -->


    
</body>
</html>