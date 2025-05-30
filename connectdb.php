<?php 
// Database connection settings
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "flowershop";
$mysql = new mysqli($servername, $username, $pass, $dbname);

if ($mysql->connect_error) {
    die("Connection failed: " . $mysql->connect_error);
}
?>