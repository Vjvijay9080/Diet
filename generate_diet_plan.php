<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $goal = $_POST['goal'];
    $preferences = $_POST['preferences'];

    // Here you would implement your logic to generate a diet plan based on the goal and preferences.
    // For demonstration, we will just display the input back to the user.

    echo "<h2>Your Diet Plan</h2>";
    echo "<p>Goal: " . htmlspecialchars($goal) . "</p>";
    echo "<p>Preferences: " . nl2br(htmlspecialchars($preferences)) . "</p>";
    // You can add more logic to generate a detailed diet plan here.
}
?>