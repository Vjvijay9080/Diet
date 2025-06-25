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

// Initialize total calories
$total_calories = 0;

// Check if a meal's calories have been updated
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['meal_id'])) {
    $meal_id = intval($_POST['meal_id']);
    $calories = intval($_POST['calories']);

    // Update the calories for the specific meal
    $sql = "UPDATE meals SET calories = $calories WHERE id = $meal_id";
    if ($conn->query($sql) === TRUE) {
        echo "Calories updated successfully.";
    } else {
        echo "Error updating calories: " . $conn->error;
    }
}

// Retrieve meals and calculate total calories
$sql = "SELECT * FROM meals";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total_calories += $row['calories'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Track Calories</title>
</head>
<body>
    <h1>Track Your Calories</h1>
    <h2>Total Calories: <?php echo $total_calories; ?></h2>

    <h3>Update Meal Calories</h3>
    <form method="post" action="">
        <label for="meal_id">Select Meal:</label>
        <select id="meal_id" name="meal_id" required>
            <option value="">--Select a Meal--</option>
            <?php
            // Reconnect to the database to fetch meals for the dropdown
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT * FROM meals";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['meal_name']}</option>";
                }
            }
            $conn->close();
            ?>
        </select>
        <br>
        <label for="calories">Calories:</label>
        <input type="number" id="calories" name="calories" required>
        <br>
        <input type="submit" value="Update Calories">
    </form>

    <h3>Meals List</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Meal Name</th>
            <th>Meal Description</th>
            <th>Calories</th>
            <th>Created At</th>
        </tr>
        <?php
        // Reconnect to the database to fetch meals for display
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM meals";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['meal_name']}</td>
                        <td>{$row['meal_description']}</td>
                        <td>{$row['calories']}</td>
                        <td>{$row['created_at']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No meals found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>