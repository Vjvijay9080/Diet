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

$sql = "SELECT * FROM meals";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Track Progress</title>
</head>
<body>
    <h1>Meals List</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Meal Name</th>
            <th>Meal Description</th>
            <th>Created At</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['meal_name']}</td>
                        <td>{$row['meal_description']}</td>
                        <td>{$row['created_at']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No meals found</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>