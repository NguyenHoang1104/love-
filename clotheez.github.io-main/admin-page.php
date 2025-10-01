<?php

@include 'config.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_discount = $_POST['product_discount'];
   $product_image = $_FILES['image']['name'];
   $category =$_POST['product_category'];
   $image_folder = 'img/Product/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'Please Fill Out All';
   }
   elseif($product_price <= 0 || $product_discount <= 0){
        $message[] = 'Please Enter Valid Input';
   }else{
      $insert = "INSERT INTO product(product_name, price, discount, product_image, category) VALUES('$product_name', '$product_price','$product_discount', '$image_folder', '$category')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM product WHERE product_id = $id");
   header('location:admin-page.php');
   $message[] = 'Product Deleted';
};

if(isset($_GET['ban'])){
   $id = $_GET['ban'];
   mysqli_query($conn, "DELETE FROM user WHERE id = $id");
   header('location:admin-page.php');
   $message[] = 'User Ban';
};

if(isset($_GET['remove'])){
   $id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM orders WHERE id = $id");
   header('location:admin-page.php');
   $message[] = 'Order removed';
};

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Clotheez | Admin</title>

   

   <!-- css file link  -->
   <link rel="stylesheet" href="css/admin-style.css">

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

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="Enter product name" name="product_name" class="box">
         <input type="number" placeholder="Enter product price" name="product_price" class="box">
         <input type="number" placeholder="Enter product discount price" name="product_discount" class="box">
         <input type="file" placeholder="Upload product Image" name="image" required accept="image/*" class="box">
         <select name="product_category" class="box" placeholder="Enter product category">
            <option value="">Enter product category</option>
            <option value="1">Men</option>
            <option value="2">Women</option>
            <option value="3">Kid</option>
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM product");
   
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Discount</th>
            <th>Product Image</th>
            <th>Product Category</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['price']; ?> LKR</td>
            <td><?php echo $row['discount']; ?> LKR</td>
            <td><?php echo $row['product_image']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td>
               <a href="admin-update.php?edit=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin-page.php?delete=<?php echo $row['product_id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>


      <!-- User Tabel -->
   <?php

   $select = mysqli_query($conn, "SELECT id, name, email FROM user");
   
   ?>
   <div class="product-display">
   <h1 class="title">User Table</h1>
      <table class="product-display-table">
         <thead>
         <tr>
            <th>User Id</th>
            <th>User Name</th>
            <th>Email</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
               <a href="admin-page.php?ban=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> Ban </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>
            <br>
      <!-- Order Tabel -->
      <?php

$order = mysqli_query($conn, "SELECT `id`, `user_id`, `name`, `number`, `email`, `address`,`method`, `product_id`, `price`, `qty`, `date`, `status` FROM `orders`");

?>
<div class="product-display">
<h1 class="title">User Table</h1>
   <table class="product-display-table">
      <thead>
      <tr>
         <th>Order ID</th>
         <th>Name</th>
         <th>TP</th>
         <th>Email</th>
         <th>Address</th>
         <th>Method</th>
         <th>Price</th>
         <th>QT</th>
         <th>Date</th>
         <th>Status</th>
         <th>action</th>
      </tr>
      </thead>
      <?php while($row = mysqli_fetch_assoc($order)){ ?>
      <tr>
         <td><?php echo $row['id']; ?></td>
         <td><?php echo $row['name']; ?></td>
         <td><?php echo $row['number']; ?></td>
         <td><?php echo $row['email']; ?></td>
         <td><?php echo $row['address']; ?></td>
         <td><?php echo $row['method']; ?></td>
         <td><?php echo $row['price']; ?></td>
         <td><?php echo $row['qty']; ?></td>
         <td><?php echo $row['date']; ?></td>
         <td><?php echo $row['status']; ?></td>
         <td>
            <a href="admin-update-order.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> Edit </a>
            <a href="admin-page.php?remove=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> Remove </a>
         </td>
      </tr>
   <?php } ?>
   </table>
</div>

</div>

<footer>
<div class="footer-bottom">
            <div class="container">
               <p><a href="index.php">Back to Home</a></p>
                <p class="copyright">
                    Copyright &copy; <a href="admin-login.php">Clotheez</a> | All rights reserved.
                </p>
            </div>
        </div>
</footer>

</body>
</html>