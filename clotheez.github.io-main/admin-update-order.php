<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $order_status = $_POST['order_status'];
   $update_data = "UPDATE `orders` SET `status`='$order_status' WHERE id = $id";
   $upload = mysqli_query($conn, $update_data);

   if($upload){
      header('location:admin-page.php');
   }else{
      $$message[] = 'please fill out all!'; 
   }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/admin-style.css">
   <title>Clotheez | Admin</title>
</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($conn, "SELECT * FROM `orders` WHERE id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">update the order</h3>
      <input type="text" class="box" name="order_id" value="<?php echo $row['id']; ?>" placeholder="enter the product name" readonly>
      <input type="text" class="box" name="order_name" value="<?php echo $row['name']; ?>" placeholder="enter the product image" readonly>
      <input type="text" class="box" name="order_tp" value="<?php echo $row['number']; ?>" placeholder="enter the product image" readonly>
      <input type="text" class="box" name="order_email" value="<?php echo $row['email']; ?>" placeholder="enter the product image" readonly>
      <input type="text" class="box" name="order_method" value="<?php echo $row['method']; ?>" placeholder="enter the product image" readonly>
      <select name="order_status" class="box" placeholder="Order Status">
            <option value="Pending">Pending</option>
            <option value="Shipped">Shipped</option>
            <option value="Completed">Completed</option>
      <input type="submit" value="update product" name="update_product" class="btn">
      <a href="admin-page.php" class="btn">go back!</a>
   </form>
   


   <?php }; ?>

   

</div>

</div>
<footer>
<div class="footer-bottom">
            <div class="container">
               <p><a href="index.html">Back to Home</a></p>
                <p class="copyright">
                    Copyright &copy; <a href="admin-login.php">Clotheez</a> | All rights reserved.
                </p>
            </div>
        </div>
</footer>
</body>
</html>