<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "diet_payments";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$payment_method = $_POST['payment'];
$upi_id = $_POST['upi_id'] ?? NULL;
$card_number = $_POST['card_number'] ?? NULL;
$exp_date = $_POST['exp_date'] ?? NULL;
$cvv = $_POST['cvv'] ?? NULL;
$bank_name = $_POST['bank'] ?? NULL;
$gift_card = $_POST['gift_card'] ?? NULL;

$sql = "INSERT INTO payments (name, payment_method, upi_id, card_number, exp_date, cvv, bank_name, gift_card) 
        VALUES ('$name', '$payment_method', '$upi_id', '$card_number', '$exp_date', '$cvv', '$bank_name', '$gift_card')";

$conn->query($sql);
$conn->close();

echo "<h2>Payment Successful!</h2>";
?>
