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
}

if (isset($_POST['update_cart'])) {
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   $update_cart = $conn->prepare("UPDATE cart SET quantity = :cart_quantity WHERE id = :cart_id");
   $update_cart->bindParam(':cart_quantity', $cart_quantity, SQLITE3_INTEGER);
   $update_cart->bindParam(':cart_id', $cart_id, SQLITE3_INTEGER);
   $result = $update_cart->execute();
   if ($result) {
      $message[] = 'Cart quantity updated!';
   } else {
      $message[] = 'Failed to update cart quantity';
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_cart = $conn->prepare("DELETE FROM cart WHERE id = :delete_id");
   $delete_cart->bindParam(':delete_id', $delete_id, SQLITE3_INTEGER);
   $result = $delete_cart->execute();
   if ($result) {
      header('location:cart.php');
      exit();
   } else {
      $message[] = 'Failed to delete item from cart';
   }
}

if (isset($_GET['delete_all'])) {
   $delete_all = $conn->prepare("DELETE FROM cart WHERE user_id = :user_id");
   $delete_all->bindParam(':user_id', $user_id, SQLITE3_INTEGER);
   $result = $delete_all->execute();
   if ($result) {
      header('location:cart.php');
      exit();
   } else {
      $message[] = 'Failed to delete all items from cart';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

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

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Shopping Cart</h3>
      <p> <a href="index.php">Home</a> / Cart </p>
   </div>

   <section class="shopping-cart">

      <h1 class="title">Products Added</h1>

      <div class="box-container">
         <?php
         $grand_total = 0;
         $select_cart = $conn->prepare("SELECT * FROM cart WHERE user_id = :user_id");
         $select_cart->bindParam(':user_id', $user_id, SQLITE3_INTEGER);
         $result = $select_cart->execute();
         if ($result) {
            while ($fetch_cart = $result->fetchArray(SQLITE3_ASSOC)) {
               ?>
               <div class="box">
                  <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times"
                     onclick="return confirm('Delete this from cart?');"></a>
                  <img src="images/<?php echo $fetch_cart['image']; ?>" alt="">
                  <div class="name">
                     <?php echo $fetch_cart['name']; ?>
                  </div>
                  <div class="price">₹
                     <?php echo $fetch_cart['price']; ?>/-
                  </div>
                  <form action="" method="post">
                     <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                     <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                     <input type="submit" name="update_cart" value="update" class="option-btn">
                  </form>
                  <div class="sub-total">Product Total : <span>₹
                        <?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?>/-
                     </span> </div>
               </div>
               <?php
               $grand_total += $sub_total;
            }
         } else {
            echo '<p class="empty">Your cart is empty</p>';
         }
         ?>
      </div>

      <div style="margin-top: 2rem; text-align:center;">
         <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>"
            onclick="return confirm('Delete all from cart?');">Delete all</a>
      </div>

      <div class="cart-total">
         <p>Grand Total : <span>₹
               <?php echo $grand_total; ?>/-
            </span>
         </p>
         <div class="flex" id="checkout-box">
            <a href="shop.php" class="btn">Continue Shopping</a>
            <a href="checkout.php" class="btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to
               Checkout</a>
         </div>
      </div>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>