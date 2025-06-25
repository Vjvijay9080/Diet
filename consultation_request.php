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

// Fetch care providers
$sql = "SELECT * FROM care_providers";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation Request</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Request a Consultation</h2>
        <form action="send_consultation_request.php" method="POST">
            <div class="form-group">
                <label for="provider">Select Care Provider</label>
                <select name="provider_id" id="provider" class="form-control" required>
                    <option value="">Select a provider</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['name']} - {$row['specialty']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="message" id="message" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send Request</button>
        </form>
    </div>
</body>
</html>

<?php
$conn->close();
?>