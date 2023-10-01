<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select_users = mysqli_query($conn, "SELECT * FROM `admin` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $row = mysqli_fetch_assoc($select_users);
         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');
   }else{
      $message[] = 'Incorrect Email or Password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Login</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post" class="login-box">
      <div class='login-title'>
         <h3>Admin Login</h3>
         <p><a href="login.php">Login as User</a></p>
      </div>
      <input type="email" name="email" placeholder="Enter your Email" required class="box">
      <input type="password" name="password" placeholder="Enter your Password" required class="box password">
      <div class="options">
         <div id='forgot-pass'><a href="forgot_password.php">Forgot password?</a>
         </div>
      </div>
      <input type="submit" name="submit" value="Login Now" class="btn">
   </form>

</div>

</body>
</html>