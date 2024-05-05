<?php
// Specify the SQLite database file path
$db_path = 'C:/Users/Rushikesh/shop_db.sqlite3';

// Create a new SQLite3 connection
$conn = new SQLite3($db_path);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . $conn->lastErrorMsg());
}
?>