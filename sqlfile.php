<?php
// Database configuration
$servername = "localhost"; // Change if necessary
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table
$sql = "CREATE TABLE IF NOT EXISTS appointments (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    activity_level VARCHAR(20) NOT NULL,
    consultation_type VARCHAR(20) NOT NULL,
    contact_method VARCHAR(20) NOT NULL,
    appointment_date DATE NOT NULL,
    current_weight FLOAT NOT NULL,
    target_weight FLOAT NOT NULL,
    message TEXT
)";

if ($conn->query($sql) === TRUE) {
    echo "Table appointments created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
