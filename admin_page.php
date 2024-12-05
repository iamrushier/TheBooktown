<?php
include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
   header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Panel</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="dashboard">
      <h1 class="title">Dashboard</h1>
      <div class="box-container">
         <div class="box">

            <?php
            $total_pendings = 0;
            $stmt = $conn->prepare("SELECT total_price FROM orders WHERE payment_status = 'pending'");
            $result = $stmt->execute();
            while ($fetch_pendings = $result->fetchArray(SQLITE3_ASSOC)) {
               $total_price = $fetch_pendings['total_price'];
               $total_pendings += $total_price;
            }
            ?>

            <h3>$
               <?php echo $total_pendings; ?>/-
            </h3>
            <p>Total Pendings</p>
         </div>

         <div class="box">

            <?php
            $total_completed = 0;
            $stmt = $conn->prepare("SELECT total_price FROM orders WHERE payment_status = 'completed'");
            $result = $stmt->execute();
            while ($fetch_completed = $result->fetchArray(SQLITE3_ASSOC)) {
               $total_price = $fetch_completed['total_price'];
               $total_completed += $total_price;
            }
            ?>

            <h3>$
               <?php echo $total_completed; ?>/-
            </h3>
            <p>Completed Payments</p>
         </div>
         <div class="box">

            <?php
            $stmt = $conn->prepare("SELECT * FROM orders");
            $result = $stmt->execute();
            $number_of_orders = 0;
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
               $number_of_orders++;
            }
            ?>

            <h3>
               <?php echo $number_of_orders; ?>
            </h3>
            <p>Order Placed</p>
         </div>

         <div class="box">
            <?php
            $stmt = $conn->prepare("SELECT * FROM products");
            $result = $stmt->execute();
            $number_of_products = 0;
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
               $number_of_products++;
            }
            ?>

            <h3>
               <?php echo $number_of_products; ?>
            </h3>
            <p>Products Added</p>
         </div>

         <div class="box">
            <?php
            $stmt = $conn->prepare("SELECT * FROM users");
            $result = $stmt->execute();
            $number_of_users = 0;
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
               $number_of_users++;
            }
            ?>

            <h3>
               <?php echo $number_of_users; ?>
            </h3>
            <p>Users</p>
         </div>


         <div class="box">
            <?php
            $stmt = $conn->prepare("SELECT * FROM message");
            $result = $stmt->execute();
            $number_of_messages = 0;
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
               $number_of_messages++;
            }
            ?>
            <h3>
               <?php echo $number_of_messages; ?>
            </h3>
            <p>New Messages</p>
         </div>

      </div>
   </section>

   <script src="js/admin_script.js"></script>

</body>

</html>
