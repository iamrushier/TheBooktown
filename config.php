<?php
$db_host = getenv('DB_HOST');
$db_user = getenv('MYSQL_USER');
$db_pass = getenv('MYSQL_PASSWORD');
$db_name = getenv('MYSQL_DATABASE');

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
?>