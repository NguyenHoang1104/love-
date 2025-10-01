<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];



if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
   exit();
};

include 'components/connect.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Clotheez | My Order</title>

 

   <link rel="stylesheet" href="css/product-style.css">

</head>
<body>
<!-- -----------------------------------------Header Section -->
    <header>
    <a href="index.php"><h2 class="logo"><img src="./img/logo.png" width="150px" alt=""></h2></a>
        <nav class="navigation">
            <ul class="nav_links">
                <li><a href="index.php">Home</a></li>
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

    <!-- ------- Cart Item-------- -->
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th></th>
                <th>Payment Method</th>
                <th>Ordered Date</th>
                <th>Status</th>
                <th>Price</th>
            </tr>
            <?php
               $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
               $select_orders->execute([$user_id]);
               if($select_orders->rowCount() > 0){
                  while($fetch_order = $select_orders->fetch(PDO::FETCH_ASSOC)){
                     $select_product = $conn->prepare("SELECT * FROM `product` WHERE product_id = ?");
                     $select_product->execute([$fetch_order['product_id']]);
                     if($select_product->rowCount() > 0){
                        while($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)){
            ?> 
                <tr>
                <td>
                    <div class="cart-info">
                        <img src="<?=$fetch_product['product_image']?>" width="200">
                    </div>
                </td>
                <td>
                    <?=$fetch_product['product_name']?>
                </td>
                <td>
                    <?=$fetch_order['method']?>
                </td>
                <td>
                    <?=$fetch_order['date']?>
                </td>
                <td>
                    <?=$fetch_order['status']?>
                </td>
                <td>
                    Rs.<?=$fetch_order['price']?>
                </td>
            </tr>
            <?php
                    }
                }
                else{
                    echo '<p class="empty">your cart is empty!</p>';
                }
            }
        }
                ?>
                
        </table>

    </div>
   








<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>