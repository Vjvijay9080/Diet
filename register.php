<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$tableQuery = "CREATE TABLE IF NOT EXISTS diet_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    diet_preferences VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($tableQuery);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $name = $conn->real_escape_string($_POST["name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $age = intval($_POST["age"]);
    $gender = $conn->real_escape_string($_POST["gender"]);
    $diet = $conn->real_escape_string($_POST["diet"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash the password

    // Insert data into database
    $sql = "INSERT INTO diet_users (name, email, password, age, gender, diet_preferences) 
            VALUES ('$name', '$email', '$password', $age, '$gender', '$diet')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>
