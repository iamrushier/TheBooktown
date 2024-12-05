<?php

include 'config.php';
session_start();
$l = count($_SESSION);
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
if ($user_id == 0) {
    header('location:login.php');
    exit(); // Added to stop execution after redirection
    
}
$message = [];

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
    $check_cart_numbers->bindParam(1, $product_name, SQLITE3_TEXT);
    $check_cart_numbers->bindParam(2, $user_id, SQLITE3_INTEGER);
    $result = $check_cart_numbers->execute();

    if ($result && $result->fetchArray(SQLITE3_ASSOC)) {
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

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = "SELECT * FROM `products` WHERE id = ?";
    $select_product = $conn->prepare($query);
    $select_product->bindParam(1, $product_id, SQLITE3_INTEGER);
    $result = $select_product->execute();

    $fetch_products = $result->fetchArray(SQLITE3_ASSOC);
    if ($result && $fetch_products) {
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