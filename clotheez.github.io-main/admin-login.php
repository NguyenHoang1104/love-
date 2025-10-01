<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $pass = $_POST['password'];

   $select = " SELECT * FROM db_admin WHERE name = '$name' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);
          header('location:admin-page.php');
       
  }else{
      $error[] = 'incorrect email or password!';
  }

};
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Clotheez | Admin Panel</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="./css/login-style.css">

</head>
<body>
   <!-- -----------------------------------------Header Section -->
   <header>
        <a href="index.php"><h2 class="logo"><img src="./img/logo.png" width="150px" alt=""></h2></a>
    </header>
    <!-- -----------------------------------------Header Section -->
<main>
   
   <div class="form-container">
      
      <form action="admin-login.php" method="post">
         <h3>Admin Login</h3>
         <?php
            if(isset($error)){
               foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
               };
            };
         ?>
         <input type="text" name="name" required placeholder="Enter your name">
         <input type="password" name="password" required placeholder="Enter your password">
         <input type="submit" name="submit" value="login now" class="form-btn">
      </form>
   </div>
</main>


</body>
</html>