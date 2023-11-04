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

if (isset($_POST['add_to_cart'])) {
    if ($user_id == 0) {
        header('location:login.php');
    } else {
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
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM `products` WHERE id = '$product_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $fetch_products = mysqli_fetch_assoc($result);
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>
                <?php echo $fetch_products['name']; ?> - Product Details
            </title>
            <!-- Add your CSS links here -->
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
            <link rel="stylesheet" href="css/selected_product.css">
        </head>

        <body>
            <?php include 'header.php'; ?>

            <div class="product-details">
                <div class="left-div">
                    <h1>
                        <?php echo $fetch_products['name']; ?>
                    </h1>
                    <p>Author:
                        <?php echo $fetch_products['author']; ?>
                    </p>
                    <p>Description:
                        <?php echo $fetch_products['description']; ?>
                    </p>
                    <p>Price: ₹
                        <?php echo $fetch_products['price']; ?>/-
                    </p>
                </div>
                <div class="right-div">
                    <img src="images/<?php echo $fetch_products['image']; ?>" alt="<?php echo $fetch_products['name']; ?>"
                        class="product-image">
                    <form action="" method="post">
                        <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
                        <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                        <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
                        <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
                        <button type="submit" name="add_to_cart" class="btn" id="add-to-cart-btn">Add to Cart</button>
                    </form>
                </div>
            </div>

            <?php include 'footer.php'; ?>

            <script src="js/script.js"></script>
        </body>

        </html>
        <?php
    } else {
        echo 'Product not found';
    }
} else {
    echo 'Invalid product ID';
}
?>