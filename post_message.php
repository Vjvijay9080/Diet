<?php
session_start();

$messages = [];

// Check if a message has been posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
        // Store the message in the session (or you could store it in a database)
        $_SESSION['messages'][] = $message;
    }
}

// Retrieve messages from the session
if (isset($_SESSION['messages'])) {
    $messages = $_SESSION['messages'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Post Message</title>
</head>
<body>
    <h1>Post a Message</h1>
    <form method="post" action="">
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <br>
        <input type="submit" value="Post Message">
    </form>

    <h2>Messages</h2>
    <ul>
        <?php if (!empty($messages)): ?>
            <?php foreach ($messages as $msg): ?>
                <li><?php echo $msg; ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>No messages posted yet.</li>
        <?php endif; ?>
    </ul>
</body>
</html>