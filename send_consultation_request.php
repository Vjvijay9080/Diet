<?php
// Database connection
$servername = "localhost";
$username = "root"; // default username for XAMPP
$password = ""; // default password for XAMPP
$dbname = "user_db"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO consultation_requests (provider_id, user_id, message) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $provider_id, $user_id, $message);

// Set parameters and execute
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provider_id = $_POST['provider_id'];
    $user_id = 1; // Replace with the actual user ID from your session or authentication system
    $message = $_POST['message'];

    if ($stmt->execute()) {
        echo "Consultation request sent successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>