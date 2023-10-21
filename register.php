<?php

include 'config.php';

if (isset($_POST['submit'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $message[] = 'User Already Exists!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'Passwords Do Not Match!';
      } else {
         mysqli_query($conn, "INSERT INTO `users`(name, email, password) VALUES('$name', '$email', '$cpass')") or die('query failed');
         $message[] = 'Registered Successfully!';
         header('location:login.php');
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
   <title>Register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/header.css">

</head>

<body>
<?php include 'header.php'; ?>
   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <div class="form-container">

      <form action="" method="post">
         <h3>Register Now</h3>
         <input type="text" name="name" placeholder="Enter Your Name" required class="box">
         <input type="email" name="email" placeholder="Enter Your Email" required class="box">
         <input type="password" name="password" placeholder="Enter Password" required class="box">
         <input type="password" name="cpassword" placeholder="Confirm Password" required class="box">

         <input type="submit" name="submit" value="register now" class="btn">
         <p>Already Registered? <a href="login.php">Login Now</a></p>
      </form>

   </div>

</body>

</html>