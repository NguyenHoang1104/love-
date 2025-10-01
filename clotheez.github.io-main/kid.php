<?php
@include 'config.php';

$sql = "SELECT * FROM product where category = '3'";
$all_product = $conn->query($sql);
?>

<?php
include 'Components/connect.php';
$user_id = 0;
session_start();
$user_id = $_SESSION['user_id'];
$success_msg = 'Add to Cart';

 if(isset($_POST['add_to_cart'])){
    $product_id = $_POST['product_id'];
    $product_id = filter_var($product_id, FILTER_SANITIZE_STRING);
    $qty = 1;
    $qty = filter_var($qty, FILTER_SANITIZE_STRING);
    $product_price = $_POST['product_price'];

   $verify_user = $conn->prepare("SELECT * FROM `user` WHERE id = ?");
   $verify_user->execute([$user_id]);

   if($verify_user->rowCount() <= 0){
    header('location:account.php');
   }
   else{
        $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND product_id = ?");   
        $verify_cart->execute([$user_id, $product_id]);

        $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
        $max_cart_items->execute([$user_id]);

        if($verify_cart->rowCount() > 0){
            $success_msg = 'Already Added to Cart!';
        }elseif($max_cart_items->rowCount() == 10){
            $success_msg = 'Cart is full!';  
        }else{

            $select_price = $conn->prepare("SELECT * FROM `product` WHERE product_id = ? LIMIT 1");
            $select_price->execute([$product_id]);
            $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

            $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, product_id, price, qty) VALUES(?,?,?,?)");
            $insert_cart->execute([$user_id, $product_id, $product_price, $qty]);
            $success_msg = 'Added to cart!';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clotheez | Kid</title>
    <link rel="stylesheet" href="css/product-style.css">
</head>
<body>
    <!-- -----------------------------------------Header Section -->
    <header>
    <a href="index.php"><h2 class="logo"><img src="./img/logo.png" width="150px" alt="Logo"></h2></a>
        <nav class="navigation">
            <ul class="nav_links">
                <li><a href="index.php">Home</a></li>
                <li><a href="men.php">Men</a></li>
                <li><a href="women.php">Women</a></li>
                <li><a href=""class="active">Kids</a></li>
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
                        <img src="./img/kid-banner-1.png" alt="Mens Banner" class="banner-img">
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
                <img src="<?php echo $row["product_image"];?>" alt="Cloth">
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
                        <img src="./img/kid-banner-2.png" alt="Mens Banner" class="banner-img">
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
                        <li><a href="#">Men</a></li>
                        <li><a href="#">Women</a></li>
                        <li><a href="#">Kid</a></li>
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