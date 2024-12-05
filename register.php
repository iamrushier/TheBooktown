<?php

include 'config.php';

if (isset($_POST['submit'])) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_users->bindParam(1, $email, SQLITE3_TEXT);
   $select_users->bindParam(2, $pass, SQLITE3_TEXT);
   $result = $select_users->execute();

   if ($result->fetchArray(SQLITE3_ASSOC)) {
      $message[] = 'User Already Exists!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'Passwords Do Not Match!';
      } else {
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?, ?, ?)");
         $insert_user->bindParam(1, $name, SQLITE3_TEXT);
         $insert_user->bindParam(2, $email, SQLITE3_TEXT);
         $insert_user->bindParam(3, $cpass, SQLITE3_TEXT);

         if ($insert_user->execute()) {
            $message[] = 'Registered Successfully!';
            header('location:login.php');
            exit(); // Added to stop execution after redirection
         } else {
            $message[] = 'Failed to register user!';
         }
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
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="stylesheet" href="css/header.css">

</head>

<body>
   <?php include 'header.php'; ?>
   <?php
   if (isset($message)) {
      foreach ($message as $msg) {
         echo '
         <div class="message">
            <span>' . $msg . '</span>
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
