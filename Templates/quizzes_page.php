<?php
include 'db_conn.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/layout.css">
    <link rel="stylesheet" href="../Styles/view_course.css">
    <link rel="stylesheet" href="../Styles/landing.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/3704673904.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.css" />
    <script src="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.js"></script>

    <title>Quizzes</title>
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
                <li><a href="schedule_plan.php">Schedule</a></li>
                <li><a href="recommended_plan.php">Recommended Plan</a></li>
                <li><a href="chat.php">Chat</a></li>
                <li><a href="member_profile.php">Profile</a></li>
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
            <h1>Quiz</h1>

            <?php
            if (isset($_GET['score']) && isset($_GET['total'])) {
                $score = intval($_GET['score']);
                $total = intval($_GET['total']);
                echo "<p style='color: green; margin-bottom: 5px;'>You scored $score / $total</p>";
            }
            ?>

            <div id="courses-container">
    <?php
    $member_id = $_SESSION['id']; // Retrieve the member ID from the session

    $sql = "SELECT quizzes.quiz_id, quizzes.quiz_title, 
            COALESCE(MAX(attempts.score), 0) AS correct_answers,
            (SELECT COUNT(*) FROM questions WHERE questions.quiz_id = quizzes.quiz_id) AS total_questions
            FROM quizzes
            LEFT JOIN attempts ON quizzes.quiz_id = attempts.quiz_id AND attempts.user_id = ?
            GROUP BY quizzes.quiz_id";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $correct_answers = $row['correct_answers'];
            $total_questions = $row['total_questions'];
            $score_display = ($correct_answers !== null) ? "$correct_answers / $total_questions" : 'N/A';
    ?>
            <a href="quiz_page.php?id=<?php echo $row['quiz_id']; ?>">
                <div class="course">
                    <h5 class="course-name"><?php echo $row["quiz_title"] ?></h5>
                    <h5 class="course-score"><?php echo $score_display; ?></h5>
                </div>
            </a>
    <?php
        }
    } else {
        echo "No courses found.";
    }
    ?>
</div>
        </main>
        <footer>

        </footer>
    </div>
    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
</body>

</html>

