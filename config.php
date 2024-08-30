<?php
$host = 'localhost'; // Your database host
$db = 'house_recruitment'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

// Create connection
$mysqli = new mysqli($host, $user, $pass, $db);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
