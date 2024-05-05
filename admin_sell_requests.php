<?php
include 'config.php';
session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['update_request_status'])) {
    $request_id = $_POST['request_id'];
    $new_status = $_POST['new_status'];

    $stmt = $conn->prepare("UPDATE sell_requests SET request_status = ? WHERE request_id = ?");
    $stmt->bindValue(1, $new_status, SQLITE3_TEXT);
    $stmt->bindValue(2, $request_id, SQLITE3_INTEGER);
    $result = $stmt->execute();

    if ($new_status == "approved") {
        $get_data = $conn->query("SELECT * FROM sell_requests WHERE request_id = $request_id");
        $fetched_data = $get_data->fetchArray(SQLITE3_ASSOC);
        $name = $fetched_data['name'];
        $price = $fetched_data['price'];
        $description = $fetched_data['description'];
        $image = $fetched_data['image'];
        $author = $fetched_data['author'];
        $add_product_query = $conn->exec("INSERT INTO products(name, price, image, author, description) VALUES('$name', '$price', '$image', '$author', '$description')");
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $conn->exec("DELETE FROM sell_requests WHERE request_id = $delete_id");
    header('location:admin_sell_requests.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Requests</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/admin_style.css">
    <link rel="stylesheet" href="css/admin_sell_request.css">
</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="sell-requests">
        <h1 class="title">Sell Requests</h1>
        <div class="request-box-container">
            <?php
            $select_requests = $conn->query("SELECT * FROM sell_requests");
            while ($fetch_requests = $select_requests->fetchArray(SQLITE3_ASSOC)) {
                ?>
                <div class="small-box">
                    <p> Request ID: <span>
                            <?php echo $fetch_requests['request_id']; ?>
                        </span> </p>
                    <p> User ID: <span>
                            <?php echo $fetch_requests['user_id']; ?>
                        </span> </p>
                    <p> Name: <span>
                            <?php echo $fetch_requests['name']; ?>
                        </span> </p>
                    <p> <img src="images/<?php echo $fetch_requests['image']; ?>">
                        </img>
                    </p>
                    <p> Price: <span>$
                            <?php echo $fetch_requests['price']; ?>/-
                        </span> </p>
                    <p> Author: <span>
                            <?php echo $fetch_requests['author']; ?>
                        </span> </p>
                    <p> Description: <span>
                            <?php echo $fetch_requests['description']; ?>
                        </span> </p>
                    <form action="" method="post">
                        <input type="hidden" name="request_id" value="<?php echo $fetch_requests['request_id']; ?>">
                        <select name="new_status" style="height:40px;">
                            <option value="" selected disabled>
                                <?php echo $fetch_requests['request_status']; ?>
                            </option>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                        </select>
                        <input type="submit" value="Update" name="update_request_status" class="option-btn">
                        <div style="width:100%;text-align:center;" class="delete-btn"><a
                                href="admin_sell_requests.php?delete=<?php echo $fetch_requests['request_id']; ?>"
                                onclick="return confirm('Delete this request?');">Delete</a></div>
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
