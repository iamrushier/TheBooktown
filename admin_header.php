<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '
            <div class="message">
            <span>' . $msg . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
         ';
    }
}
?>

<header class="header">
    <div class="flex">
        <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>
        <nav class="navbar">
            <a href="admin_page.php">Home</a>
            <a href="admin_products.php">Products</a>
            <a href="admin_orders.php">Orders</a>
            <a href="admin_users.php">Users</a>
            <a href="admin_contacts.php">Messages</a>
            <a href="admin_sell_requests.php">Sell requests</a>
        </nav>
        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
        </div>
        <div class="account-box">
            <?php if (isset($_SESSION['admin_name']) && isset($_SESSION['admin_email'])) : ?>
                <p>Username : <span>
                        <?php echo $_SESSION['admin_name']; ?>
                    </span></p>
                <p>Email : <span>
                        <?php echo $_SESSION['admin_email']; ?>
                    </span></p>
                <a href="logout.php" class="delete-btn">Log out</a>
            <?php else : ?>
                <div>New <a href="login.php">Login</a> | <a href="register.php">Register</a></div>
            <?php endif; ?>
        </div>
    </div>
</header>
