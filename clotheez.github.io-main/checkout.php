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

if(isset($_POST['place_order'])){

    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $number = $_POST['number'];
    $number = filter_var($number, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $address = $_POST['home'].', '.$_POST['street'].', '.$_POST['city'].', '.$_POST['country'].' - '.$_POST['zip_code'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $address_type = $_POST['address_type'];
    $address_type = filter_var($address_type, FILTER_SANITIZE_STRING);
    $method = $_POST['method'];
    $method = filter_var($method, FILTER_SANITIZE_STRING);
    $status = 'Pending..';
 
    $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $verify_cart->execute([$user_id]);
    
    if($verify_cart->rowCount() > 0){
 
       while($f_cart = $verify_cart->fetch(PDO::FETCH_ASSOC)){
 
         $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, address, address_type, method, product_id, price, qty, status) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
            $insert_order->execute([$user_id, $name, $number, $email, $address, $address_type, $method, $f_cart['product_id'], $f_cart['price'], $f_cart['qty'], $status]);
 
       }
 
       if($insert_order){
          $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
          $delete_cart_id->execute([$user_id]);
          header('location:orders.php');
       }
 
    }else{
       $warning_msg[] = 'Your cart is empty!';
    }
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Clotheez | Checkout</title>

  

   <link rel="stylesheet" href="css/checkout-style.css">

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
<section class="checkout">
<div class="row">

   <form action="" method="POST">
      <h3>Billing Details</h3>
      <div class="flex">
         <div class="box">
            <input type="text" name="name" required maxlength="50" placeholder="Enter Your name" class="input">
            <input type="number" name="number" required maxlength="10" placeholder="Enter Your Number" class="input" min="0" max="9999999999">
            <input type="email" name="email" required maxlength="50" placeholder="Enter Your Email" class="input">
            <select name="method" class="input" required>
                <option value="">- Select Payment Method -</option>
               <option value="Cash on Delivery">Cash On Delivery</option>
               <option value="Credit or Debit Card">Credit or Debit Card</option>
               <option value="Crypto Currency">Crypto Currency</option>
               
            </select>
            <select name="address_type" class="input" required> 
                <option value="">- Select Address Type -</option>
               <option value="home">Home</option>
               <option value="office">Office</option>
            </select>
         </div>
         <div class="box">
            <input type="text" name="home" required maxlength="50" placeholder="Home No" class="input">
            <input type="text" name="street" required maxlength="50" placeholder="Street Name & Locality" class="input">
            <input type="text" name="city" required maxlength="50" placeholder="Enter Your City Name" class="input">
            <input type="text" name="country" required maxlength="50" placeholder="Enter Your Country Name" class="input">
            <input type="number" name="zip_code" required maxlength="6" placeholder="ZIP Code" class="input" min="0" max="999999">
         </div>
      </div>
      <div class="order-btn">
      <input type="submit" value="Place Order" name="place_order" class="btn-cart">
</div>
   </form>

   <div class="summary">
      <h3 class="cart-title">Cart Items</h3>
      <?php
         $grand_total = 0;
         if(isset($_GET['get_id'])){
            $select_get = $conn->prepare("SELECT * FROM `product` WHERE product_id = ?");
            $select_get->execute([$_GET['get_id']]);
            while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="flex">
         <img src="" class="image" alt="product_img">
         <div>
            <h3 class="name"><?= $fetch_get['name']; ?></h3>
            <p class="price">Rs.<?= $fetch_get['price']; ?> x 1</p>
         </div>
      </div>
      <?php
            }
         }else{
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if($select_cart->rowCount() > 0){
               while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                  $select_products = $conn->prepare("SELECT * FROM `product` WHERE product_id = ?");
                  $select_products->execute([$fetch_cart['product_id']]);
                  $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
                  $sub_total = ($fetch_cart['qty'] * $fetch_product['price']);

                  $grand_total += $sub_total;
         
      ?>
      <div class="flex">
         <img src="<?=$fetch_product['product_image']?>" class="image" alt="product_image">
         <div>
            <h3 class="name"><?= $fetch_product['product_name']; ?></h3>
            <p class="price">Rs.<?= $fetch_product['price']; ?> x <?= $fetch_cart['qty']; ?></p>
         </div>
      </div>
      <?php
               }
            }else{
               echo '<p class="empty">Your Cart is Empty</p>';
            }
         }
      ?>
      <div class="grand-total"><span>Grand Total :</span><p>Rs. <?= $grand_total+300; ?></p></div>
   </div>

</div>

</section>

</body>

</html>