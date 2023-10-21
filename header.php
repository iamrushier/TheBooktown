<?php
if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

//added later
include 'config.php';
$l=0;
foreach ($_SESSION as $key => $val) {
   $l++;
}
$user_id=0;
if ($l > 0) {
   $user_id = $_SESSION['user_id'];
}
?>

<header class="header">
   <!--link rel="stylesheet" href="css/header.css"-->
   <div class="flex">
      <div class="logo">
         <a href="home.php" id="shop-name">The Booktown</a>
      </div>
      <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="about.php">About</a>
         <a href="shop.php">Shop</a>
         <a href="contact.php">Contact</a>
         <a href="orders.php">Orders</a>
      </nav>

      <div class="icons">
         <a href="search_page.php" class="fas fa-search"></a>
         <div id="user-btn" class="fas fa-user"></div>
         <?php
         $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         $cart_rows_number = mysqli_num_rows($select_cart_number);
         ?>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i>
            <span>(<?php echo $cart_rows_number;?>)
            </span>
         </a>
      </div>
      <div class="account-box" id="user-box">
         <div class="profile-photo">
            <img src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png"
               style="width:100%;height:100%;border-radius:100%" alt="">
         </div>
         <?php
         if ($user_id!=0) { ?>
            <p>Username :
               <span>
                  <?php echo $_SESSION['user_name']; ?>
               </span>
            </p>
            <p>Email :
               <span>
                  <?php echo $_SESSION['user_email']; ?>
               </span>
            </p>
            <a href="logout.php" class="delete-btn">Log out</a>
            <?php
         } else { ?>
            <p>You have not Logged in yet!</p>
            <span>
               <a href="login.php" class="option-btn">Log in</a>
               <a href="register.php" class="option-btn">Register</a>
            </span>
            <?php
         }
         ?>
      </div>
   </div>
</header>