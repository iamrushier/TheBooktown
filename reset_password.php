<?php
include 'config.php'; // Include your database configuration file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate token format
    if (empty($token)) {
        $error = 'Invalid token.';
    } elseif (empty($password) || empty($confirm_password)) {
        $error = 'Please enter both password fields.';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        // Check if the token exists in the database and is not expired
        $check_token_query = $conn->prepare("SELECT * FROM password_reset_requests WHERE token = ? AND expiry_time >= ?");
        $current_time = time();
        $check_token_query->bindParam(1, $token, SQLITE3_TEXT);
        $check_token_query->bindParam(2, $current_time, SQLITE3_INTEGER);
        $result = $check_token_query->execute();

        if ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $user_email = $row['email'];

            // Update the user's password in the database
            $hashed_password = md5($password); // Using md5 hash for password storage
            $update_password_query = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update_password_query->bindParam(1, $hashed_password, SQLITE3_TEXT);
            $update_password_query->bindParam(2, $user_email, SQLITE3_TEXT);

            if ($update_password_query->execute()) {
                // Delete the token from the database after successful password update
                $delete_token_query = $conn->prepare("DELETE FROM password_reset_requests WHERE token = ?");
                $delete_token_query->bindParam(1, $token, SQLITE3_TEXT);
                $delete_token_query->execute();

                $success = 'Password reset successful. You can now <a href="login.php">login</a> with your new password.';
            } else {
                $error = 'Failed to update password. Please try again later.';
            }
        } else {
            $error = 'Invalid or expired token.';
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
   <title>Reset Password</title>
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
         <input type="password" name="password" placeholder="Enter New Password" required class="box">
         <input type="password" name="confirm_password" placeholder="Confirm New Password" required class="box">
         <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
         <input type="submit" name="submit" value="Reset Password" class="btn">
      </form>

   </div>

</body>

</html>
