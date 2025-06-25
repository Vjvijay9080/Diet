<?php
session_start();

// Dummy credentials for demonstration
$admin_username = "admin";
$admin_password = "admin123"; // In a real application, use hashed passwords

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check credentials
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
    } else {
        echo "Invalid credentials!";
        exit;
    }
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: admin_login.html");
    exit;
}

// Database connection
$servername = "localhost"; // Change if necessary
$db_username = "root"; // Your database username
$db_password = ""; // Your database password
$db_name = "user_db"; // Your database name

$conn = new mysqli($servername, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details from the existing users table
$sql = "SELECT id, name, email, message, created_at FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>This is the admin dashboard.</p>
        
        <h3>User Details</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['message']}</td>
                                <td>{$row['created_at']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
