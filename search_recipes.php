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

$search_results = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_term = $conn->real_escape_string($_POST['search_term']);
    $sql = "SELECT * FROM meals WHERE meal_name LIKE '%$search_term%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
    } else {
        $search_results = [];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Recipes</title>
</head>
<body>
    <h1>Search for Meals</h1>
    <form method="post" action="">
        <label for="search_term">Meal Name:</label>
        <input type="text" id="search_term" name="search_term" required>
        <input type="submit" value="Search">
    </form>

    <h2>Search Results</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Meal Name</th>
            <th>Meal Description</th>
            <th>Created At</th>
        </tr>
        <?php if (!empty($search_results)): ?>
            <?php foreach ($search_results as $meal): ?>
                <tr>
                    <td><?php echo $meal['id']; ?></td>
                    <td><?php echo $meal['meal_name']; ?></td>
                    <td><?php echo $meal['meal_description']; ?></td>
                    <td><?php echo $meal['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">No meals found</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>