<?php
$servername = "localhost";
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "user_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $meal_name = $_POST['meal_name'];
    $meal_description = $_POST['meal_description'];

    $sql = "INSERT INTO meals (meal_name, meal_description) VALUES ('$meal_name', '$meal_description')";

    if ($conn->query($sql) === TRUE) {
        echo "New meal added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Meal</title>
</head>
<body>
    <h1>Add a Meal</h1>
    <form method="post" action="">
        <label for="meal_name">Meal Name:</label>
        <input type="text" id="meal_name" name="meal_name" required>
        <br>
        <label for="meal_description">Meal Description:</label>
        <textarea id="meal_description" name="meal_description"></textarea>
        <br>
        <input type="submit" value="Add Meal">
    </form>
</body>
</html>