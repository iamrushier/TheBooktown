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

if (isset($_POST['send_request'])) {
    if ($user_id == 0) {
        header('location:login.php');
    }

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $author= mysqli_real_escape_string($conn,$_POST['author']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/' . $image;


    $insert_query = "INSERT INTO sell_requests (user_id, name, price,author, description, image) VALUES ('$user_id', '$name', '$price', '$author','$description', '$image')";

    if (mysqli_query($conn, $insert_query)) {
        // Upload the image to a folder
        move_uploaded_file($image_tmp_name, $image_folder);
        $message = 'Sell request sent successfully!';
    } else {
        $message = 'Error: Unable to send sell request. Please try again.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/home-styles.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/shop.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/sell_request.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <section class="sell-request">
        <h1>Sell Request</h1>
        <?php if (isset($message)) { ?>
            <p>
                <?php echo $message; ?>
            </p>
        <?php } ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="name" class="box" placeholder="Enter book name" required>
            <input type="number" min="0" name="price" class="box" placeholder="Enter book price" required>
            <input type="text" name="author" class="box" placeholder="Enter author name" required>
            <input type="text" name="description" class="box" placeholder="Enter book description" required>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
            <input type="submit" value="Send Request" name="send_request" class="btn">
        </form>
    </section>

    <div style="font-size:20px; font-weight:bold; text-align: center;">My requests:</div>
    <div class="box-container">
        <?php
        $request_query = mysqli_query($conn, "SELECT * FROM `sell_requests` WHERE user_id = '$user_id'") or die('query failed');
        if (mysqli_num_rows($request_query) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($request_query)) {
                ?>
                <div class="box">
                    <p> Book name : <span>
                            <?php echo $fetch_orders['name']; ?>
                        </span>
                    </p>
                    <p> <img src="images/<?php echo $fetch_orders['image']; ?>">
                        </img>
                    </p>
                    <p> Price : <span>
                            <?php echo $fetch_orders['price']; ?>
                        </span> </p>
                    <p> Author : <span>
                            <?php echo $fetch_orders['author']; ?>
                        </span> </p>
                    <p> description : <span>
                            <?php echo $fetch_orders['description']; ?>
                        </span> </p>

                    <p> Request Status :
                        <span style="color:<?php if ($fetch_orders['request_status'] == 'pending') {
                            echo 'red';
                        } else {
                            echo 'green';
                        } ?>;">
                            <?php echo $fetch_orders['request_status']; ?>
                        </span>
                    </p>
                </div>
                <?php
            }
        } else {
            echo '<p class="empty">No orders placed yet!</p>';
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>