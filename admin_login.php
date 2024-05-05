<?php
include 'config.php';
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $pass);
    $result = $stmt->execute();

    $row = $result->fetchArray(SQLITE3_ASSOC);
    if ($row) {
        $_SESSION['admin_name'] = $row['name'];
        $_SESSION['admin_email'] = $row['email'];
        $_SESSION['admin_id'] = $row['id'];
        header('location:admin_page.php');
    } else {
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

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
