<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diet Plan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Create Your Diet Plan</h2>
        <form action="generate_diet_plan.php" method="POST">
            <div class="form-group">
                <label for="goal">Diet Goal</label>
                <select name="goal" id="goal" class="form-control" required>
                    <option value="weight_loss">Weight Loss</option>
                    <option value="muscle_gain">Muscle Gain</option>
                    <option value="maintenance">Maintenance</option>
                </select>
            </div>
            <div class="form-group">
                <label for="preferences">Dietary Preferences</label>
                <textarea name="preferences" id="preferences" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Generate Diet Plan</button>
        </form>
    </div>
</body>
</html>