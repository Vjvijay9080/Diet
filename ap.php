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

// Fetch appointments
$sql = "SELECT * FROM appointments";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Appointments</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
/* General Styles */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f9fa;
    color: #333;
    margin: 0;
    padding: 0;
}

h2 {
    margin-bottom: 20px;
    color: #007bff; /* Bootstrap primary color */
}

/* Container */
.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

/* Form Styles */
.form-group {
    margin-bottom: 15px;
}

.form-control {
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    padding: 10px;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Button Styles */
.btn {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 0.25rem;
    cursor: pointer;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #0056b3;
}

/* Table Styles */
.table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
    border-collapse: collapse;
}

.table th,
.table td {
    padding: 12px;
    vertical-align: top;
    border: 1px solid #dee2e6;
}

.table thead th {
    background-color: #007bff;
    color: white;
}

.table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Footer Styles */
.footer {
    background-color: #343a40;
    color: white;
    padding: 20px 0;
}

.footer h2 {
    color: #ffffff;
}

.footer .social {
    list-style: none;
    padding: 0;
}

.footer .social li {
    display: inline;
    margin-right: 10px;
}

.footer .social a {
    color: white;
    text-decoration: none;
}

.footer .social a:hover {
    color: #007bff;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .btn {
        width: 100%;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Your Appointments</h2>
        <a href="consultation_request.php">consultation request</a>
        <a href="view_consultation_requests.php">view consultation</a>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Activity Level</th>
                    <th>Consultation Type</th>
                    <th>Contact Method</th>
                    <th>Appointment Date</th>
                    <th>Current Weight</th>
                    <th>Target Weight</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['gender']}</td>
                            <td>{$row['activity_level']}</td>
                            <td>{$row['consultation_type']}</td>
                            <td>{$row['contact_method']}</td>
                            <td>{$row['appointment_date']}</td>
                            <td>{$row['current_weight']}</td>
                            <td>{$row['target_weight']}</td>
                            <td>{$row['message']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>No appointments found.</td></tr>";
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