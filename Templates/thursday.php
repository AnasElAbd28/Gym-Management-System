<!DOCTYPE html>

<?php
session_start(); // Starting the session

include 'db_conn.php';

// Retrieve the member ID from the session
$member_id = $_SESSION['id'];

// Set the day of the week to Tuesday (for this page)
$day_of_week = 'Thursday';

// Query to get workouts for Tuesday for the logged-in user
$query = "SELECT workout_name, description FROM schedule WHERE user_id = ? AND day_of_week = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("is", $member_id, $day_of_week);
$stmt->execute();
$result = $stmt->get_result();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/layout.css">
    <link rel="stylesheet" href="../Styles/landing.css">
    <link rel="stylesheet" href="../Styles/member_dashboard_style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/3704673904.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.css" />
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.js"></script>

    <title>Tuesday</title>
</head>
<body>
<nav class="first-nav">
<a href="member_dashboard.php">
            <h2>Pygmalion</h2>
        </a>
    <div>
        <ul class="nav-links">
            <li><a href="forum_feed.php">Forum</a></li>
            <li><a href="quick_form_check.php">Quick Form Check</a></li>
            <li><a href="quizzes_page.php">Quiz</a></li>
            <li><a href="#">Schedule</a></li>
            <li><a href="#">Virtual competition</a></li>
            <li><a href="#">Recommended plan</a></li>
            <li><a href="chat.php">Chat</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="burger">
        <div class="l1"></div>
        <div class="l2"></div>
        <div class="l3"></div>
    </div>
</nav>
<nav class="second-nav">
    <div>
        <ul class="nav-links">
            <li><a href="schedule_plan.php">Monday</a></li>
            <li><a href="tuesday.php">Tuesday</a></li>
            <li><a href="wednesday.php">Wednesday</a></li>
            <li><a href="thursday.php">Thursday</a></li>
            <li><a href="friday.php">Friday</a></li>
            <li><a href="saturday.php">Saturday</a></li>
            <li><a href="sunday.php">Sunday</a></li>
        </ul>
    </div>
    <div class="burger">
        <div class="l1"></div>
        <div class="l2"></div>
        <div class="l3"></div>
    </div>
</nav>
<div class="all-content">
    <main>
        <h1>Thursday</h1>
       
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div id='overview'>";
                echo "<div id='overview-main'>";
                echo "<div class='overview-section'>";
                echo "<h3>" . htmlspecialchars($row['workout_name']) . "</h3>";
                echo "<h4 class='overview-values'>" . htmlspecialchars($row['description']) . "</h4>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>No workouts scheduled yet</p>";
        }
?>
    </main>
    <footer>
    </footer>
    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
       
