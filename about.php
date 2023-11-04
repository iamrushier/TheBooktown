<?php
include 'config.php';
session_start();
$l=0;
foreach ($_SESSION as $key => $val) {
   $l++;
}
$user_id=0;
if ($l > 0) {
   $user_id = $_SESSION['user_id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/all.min.css">
   <link rel="stylesheet" href="css/home-styles.css">
   <link rel="stylesheet" href="css/footer.css">
   <link rel="stylesheet" href="css/header.css">
   <link rel="stylesheet" href="css/about.css">
</head>

<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>About Us</h3>
      <p> <a href="home.php">Home</a> / About </p>
   </div>

   <section class="about">
      <div class="flex">
         <div class="image">
            <img src="images/about-img.jpg" alt="">
         </div>
         <div class="content">
            <h3>Why Choose Us?</h3>
            <p>At "The Booktown," we're all about students. We make getting your hands on affordable, quality
               second-hand textbooks a breeze. Plus, you can sell your old books and pocket some extra cash. Join us and
               be part of a community that cares about your education and your budget.
            </p>


            <a href="contact.php" class="btn">contact us</a>
         </div>
      </div>
   </section>

   <section class="reviews">
      <h1 class="title">Client's Reviews</h1>
      <div class="box-container">
         <div class="box">
            <img src="images/pic-1.png" alt="">
            <p>"The Booktown is a game-changer for students. I found amazing deals on second-hand books, saved money,
               and selling my old books was a breeze. Highly recommend!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>John Deo</h3>


         </div>
         <div class="box">
            <img src="images/pic-2.png" alt="">
            <p>"The Booktown is a student's dream. I've saved big on second-hand textbooks and made quick cash selling
               my own. Highly recommended!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Jane Smith</h3>


         </div>
         <div class="box">
            <img src="images/pic-3.png" alt="">
            <p>"The Booktown is a game-changer for students. Amazing savings on books and effortless selling. Highly
               recommended!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Michael Brown</h3>

         </div>
         <div class="box">
            <img src="images/pic-4.png" alt="">
            <p>"The Booktown rocks! Affordable books and a breeze to sell. A student's dream come true!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Lisa Smith</h3>


         </div>
         <div class="box">
            <img src="images/pic-5.png" alt="">
            <p>"For students, "The Booktown" is a blessing. Big savings on textbooks and easy earnings. Highly
               recommended!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>David Johnson</h3>

         </div>
         <div class="box">
            <img src="images/pic-6.png" alt="">
            <p>""The Booktown" is fantastic. Affordable textbooks, easy selling process. Ideal for students!"</p>
            <div class="stars">
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star"></i>
               <i class="fas fa-star-half-alt"></i>
            </div>
            <h3>Emily Davis</h3>

         </div>
      </div>
   </section>

   <section class="authors">
      <h1 class="title">Great Authors</h1>
      <div class="box-container">
         <div class="box">
            <img src="images/author-1.jpg" alt="">
            <div class="share">
               <a href="#" class="fab fa-facebook-f"></a>
               <a href="#" class="fab fa-twitter"></a>
               <a href="#" class="fab fa-instagram"></a>
               <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>Steve Smith</h3>
         </div>
         <div class="box">
            <img src="images/author-2.jpg" alt="">
            <div class="share">
               <a href="#" class="fab fa-facebook-f"></a>
               <a href="#" class="fab fa-twitter"></a>
               <a href="#" class="fab fa-instagram"></a>
               <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>Megan G.</h3>
         </div>
         <div class="box">
            <img src="images/author-3.jpg" alt="">
            <div class="share">
               <a href="#" class="fab fa-facebook-f"></a>
               <a href="#" class="fab fa-twitter"></a>
               <a href="#" class="fab fa-instagram"></a>
               <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>K. Williamson</h3>
         </div>
         <div class="box">
            <img src="images/author-4.jpg" alt="">
            <div class="share">
               <a href="#" class="fab fa-facebook-f"></a>
               <a href="#" class="fab fa-twitter"></a>
               <a href="#" class="fab fa-instagram"></a>
               <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>Natasha S.</h3>
         </div>
         <div class="box">
            <img src="images/author-5.jpg" alt="">
            <div class="share">
               <a href="#" class="fab fa-facebook-f"></a>
               <a href="#" class="fab fa-twitter"></a>
               <a href="#" class="fab fa-instagram"></a>
               <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>AB D.</h3>
         </div>
         <div class="box">
            <img src="images/author-6.jpg" alt="">
            <div class="share">
               <a href="#" class="fab fa-facebook-f"></a>
               <a href="#" class="fab fa-twitter"></a>
               <a href="#" class="fab fa-instagram"></a>
               <a href="#" class="fab fa-linkedin"></a>
            </div>
            <h3>Varsha D.</h3>
         </div>
      </div>
   </section>



   <?php include 'footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>