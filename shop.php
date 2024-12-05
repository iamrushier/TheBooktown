<?php

include 'config.php';
session_start();
$l = count($_SESSION);
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

if (isset($_POST['add_to_cart'])) {
   if ($user_id == 0) {
      header('location:login.php');
      exit(); // Added to stop execution after redirection
   } else {
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];

      $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->bindParam(1, $product_name, SQLITE3_TEXT);
      $check_cart_numbers->bindParam(2, $user_id, SQLITE3_INTEGER);
      $result = $check_cart_numbers->execute();

      if ($result->fetchArray(SQLITE3_ASSOC)) {
         $message[] = 'Already added to cart!';
      } else {
         $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES(?, ?, ?, '1', ?)");
         $insert_cart->bindParam(1, $user_id, SQLITE3_INTEGER);
         $insert_cart->bindParam(2, $product_name, SQLITE3_TEXT);
         $insert_cart->bindParam(3, $product_price, SQLITE3_INTEGER);
         $insert_cart->bindParam(4, $product_image, SQLITE3_TEXT);
         if ($insert_cart->execute()) {
            $message[] = 'Product added to cart!';
         } else {
            $message[] = 'Failed to add product to cart!';
         }
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
   <title>Shop</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home-styles.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/about.css">
   <link rel="stylesheet" href="css/shop.css">

</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>Our Shop</h3>
      <p> <a href="index.php">Home</a> / Shop </p>
   </div>

   <section class="products">

      <h1 class="title">All Books</h1>

      <div class="box-container">

         <?php
         $select_products = $conn->query("SELECT * FROM `products`");
         if ($select_products) {
            while ($fetch_products = $select_products->fetchArray(SQLITE3_ASSOC)) {
               ?>
               <form action="" method="post" class="product-card">

                  <div class="product-image">
                     <a href="selected_product.php?id=<?php echo $fetch_products['id']; ?>">
                        <img src="images/<?php echo $fetch_products['image']; ?>"
                           alt="<?php echo $fetch_products['name']; ?>">
                     </a>
                  </div>
                  <div class="product-details">
                     <h2 class="product-name">
                        <?php echo $fetch_products['name']; ?>
                     </h2>
                     <p id="product-author">By
                        <?php echo $fetch_products['author']; ?>
                     </p>
                     <p class="product-description">
                        <?php echo $fetch_products['description']; ?>
                     </p>
                     <div class="product-rating">
                     </div>
                  </div>
                  <div class="product-action">
                     <span class="product-price">₹
                        <?php echo $fetch_products['price']; ?>/-
                     </span>
                     <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                     <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                     <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                     <button type="submit" name="add_to_cart" class="btn" id="add-to-cart-btn">Add to Cart</button>
                  </div>
               </form>
               <?php
            }
         } else {
            echo '<p class="empty">No products added yet!</p>';
         }
         ?>
      </div>

   </section>

   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>
