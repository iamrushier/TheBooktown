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
if ($user_id == 0) {
   header('location:login.php');
   exit(); // Added exit to stop execution after redirection
}
if (isset($_POST['order_btn'])) {
   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $address = 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code'];
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products = [];
   $cart_query = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
   $cart_query->bindParam(1, $user_id, SQLITE3_INTEGER);
   $result = $cart_query->execute();

   if ($result) {
      while ($cart_item = $result->fetchArray(SQLITE3_ASSOC)) {
         $cart_products[] = $cart_item['name'] . ' (' . $cart_item['quantity'] . ') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM orders WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ?");
   $order_query->bindParam(1, $name, SQLITE3_TEXT);
   $order_query->bindParam(2, $number, SQLITE3_TEXT);
   $order_query->bindParam(3, $email, SQLITE3_TEXT);
   $order_query->bindParam(4, $method, SQLITE3_TEXT);
   $order_query->bindParam(5, $address, SQLITE3_TEXT);
   $order_query->bindParam(6, $total_products, SQLITE3_TEXT);
   $order_query->bindParam(7, $cart_total, SQLITE3_INTEGER);
   $result = $order_query->execute();

   if ($cart_total == 0) {
      $message[] = 'Your cart is empty';
   } else {
      if ($result && $result->fetchArray(SQLITE3_ASSOC)) {
         $message[] = 'Order already placed!';
      } else {
         $insert_order = $conn->prepare("INSERT INTO orders(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
         $insert_order->bindParam(1, $user_id, SQLITE3_INTEGER);
         $insert_order->bindParam(2, $name, SQLITE3_TEXT);
         $insert_order->bindParam(3, $number, SQLITE3_TEXT);
         $insert_order->bindParam(4, $email, SQLITE3_TEXT);
         $insert_order->bindParam(5, $method, SQLITE3_TEXT);
         $insert_order->bindParam(6, $address, SQLITE3_TEXT);
         $insert_order->bindParam(7, $total_products, SQLITE3_TEXT);
         $insert_order->bindParam(8, $cart_total, SQLITE3_INTEGER);
         $insert_order->bindParam(9, $placed_on, SQLITE3_TEXT);
         if ($insert_order->execute()) {
            $message[] = 'Order Placed Successfully!';
            $delete_cart = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
            $delete_cart->bindParam(1, $user_id, SQLITE3_INTEGER);
            $delete_cart->execute();
         } else {
            $message[] = 'Failed to place order';
         }
      }
   }
   header('Location: orders.php');
   exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/home-styles.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/contact.css">
   <link rel="stylesheet" href="css/shop.css">
   <link rel="stylesheet" href="css/about.css">
   <link rel="stylesheet" href="css/orders.css">
   <link rel="stylesheet" href="css/search-page.css">
   <link rel="stylesheet" href="css/cart.css">
   <link rel="stylesheet" href="css/checkout.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Checkout</h3>
      <p> <a href="home.php">Home</a> / Checkout </p>
   </div>

   <section class="display-order">

      <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
      $select_cart->bindParam(1, $user_id, SQLITE3_INTEGER);
      $result = $select_cart->execute();

      if ($result) {
         while ($fetch_cart = $result->fetchArray(SQLITE3_ASSOC)) {
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
            ?>
            <p>
               <?php echo $fetch_cart['name']; ?> <span>(
                  <?php echo $fetch_cart['quantity'] . ' x ' . '₹' . $fetch_cart['price'] . '/-'; ?>)
               </span>
            </p>
            <?php
         }
      } else {
         echo '<p class="empty">Your cart is empty</p>';
      }
      ?>
      <div class="grand-total"> Grand total : <span>₹
            <?php echo $grand_total; ?>/-
         </span> </div>

   </section>

   <section class="checkout">

      <form action="" method="post">
         <h3>Place Your Order</h3>
         <div class="flex">
            <div class="inputBox">
               <span>Your Name :</span>
               <input type="text" name="name" required placeholder="Enter your name">
            </div>
            <div class="inputBox">
               <span>Phone Number :</span>
               <input type="number" name="number" required placeholder="Enter your number">
            </div>
            <div class="inputBox">
               <span>Your Email :</span>
               <input type="email" name="email" required placeholder="Enter your email">
            </div>
            <div class="inputBox">
               <span>Payment Method :</span>
               <select name="method">
                  <option value="Cash on delivery">Cash on Delivery</option>
                  <option value="Credit card">Credit Card</option>
                  <option value="Paypal">Paypal</option>
                  <option value="Paytm">UPI</option>
               </select>
            </div>
            <div class="inputBox">
               <span>Address Line 1 :</span>
               <input type="text" min="0" name="flat" required placeholder="e.g. Flat no.">
            </div>
            <div class="inputBox">
               <span>Address line 2 :</span>
               <input type="text" name="street" placeholder="e.g. Street Name">
            </div>
            <div class="inputBox">
               <span>City :</span>
               <input type="text" name="city" required placeholder="e.g. Ratnagiri">
            </div>
            <div class="inputBox">
               <span>State :</span>
               <input type="text" name="state" required placeholder="e.g. Maharashtra">
            </div>
            <div class="inputBox">
               <span>Country :</span>
               <input type="text" name="country" required placeholder="e.g. India">
            </div>
            <div class="inputBox">
               <span>Pin Code :</span>
               <input type="text" name="pin_code" pattern="[0-9]{6}" required placeholder="e.g. 123456">
            </div>

         </div>
         <div class="center-solo"><input type="submit" value="Order Now" class="btn" name="order_btn"></div>
      </form>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>