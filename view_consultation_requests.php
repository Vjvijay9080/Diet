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

// Fetch consultation requests
$sql = "SELECT cr.*, cp.name AS provider_name FROM consultation_requests cr JOIN care_providers cp ON cr.provider_id = cp.id WHERE cr.user_id = 1"; // Replace with actual user ID
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Consultation Requests</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Your Consultation Requests</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Provider</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['provider_name']}</td>
                            <td>{$row['message']}</td>
                            <td>{$row['created_at']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No consultation requests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>