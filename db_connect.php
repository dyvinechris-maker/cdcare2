<?php
$host = "localhost";     // Your host name (usually localhost)
$user = "root";          // Your MySQL username
$pass = "";              // Your MySQL password
$dbname = "user_registration";  // Database name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
