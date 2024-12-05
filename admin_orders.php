<?php
include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
   header('location:login.php');
}
if (isset($_POST['update_order'])) {
   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   
   $stmt = $conn->prepare("UPDATE orders SET payment_status = ? WHERE id = ?");
   $stmt->bindValue(1, $update_payment, SQLITE3_TEXT);
   $stmt->bindValue(2, $order_update_id, SQLITE3_INTEGER);
   $result = $stmt->execute();

   $message[] = 'Payment status has been updated!';
}
if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   
   $stmt = $conn->prepare("DELETE FROM orders WHERE id = ?");
   $stmt->bindValue(1, $delete_id, SQLITE3_INTEGER);
   $result = $stmt->execute();

   header('location:admin_orders.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="orders">
      <h1 class="title">Placed orders</h1>
      <div class="box-container">
         <?php
         $stmt = $conn->prepare("SELECT * FROM orders");
         $result = $stmt->execute();
         while ($fetch_orders = $result->fetchArray(SQLITE3_ASSOC)) {
            ?>

            <div class="box">
               <p> User id : <span>
                     <?php echo $fetch_orders['user_id']; ?>
                  </span> </p>
               <p> Placed on : <span>
                     <?php echo $fetch_orders['placed_on']; ?>
                  </span> </p>
               <p> Name : <span>
                     <?php echo $fetch_orders['name']; ?>
                  </span> </p>
               <p> Number : <span>
                     <?php echo $fetch_orders['number']; ?>
                  </span> </p>
               <p> Email : <span>
                     <?php echo $fetch_orders['email']; ?>
                  </span> </p>
               <p> Address : <span>
                     <?php echo $fetch_orders['address']; ?>
                  </span> </p>
               <p> Total products : <span>
                     <?php echo $fetch_orders['total_products']; ?>
                  </span> </p>
               <p> Total price : <span>$
                     <?php echo $fetch_orders['total_price']; ?>/-
                  </span> </p>
               <p> Payment method : <span>
                     <?php echo $fetch_orders['method']; ?>
                  </span> </p>
               <form action="" method="post">
                  <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                  <select name="update_payment">
                     <option value="" selected disabled>
                        <?php echo $fetch_orders['payment_status']; ?>
                     </option>
                     <option value="pending">Pending</option>
                     <option value="completed">Completed</option>
                  </select>
                  <input type="submit" value="update" name="update_order" class="option-btn">
                  <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>"
                     onclick="return confirm('Delete this order?');" class="delete-btn">Delete</a>
               </form>
            </div>
            <?php
         }
         ?>

      </div>
   </section>

   <script src="js/admin_script.js"></script>
</body>

</html>
