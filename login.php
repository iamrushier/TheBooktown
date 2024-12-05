<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {

   $email = $_POST['email'];
   $pass = md5($_POST['password']);

   $select_users = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
   $select_users->bindParam(1, $email, SQLITE3_TEXT);
   $select_users->bindParam(2, $pass, SQLITE3_TEXT);
   $result = $select_users->execute();

   if ($result) {
      $row = $result->fetchArray(SQLITE3_ASSOC);
      if ($row) {
         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:index.php');
         exit(); // Added exit to stop further execution after redirection
      } else {
         $message[] = 'Incorrect Email or Password!';
      }
   } else {
      $message[] = 'Query failed';
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/styles.css">
</head>

<body>
   <?php include 'header.php'; ?>
   <div class="form-container">

      <form action="" method="post" class="login-box">
         <div class='login-title'>
            <h3>User Login</h3>
            <p><a href="admin_login.php">Login as Admin</a></p>
         </div>
         <?php
         if (isset($message)) {
            foreach ($message as $msg) {
               echo '
			<div style="text-align:left;font-size:17px; color:red;margin-top:5px;margin-bottom:0px;">
				<span>' . $msg . '</span>
				<i class="fas fa-times" onclick="this.parentElement.remove();"></i>
			</div>
			';
            }
         }
         ?>
         <input type="email" name="email" placeholder="Enter your Email" required class="box">
         <input type="password" name="password" placeholder="Enter your Password" required class="box password">
         <div class="options">
            <div id='forgot-pass'><a href="forgot_password.php">Forgot password?</a>
            </div>
            <div id='new-user'>
               <span>New user?</span>
               <span><a href="register.php">Register here</a></span>
            </div>
         </div>
         <input type="submit" name="submit" value="Login Now" class="btn">

      </form>

   </div>

</body>

</html>