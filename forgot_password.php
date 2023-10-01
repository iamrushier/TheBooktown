<?php
//PHP Code here
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Forgot Password</title>
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/styles.css">
</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <div class='login-title'>
         <h3>Reset Password</h3>
      </div>
      <input type="email" name="email" placeholder="Enter your Email" required class="box">
         <div style="text-align:right;">
            <p style="font-size:14px; margin-top:0px;padding-top:0px;"><a href="login.php">Back to Login</a></p>
         </div>
      <input type="submit" name="submit" value="Verify Email" class="btn">
   </form>

</div>

</body>
</html>