<?php
include 'db_conn.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $workoutName = $_POST['workout_name'];
    $workoutDescription = $_POST['workout_description'];
    $dayOfWeek = $_POST['day_of_week'];

    $insertQuery = "INSERT INTO schedule (workout_name, description, day_of_week, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertQuery);
    $stmt->bind_param("sssi", $workoutName, $workoutDescription, $dayOfWeek, $user_id);

    if ($stmt->execute()) {
        switch ($dayOfWeek) {
            case 'Monday':
                header("Location: schedule_plan.php");
                break;
            case 'Tuesday':
                header("Location: tuesday.php");
                break;
            case 'Wednesday':
                header("Location: wednesday.php");
                break;
            case 'Thursday':
                header("Location: thursday.php");
                break;
            case 'Friday':
                header("Location: friday.php");
                break;
            case 'Saturday':
                header("Location: saturday.php");
                break;
            case 'Sunday':
                header("Location: sunday.php");
                break;
            default:
                header("Location: member_dashboard.php");
                break;
        }
        exit();
    } else {
        echo "Error adding workout: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/layout.css">
    <link rel="stylesheet" href="../Styles/landing.css">
    <link rel="stylesheet" href="../Styles/create_course.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/3704673904.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.css" />
    <script src="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.js"></script>

    <title>Add Workout</title>
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
                <li><a href="#">Quiz</a></li>
                <li><a href="#">Schedule</a></li>
                <li><a href="#">Virtual Competition</a></li>
                <li><a href="#">Recommended Plan</a></li>
                <li><a href="#">Chat</a></li>
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
    <div class="all-content">
        <main>
            <div id="create-course-form">
                <h2 id="create_course_headline">Add Workout</h2>
                <form action="" method="POST">
                    <input type="text" class="input" id="workout_name" name="workout_name" placeholder="Workout Name" required>
                    <textarea class="input" id="workout_description" name="workout_description" rows="10" cols="50" placeholder="Description" required></textarea>
                    <select class="input" name="day_of_week" id="day_of_week" required>
                        <option disabled selected>Day</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                    </select>
                    <input type="submit" value="Submit" id="submit">
                </form>
            </div>
        </main>
    </div>
    <footer></footer>
    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
</body>
</html>
