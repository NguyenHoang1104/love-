<?php

include 'config.php';
$error = array();

if(isset($_POST['submit'])){

   // Validate name
   if(empty($_POST['name'])){
      $error[] = 'Name is require';
   } else if(!preg_match('/^[a-zA-Z ]*$/', $_POST['name'])){
      $error[] = 'Name can only contain letters';
   } else if(strlen($_POST['name']) > 99){
      $error[] = 'Name is too long';
   } else {
      unset($error);
      $name = mysqli_real_escape_string($conn, $_POST['name']);
   }

   // Validate Email
   if(empty($_POST['email'])){
      $error[] = 'Email is required';
   } else {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
   }

   // Validate Password
   if(empty($_POST['password'])){
      $error[] = 'Password is required';
   } else if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', $_POST['password'])){
      $error[] = 'Invalid Password';
   } else if ($_POST['password'] !== $_POST['cpassword']){
      $error[] = 'Passwords do not match';
   }
   else {
      $pass = md5($_POST['password']);
      $cpass = md5($_POST['cpassword']);
   }

   // Check if email alredy exists
   $query = "SELECT * FROM user WHERE email = '$email'";
   $result = mysqli_query($conn, $query);
   if(mysqli_num_rows($result) > 0){
      $error[] = 'Email alredy exists';
   }

   // Insert user into Database
   if(empty($error)){
      $insert = "INSERT INTO user(name, email, password) VALUES('$name','$email','$pass')";
      mysqli_query($conn, $insert);
      header('location:login.php');
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/login-style.css">
   <link rel="stylesheet" href="./css/style.css">

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
            <a  href="cart.php"><button>Cart</button></a>
            <a class="active" href=""><button>Login</button></a>
        </div>
    </header>
    <!-- -----------------------------------------Header Section -->
   
<div class="form-container">

   <form action="register_form.php" method="post">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="Enter your name">
      <input type="email" name="email" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>Already have an account? <a href="account.php">Login here</a></p>
   </form>

</div>

</body>
</html>