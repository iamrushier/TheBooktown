<?php

include 'config.php';

session_start();
$l = 0;
foreach ($_SESSION as $key => $val) {
   $l++;
}
$user_id = 0;
if ($l > 0) {
   $user_id = $_SESSION['user_id'];
}

if (isset($_POST['send'])) {
   if ($user_id == 0) {
        header('location:login.php');
        exit(); // Added exit to stop execution after redirection
    }
   $name = $_POST['name'];
   $email = $_POST['email'];
   $number = $_POST['number'];
   $msg = $_POST['message'];

   $select_message = $conn->prepare("SELECT * FROM message WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->bindParam(1, $name, SQLITE3_TEXT);
   $select_message->bindParam(2, $email, SQLITE3_TEXT);
   $select_message->bindParam(3, $number, SQLITE3_TEXT);
   $select_message->bindParam(4, $msg, SQLITE3_TEXT);
   $result = $select_message->execute();

   if ($result->fetchArray(SQLITE3_ASSOC)) {
      $message[] = 'Message sent already!';
   } else {
      $insert_message = $conn->prepare("INSERT INTO message (user_id, name, email, number, message) VALUES (?, ?, ?, ?, ?)");
      $insert_message->bindParam(1, $user_id, SQLITE3_INTEGER);
      $insert_message->bindParam(2, $name, SQLITE3_TEXT);
      $insert_message->bindParam(3, $email, SQLITE3_TEXT);
      $insert_message->bindParam(4, $number, SQLITE3_TEXT);
      $insert_message->bindParam(5, $msg, SQLITE3_TEXT);
      if ($insert_message->execute()) {
         $message[] = 'Message sent successfully!';
      } else {
         $message[] = 'Failed to send message!';
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
   <title>Contact</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/home-styles.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/contact.css">
   <link rel="stylesheet" href="css/shop.css">
   <link rel="stylesheet" href="css/about.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Contact Us</h3>
      <p> <a href="home.php">Home</a> / Contact </p>
   </div>

   <section class="contact">

      <form action="" method="post">
         <h3>Have any queries?</h3>
         <input type="text" name="name" required placeholder="Enter your name" class="box">
         <input type="email" name="email" required placeholder="Enter your email" class="box">
         <input type="number" name="number" required placeholder="Enter your number" class="box">
         <textarea name="message" class="box" placeholder="Enter your message" id="" cols="30" rows="10"></textarea>
         <input type="submit" value="Send message" name="send" class="messagebtn">
      </form>

   </section>

   <?php
   if (isset($message)) {
      foreach ($message as $msg) {
         echo "<p>$msg</p>";
      }
   }
   ?>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>