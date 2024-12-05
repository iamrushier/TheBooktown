<?php
include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_POST['add_product'])) {
   $name = $_POST['name'];
   $price = $_POST['price'];
   $author = $_POST['author'];
   $description = $_POST['description'];
   $description = str_replace("'", "\\'", $description);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'images/' . $image;

   $stmt = $conn->prepare("SELECT name FROM products WHERE name = ?");
   $stmt->bindValue(1, $name, SQLITE3_TEXT);
   $result = $stmt->execute();

   if ($result->fetchArray(SQLITE3_ASSOC)) {
      $message[] = 'Product name already added';
   } else {
      $stmt = $conn->prepare("INSERT INTO products(name, price, image, author, description) VALUES(?, ?, ?, ?, ?)");
      $stmt->bindValue(1, $name, SQLITE3_TEXT);
      $stmt->bindValue(2, $price, SQLITE3_INTEGER);
      $stmt->bindValue(3, $image, SQLITE3_TEXT);
      $stmt->bindValue(4, $author, SQLITE3_TEXT);
      $stmt->bindValue(5, $description, SQLITE3_TEXT);
      $result = $stmt->execute();

      if ($result) {
         if ($image_size > 2000000) {
            $message[] = 'Image size is too large';
         } else {
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Product added successfully!';
         }
      } else {
         $message[] = 'Product could not be added!';
      }
   }
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
   $stmt->bindValue(1, $delete_id, SQLITE3_INTEGER);
   $result = $stmt->execute();
   $fetch_delete_image = $result->fetchArray(SQLITE3_ASSOC);
   unlink('images/' . $fetch_delete_image['image']);
   
   $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
   $stmt->bindValue(1, $delete_id, SQLITE3_INTEGER);
   $result = $stmt->execute();

   header('location:admin_products.php');
}

if (isset($_POST['update_product'])) {
   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   $stmt = $conn->prepare("UPDATE products SET name = ?, price = ? WHERE id = ?");
   $stmt->bindValue(1, $update_name, SQLITE3_TEXT);
   $stmt->bindValue(2, $update_price, SQLITE3_INTEGER);
   $stmt->bindValue(3, $update_p_id, SQLITE3_INTEGER);
   $result = $stmt->execute();

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'images/' . $update_image;
   $update_old_image = $_POST['update_old_image'];

   if (!empty($update_image)) {
      if ($update_image_size > 2000000) {
         $message[] = 'Image file size is too large';
      } else {
         $stmt = $conn->prepare("UPDATE products SET image = ? WHERE id = ?");
         $stmt->bindValue(1, $update_image, SQLITE3_TEXT);
         $stmt->bindValue(2, $update_p_id, SQLITE3_INTEGER);
         $result = $stmt->execute();

         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('images/' . $update_old_image);
      }
   }

   header('location:admin_products.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Products</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/admin_style.css">
</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="add-products">
      <h1 class="title">Shop Products</h1>
      <form action="" method="post" enctype="multipart/form-data">
         <h3>Add Product</h3>
         <input type="text" name="name" class="box" placeholder="Enter book name" required>
         <input type="number" min="0" name="price" class="box" placeholder="Enter book price" required>
         <input type="text" name="author" class="box" placeholder="Name of author" required>
         <input type="text" name="description" class="box" placeholder="Enter description" required>
         <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
         <input type="submit" value="add product" name="add_product" class="btn">
      </form>
   </section>

   <section class="show-products">
      <div class="box-container">
         <?php
         $stmt = $conn->prepare("SELECT * FROM products");
         $result = $stmt->execute();
         while ($fetch_products = $result->fetchArray(SQLITE3_ASSOC)) {
            ?>
            <div class="box">
               <img src="images/<?php echo $fetch_products['image']; ?>" alt="">
               <div class="name">
                  <?php echo $fetch_products['name']; ?>
               </div>
               <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
               <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
               <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn"
                  onclick="return confirm('Delete this product?');">Delete</a>
            </div>
            <?php
         }
         ?>
      </div>
   </section>

   <section class="edit-product-form">
      <?php
      if (isset($_GET['update'])) {
         $update_id = $_GET['update'];
         $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
         $stmt->bindValue(1, $update_id, SQLITE3_INTEGER);
         $result = $stmt->execute();
         while ($fetch_update = $result->fetchArray(SQLITE3_ASSOC)) {
            ?>
            <form action="" method="post" enctype="multipart/form-data">
               <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
               <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
               <img src="images/<?php echo $fetch_update['image']; ?>" alt="">
               <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required
                  placeholder="Enter product name">
               <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box"
                  required placeholder="Enter product price">
               <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
               <input type="submit" value="update" name="update_product" class="btn">
               <input type="reset" value="cancel" id="close-update" class="option-btn">
            </form>
            <?php
         }
      } else {
         echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
      }
      ?>
   </section>

   <script src="js/admin_script.js"></script>
</body>

</html>
