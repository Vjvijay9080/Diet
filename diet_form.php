<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION["user_email"])) {
    header("Location: login.html");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get logged-in user email
$email = $_SESSION["user_email"];

// Fetch user details from the database
$sql = "SELECT * FROM diet_users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<script>alert('No diet details found! Please fill out the form.'); window.location.href='diet_form.html';</script>";
    exit();
}

// Handle diet form update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $diet = $conn->real_escape_string($_POST["diet"]);
    $allergies = !empty($_POST["allergies"]) ? $conn->real_escape_string($_POST["allergies"]) : NULL;
    $calories = !empty($_POST["calories"]) ? intval($_POST["calories"]) : NULL;
    $activity = $conn->real_escape_string($_POST["activity"]);
    $goal = $conn->real_escape_string($_POST["goal"]);

    // Update user details
    $updateSql = "UPDATE diet_users SET diet_preferences='$diet', allergies='$allergies', caloric_goal='$calories', activity_level='$activity', dietary_goal='$goal' WHERE email='$email'";
    
    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Diet details updated successfully!'); window.location.href='diet_form.php';</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Details</title>
    <link rel="stylesheet" href="MultipleFiles/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #ff9966, #ff5e62);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 450px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #ff5e62;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        .btn-primary {
            background-color: #ff5e62;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #e74c3c;
        }
        .logout {
            background-color: red;
            color: white;
            padding: 10px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $user["name"]; ?>!</h2>
        <p><strong>Email:</strong> <?php echo $user["email"]; ?></p>
        <p><strong>Age:</strong> <?php echo $user["age"]; ?></p>
        <p><strong>Gender:</strong> <?php echo $user["gender"]; ?></p>

        <h4>Dietary Preferences</h4>
        <form action="diet_form.php" method="POST">
            <div class="form-group">
                <label for="diet">Diet Preferences</label>
                <input type="text" class="form-control" id="diet" name="diet" value="<?php echo $user['diet_preferences']; ?>" required>
            </div>
            <div class="form-group">
                <label for="allergies">Food Allergies</label>
                <input type="text" class="form-control" id="allergies" name="allergies" value="<?php echo $user['allergies']; ?>">
            </div>
            <div class="form-group">
                <label for="calories">Daily Caloric Intake Goal</label>
                <input type="number" class="form-control" id="calories" name="calories" value="<?php echo $user['caloric_goal']; ?>">
            </div>
            <div class="form-group">
                <label for="activity">Activity Level</label>
                <select class="form-control" id="activity" name="activity">
                    <option value="Sedentary" <?php if($user["activity_level"] == "Sedentary") echo "selected"; ?>>Sedentary</option>
                    <option value="Lightly Active" <?php if($user["activity_level"] == "Lightly Active") echo "selected"; ?>>Lightly Active</option>
                    <option value="Moderately Active" <?php if($user["activity_level"] == "Moderately Active") echo "selected"; ?>>Moderately Active</option>
                    <option value="Very Active" <?php if($user["activity_level"] == "Very Active") echo "selected"; ?>>Very Active</option>
                </select>
            </div>
            <div class="form-group">
                <label for="goal">Dietary Goal</label>
                <select class="form-control" id="goal" name="goal">
                    <option value="Weight Loss" <?php if($user["dietary_goal"] == "Weight Loss") echo "selected"; ?>>Weight Loss</option>
                    <option value="Muscle Gain" <?php if($user["dietary_goal"] == "Muscle Gain") echo "selected"; ?>>Muscle Gain</option>
                    <option value="Maintenance" <?php if($user["dietary_goal"] == "Maintenance") echo "selected"; ?>>Maintenance</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary btn-block">Update</button>
        </form>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</body>
</html>
