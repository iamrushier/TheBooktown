<?php
include 'config.php'; // Include your database configuration file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $email = $_POST['email'];

   // Validate email format
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = 'Invalid email format';
   } else {
      // Check if the email exists in the database
      $check_email_query = $conn->prepare("SELECT * FROM users WHERE email = ?");
      $check_email_query->bindParam(1, $email, SQLITE3_TEXT);
      $result = $check_email_query->execute();

      if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
         // Generate a unique token
         $token = bin2hex(random_bytes(32)); // Generate a 32-byte random token (64 characters in hex format)
         $token_expiry = time() + (60 * 60); // Token expiry time (1 hour from now)

         // Store the token and expiry time in the database
         $insert_token_query = $conn->prepare("INSERT INTO password_reset_requests (email, token, expiry_time) VALUES (?, ?, ?)");
         $insert_token_query->bindParam(1, $email, SQLITE3_TEXT);
         $insert_token_query->bindParam(2, $token, SQLITE3_TEXT);
         $insert_token_query->bindParam(3, $token_expiry, SQLITE3_INTEGER);
         $insert_token_query->execute();

         // Send reset password email using SendGrid API
         require 'vendor/autoload.php'; // Include SendGrid PHP library


         $email_api = require ('email-api.php');
         $emailAPIKey = $email_api['api_key'];
         
         $sendgrid = new SendGrid($emailAPIKey);

         $resetLink = 'http://localhost/TheBooktown/reset_password.php?token=' . $token;
         $to = $email;
         $subject = 'Reset Your Password';
         $message = 'Dear user,<br><br>Please click the link below to reset your password:<br><a href="' . $resetLink . '">Reset Password</a><br><br>If you did not request this, please ignore this email.<br><br>Best regards,<br>Your Website Team';
         $email = new SendGrid\Mail\Mail();
         $email->setFrom("rushikeshsurve193@gmail.com", "Rushikesh Surve");
         $email->setSubject($subject);
         $email->addTo($to);
         $email->addContent("text/html", $message);

         try {
            $response = $sendgrid->send($email);
            $success = 'An email has been sent with instructions to reset your password.';
         } catch (Exception $e) {
            $error = 'Error sending email: ' . $e->getMessage();
         }
      } else {
         $error = 'Email address not found.';
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
   <title>Forgot Password</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/styles.css">
</head>

<body>
   <div class="form-container">
      <form action="" method="post">
         <div class='login-title'>
            <h3>Reset Password</h3>
         </div>
         <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
         <?php } ?>
         <?php if (isset($success)) { ?>
            <div class="success"><?php echo $success; ?></div>
         <?php } ?>
         <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
         <?php } ?>
         <?php if (isset($success)) { ?>
            <div class="success"><?php echo $success; ?></div>
         <?php } ?>
         <input type="email" name="email" placeholder="Enter your Email" required class="box">
         <div style="text-align:right;">
            <p style="font-size:14px; margin-top:0px;padding-top:0px;"><a href="login.php">Back to Login</a></p>
         </div>
         <input type="submit" name="submit" value="Verify Email" class="btn">
      </form>
   </div>
</body>
</html>
