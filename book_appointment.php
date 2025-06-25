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
$stmt = $conn->prepare("INSERT INTO appointments (name, email, phone, gender, activity_level, consultation_type, contact_method, appointment_date, current_weight, target_weight, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssdds", $name, $email, $phone, $gender, $activity_level, $consultation_type, $contact_method, $appointment_date, $current_weight, $target_weight, $message);

// Set parameters and execute
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $activity_level = $_POST['activity_level'];
    $consultation_type = $_POST['consultation_type'];
    $contact_method = $_POST['contact_method'];
    $appointment_date = $_POST['appointment_date'];
    $current_weight = $_POST['current_weight'];
    $target_weight = $_POST['target_weight'];
    $message = $_POST['message'];

    if ($stmt->execute()) {
        // Redirect to dashboard after successful booking
        header("Location: ap.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>