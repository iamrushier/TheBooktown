<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   
   $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
   $stmt->bindValue(1, $delete_id, SQLITE3_INTEGER);
   $result = $stmt->execute();

   header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Users</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="users">

      <h1 class="title"> User Accounts </h1>

      <div class="box-container">
         <?php
         $stmt = $conn->prepare("SELECT * FROM users");
         $result = $stmt->execute();
         while ($fetch_users = $result->fetchArray(SQLITE3_ASSOC)) {
            ?>
            <div class="box">
               <p> User id : <span>
                     <?php echo $fetch_users['id']; ?>
                  </span> </p>
               <p> Username : <span>
                     <?php echo $fetch_users['name']; ?>
                  </span> </p>
               <p> Email : <span>
                     <?php echo $fetch_users['email']; ?>
                  </span> </p>
               <a href="admin_users.php?delete=<?php echo $fetch_users['id']; ?>"
                  onclick="return confirm('Delete this user?');" class="delete-btn">Delete User</a>
            </div>
            <?php
         }
         ;
         ?>
      </div>

   </section>

   <script src="js/admin_script.js"></script>

</body>

</html>
