<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];



if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:account.php');
   exit();
};

if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
 
    $select = " SELECT * FROM user WHERE email = '$email' && password = '$pass' ";
 
    $result = mysqli_query($conn, $select);
 
    if(mysqli_num_rows($result) > 0){
 
       $row = mysqli_fetch_array($result);
           $_SESSION['user_id'] = $row['id'];
           header('location:index.php'); //move to view product page
        
   }else{
       $error[] = 'Incorrect Email or Password!';
   }
 
 };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clotheez | Account</title>
    <link rel="stylesheet" href="css/login-style.css">
</head>
<body>
    <!-- -----------------------------------------Header Section -->
    <header>
    <a href="index.php"><h2 class="logo"><img src="./img/logo.png" width="150px" alt=""></h2></a>
        <nav class="navigation">
            <ul class="nav_links">
                <li><a href="index.php">Home</a></li>
                <li><a href="men.php">Men</a></li>
                <li><a href="women.php"class="">Women</a></li>
                <li><a href="kid.php">Kids</a></li>
            </ul>
        </nav>
        <div class="btn">
            <a class="" href="cart.php"><button>Cart</button></a>
            <a class="active" href=""><button>Account</button></a>
        </div>
    </header>
    <!-- -----------------------------------------Header Section -->
    <?php
$select_user = mysqli_query($conn, "SELECT * FROM `user` WHERE id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select_user) > 0){
   $fetch_user = mysqli_fetch_assoc($select_user);
      ?>
<div class="form-container">
        <div class="profile">
            <div class="profile-avatar">
                <img src="img/user-profile.png" alt="user">
            </div>
            <div class="profile-info">
                <p class="name"><span><?php echo $fetch_user['name']?></span></p>
                <p class="email"><?=$fetch_user['email']?></p>
            </div>
            <div class="btn">
                <a href="orders.php">
                <button class="btn-logout">My Orders</button>
                </a>
                <a href="account.php?logout=<?php echo $user_id?>">
                <button class="btn-logout">Logout</button>
                </a>
            </div>
        </div>
    </div>
      <?php
} else{
    ?>
<main>
   
   <div class="form-container">
      
      <form action="" method="post">
         <h3>Login Now</h3>
         <?php
            if(isset($error)){
               foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
               };
            };
         ?>
         <input type="email" name="email" required placeholder="Enter your email">
         <input type="password" name="password" required placeholder="Enter your password">
         <input type="submit" name="submit" value="login now" class="form-btn">
         <p>Don't have an account? <a href="register-form.php">Register now</a></p>
      </form>
   </div>
</main>
    <?php
}
      ?>



</body>
</html>