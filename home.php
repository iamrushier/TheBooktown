<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
} // Auto redirect to login page if not signed in

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if (mysqli_num_rows($check_cart_numbers) > 0) {
      $message[] = 'Already added to cart!';
   } else {
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '1', '$product_image')") or die('query failed');
      $message[] = 'Product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/home-styles.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/header.css">
</head>

<body>

   <?php include 'header.php'; ?>

   <section class="home">

      <div class="content">
         <h3>Hand Picked Books to your door.</h3>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, quod? Reiciendis ut porro iste totam.
         </p>
         <a href="about.php" class="white-btn">discover more</a>
      </div>

   </section>

   <section class="products">

      <h1 class="title">Latest Products</h1>

      <div class="box-container">

         <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 6") or die('query failed');
         if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
               ?>
               <form action="" method="post" class="product-card">
                  <div class="product-image">
                     <img src="images/<?php echo $fetch_products['image']; ?>" alt="<?php echo $fetch_products['name']; ?>">
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
                        <!-- Add your rating system here (e.g., stars, user reviews) -->
                        <!-- Example: <span class="star"></span> -->
                     </div>
                  </div>
                  <div class="product-action">
                     <span class="product-price">$
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

      <div class="load-more" style="margin-top: 2rem; text-align:center">
         <a href="shop.php" class="option-btn">Load More..</a>
      </div>

   </section>

   <section class="about">

      <div class="flex">

         <div class="image">
            <img src="images/about-img.jpg" alt="">
         </div>

         <div class="content">
            <h3>About Us</h3>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit quos enim minima ipsa dicta officia
               corporis ratione saepe sed adipisci?</p>
            <a href="about.php" class="btn">Read More</a>
         </div>

      </div>

   </section>

   <section class="home-contact">

      <div class="content">
         <h3>Have Any Questions?</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque cumque exercitationem repellendus, amet
            ullam voluptatibus?</p>
         <a href="contact.php" class="white-btn">Contact Us</a>
      </div>

   </section>





   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>