<?php
$servername = "localhost"; // Change if using a remote server
$username = "root"; // MySQL username (default: root in XAMPP)
$password = ""; // MySQL password (default: empty in XAMPP)
$dbname = "diet_plan"; // Name of your database

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
