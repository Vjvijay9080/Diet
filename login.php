<?php
session_start(); // Start session

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT * FROM diet_users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($password, $row["password"])) {
            $_SESSION["user"] = [
                "id" => $row["id"],
                "name" => $row["name"],
                "email" => $row["email"],
                "phone" => $row["phone"]
            ];

            echo "<script>alert('Login successful!'); window.location.href='dashboard.php';</script>";
        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('Email not found!');</script>";
    }
}

$conn->close();
?>
