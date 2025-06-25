<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION["user"])) {
    header("Location: login.html");
    exit();
}

// Get user details
$user = $_SESSION["user"];

// Determine active section
$section = $_GET['section'] ?? 'dashboard';

// Whitelisted sections for safety
$allowed_sections = [
    'dashboard' => 'dashboard_content.php',
    'calorie-tracker' => 'calorie_tracker.php',
    'meal-planner' => 'meal_planner.php',
    'recipe-database' => 'recipe_database.php',
    'progress-tracker' => 'progress_tracker.php',
    'community-forum' => 'community_forum.php',
    'recommendations' => 'recommendations.php',
    'shopping-list' => 'shopping_list.php',
    'daily-tips' => 'daily_tips.php'
];

$content = $allowed_sections[$section] ?? 'dashboard_content.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CareCircle Dashboard</title>
    <link rel="stylesheet" href="MultipleFiles/bootstrap.min.css">
    <link rel="stylesheet" href="MultipleFiles/font-awesome.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: #f4f6f9;
            display: flex;
            flex-direction: column;
        }

        /* Header */
        .header { background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .topbar { background: #ff5e62; color: white; padding: 10px 0; }
        .topbar .top-contact li, .topbar .top-link li {
            display: inline-block; margin-right: 15px; font-size: 14px;
        }
        .topbar a { color: white; text-decoration: none; }
        .header-inner { padding: 10px 0; }
        .main-menu .nav.menu > li { display: inline-block; position: relative; }
        .main-menu .nav.menu > li > a {
            padding: 10px 15px; color: #333; text-decoration: none;
        }
        .main-menu .dropdown {
            display: none; position: absolute; background: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .main-menu li:hover .dropdown { display: block; }
        .main-menu .dropdown li a {
            display: block; padding: 10px 15px; white-space: nowrap;
        }

        /* Layout */
        .dashboard-body {
            display: flex;
            flex-grow: 1;
        }

        .sidebar {
            width: 250px;
            background: #35424a;
            color: white;
            padding: 20px;
            min-height: 100vh;
        }

        .sidebar h2 {
            color: #ff5e62;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
            margin-bottom: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active-link {
            background: #ff5e62;
            font-weight: bold;
        }

        .content {
            flex-grow: 1;
            padding: 30px;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .btn-logout {
            background-color: #ff5e62;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
        }

        .btn-logout:hover {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>

<header class="header" >
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-5 col-12">
                        <!-- Contact -->
                        <ul class="top-link">
                            <li><a href="#"><b>Healing Happens In Circles,Not Alone</b></a></li>
                        </ul>
                        <!-- End Contact -->
                    </div>
                    <div class="col-lg-6 col-md-7 col-12">
                        <!-- Top Contact -->
                        <ul class="top-contact">
                            <li><i class="fa fa-phone"></i>044 8769 9876</li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:support@yourmail.com">carecircle@gmail.com</a></li>
                        </ul>
                        <!-- End Top Contact -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Topbar -->
        <!-- Header Inner -->
        <div class="header-inner">
            <div class="container">
                <div class="inner">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-12">
                            <!-- Start Logo -->
                            <div class="logo">
                                <a href="index.html"><img src="img/logo.png" alt="#"></a>
                            </div>
                            <!-- End Logo -->
                            <!-- Mobile Nav -->
                            <div class="mobile-nav"></div>
                            <!-- End Mobile Nav -->
                        </div>
                        <div class="col-lg-7 col-md-9 col-12">
                            <!-- Main Menu -->
                            <div class="main-menu">
                                <nav class="navigation">
                                    <ul class="nav menu">
                                        <li><a href="index.html">Home </a></li>
                                            
                                        </li>
                                        <li class="active"><a href="#">Diet plans <i class="icofont-rounded-down"></i></a>
                                        <ul class="dropdown">
                                            <li><a href="custom-dp.html">Custom Diet Plans</a></li>
                                            <li><a href="weight-lossplan.html">Weight Loss Plans</a></li>
                                            <li><a href="muscle-gainplan.html">Muscle Gain Plans</a></li>
                                            <li><a href="special-diets.html">Special Diets</a></li>
                                        </ul>

                                        <li><a href="#">Recipes <i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">											
                                            <li><a href="meal-plan.html">Meal Plan</a></li>
                                            <li><a href="breakfast-recipes.html">Breakfast Recipes</a></li>
                                            <li><a href="lunch-recipes.html">Lunch Recipes</a></li>
                                            <li><a href="dinner-recipes.html">Dinner Recipes</a></li>
                                            <li><a href="snack-dessert.html">Snacks & Desserts</a></li>
                                        </ul>
                                        <li><a href="#">Tools <i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="calorical.html">Calorie Calulator</a></li>
                                                <li><a href="bmical.html">BMI Calulator</a></li>
                                                <li><a href="macrocal.html">Carb & Fat Intake Calculator</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Blogs <i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="blog-single.html">Diet Tips</a></li>
                                                <li><a href="healthy-recipes.html">Healthy Recipes</a></li>
                                                <li><a href="Fitness-Nutrient.html">Fitness & Nutrient Advice</a></li>
                                                <li><a href="success-story.html">Success Stories</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Contact <i class="icofont-rounded-down"></i></a>
                                            <ul class="dropdown">
                                                <li><a href="about.html">About Us</a></li>
                                                <li><a href="contact.html">Contact Us</a></li>
                                                <li><a href="faq.html">FAQ</a></li>
                                                <li><a href="privacypolicy.html">Privacy Policy</a></li>
                                                <li><a href="terms-conditions.html">Terms & Conditions</a></li>
                                            </ul>
                                    </ul>
                                </nav>
                            </div>

                            <!--/ End Main Menu -->
                        </div>
                        <div class="col-lg-2 col-12">
                            <div class="get-quote">
                                <a href="appointment.html" class="btn">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Header Inner -->
    </header>

<!-- Dashboard Body -->
<div class="dashboard-body">
    <div class="sidebar">
        <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>
        <?php foreach ($allowed_sections as $key => $file): ?>
            <a href="?section=<?php echo $key; ?>" class="<?php echo ($section === $key) ? 'active-link' : ''; ?>">
                <?php echo ucwords(str_replace('-', ' ', $key)); ?>
            </a>
        <?php endforeach; ?>
        <form method="post" action="logout.php">
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>

    <div class="content">
        <div class="container">
            <?php include $content; ?>
        </div>
    </div>
</div>

<script src="MultipleFiles/jquery.min.js"></script>
<script src="MultipleFiles/bootstrap.bundle.min.js"></script>
</body>
</html>
"