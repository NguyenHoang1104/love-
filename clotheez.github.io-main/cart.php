<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

?>


<?php

include 'components/connect.php';


if(isset($_POST['update_cart'])){

   $cart_id = $_POST['cart_id'];
   $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);

   $update_qty = $conn->prepare("UPDATE `cart` SET qty = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $success_msg[] = 'Cart quantity updated!';

}

if(isset($_POST['delete_item'])){

   $cart_id = $_POST['cart_id'];
   $cart_id = filter_var($cart_id, FILTER_SANITIZE_STRING);
   
   $verify_delete_item = $conn->prepare("SELECT * FROM `cart` WHERE id = ?");
   $verify_delete_item->execute([$cart_id]);

   if($verify_delete_item->rowCount() > 0){
      $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
      $delete_cart_id->execute([$cart_id]);
      $success_msg[] = 'Cart item deleted!';
   }else{
      $warning_msg[] = 'Cart item already deleted!';
   } 

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Clotheez | Cart</title>

   <script>
        function refreshPage() {
             location.reload();
        }
    </script>
 

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
            <a class="" href=""><button>Cart</button></a>
            <a class="active" href="account.php"><button>Account</button></a>
        </div>
    </header>
    <!-- -----------------------------------------Header Section -->

    <!-- ------- Cart Item-------- -->
        <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <?php
                $grand_total = 0;
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);
                if($select_cart->rowCount() > 0){
                    while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){

                    $select_products = $conn->prepare("SELECT * FROM `product` WHERE product_id = ?");
                    $select_products->execute([$fetch_cart['product_id']]);
                    if($select_products->rowCount() > 0) {
                        $fetch_product = $select_products->fetch(PDO::FETCH_ASSOC);
            ?> 
                <tr>
                <td>
                    <div class="cart-info">
                        <img src="<?=$fetch_product['product_image']?>" width="200">
                        <div>
                            <p><?=$fetch_product['product_name']?></p>
                            <small>Rs. <?=$fetch_product['price']?></small>
                            <br>
                            <form action="" method="POST">
                            <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                            <input type="submit" value="Remove" name="delete_item" class="delete-btn" onclick="return confirm('Delete this Item?');">
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <form action="" method="POST">
                    <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                    <input type="number" name="qty" require min="1" value="<?=$fetch_cart['qty']?>" max="99">
                    <input type="submit" value="Update" name="update_cart" class="delete-btn" onclick="return confirm('Update this Item?');">
                    </form>
                </td>
                <td>Rs. <?=$sub_total = ($fetch_cart['qty']* $fetch_product['price'])?></td>
            </tr>
            <?php
            $grand_total += $sub_total;
                    }else{
                        echo '<p class="empty">Product was not found!</p>';
                    }
                }
                }else{
                    echo '<p class="empty">Your cart is Empty!</p>';
                }
                ?>
                

            <!-- ************************* -->
            
            
            
        </table>


        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>Rs. <?=$grand_total?></td>
                </tr>
                <tr>
                    <td>Delivery Charge</td>
                    <td>Rs. 300</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>Rs. <?=$grand_total + 300?></td>
                </tr>
                <tr>
                    <td>
                        <?php
                        $select_cart->execute([$user_id]);
                        if($select_cart->rowCount() == 0){
                        ?>
                            <div class="btn">
                            <a href="checkout.php"><button disabled>Checkout</button></a>
                            </div>
                    <?php
                    }else{
                        ?>
                            <div class="btn">
                            <a href="checkout.php"><button>Checkout</button></a>
                            </div>
                    </td>
                    <?php
                    }?>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>