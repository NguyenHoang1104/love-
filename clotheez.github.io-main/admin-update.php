<?php

@include 'config.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_discount = $_POST['product_discount'];
   $product_image = $_POST['product_image'];
   $category =$_POST['product_category'];

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'please fill out all!';    
   }else{

      $update_data = "UPDATE product SET product_name='$product_name', price='$product_price', discount='$product_discount', product_image='$product_image', category='$category'  WHERE product_id = '$id'";
      $upload = mysqli_query($conn, $update_data);

      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         header('location:admin_page.php');
      }else{
         $$message[] = 'please fill out all!'; 
      }

   }
};

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
      
      $select = mysqli_query($conn, "SELECT * FROM product WHERE product_id = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">update the product</h3>
      <input type="text" class="box" name="product_name" value="<?php echo $row['product_name']; ?>" placeholder="enter the product name">
      <input type="number" min="0" class="box" name="product_price" value="<?php echo $row['price']; ?>" placeholder="enter the product price">
      <input type="number" min="0" class="box" name="product_discount" value="<?php echo $row['discount']; ?>" placeholder="enter the product discount">
      <input type="text" class="box" name="product_image" value="<?php echo $row['product_name']; ?>" placeholder="enter the product image">
      <input type="number" min="0" class="box" name="product_category" value="<?php echo $row['category']; ?>" placeholder="enter the product category">
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