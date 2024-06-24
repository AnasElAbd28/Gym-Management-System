<!DOCTYPE html>

<?php
session_start(); // Starting the session

include 'db_conn.php';
$QfcID = $_GET['id'];

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

    <title>QFC</title>
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
                <li><a href="recommended_plan.php">recommended plan</a></li>
                <li><a href="chat.php">Chat</a></li>
                <li><a href="member_profile.php">Profile</a></li>
                <li><a href="logout.php">logout</a></li>
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
    <?php
    $sql = "SELECT * FROM qfc WHERE qfc_id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $QfcID); // Assuming qfc_id is an integer
        
        // Execute the statement
        mysqli_stmt_execute($stmt);
        
        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        
        // Fetch the row
        $row = mysqli_fetch_assoc($result);
        
        // Check if a row was found
        if ($row) { ?>
            <h1><?php echo $row['qfc_title']; ?></h1>
            <div id="overview">
                <h2 id="overview-header">Description</h2>
                <div id="overview-main">
                    <div class="overview-section">
                        <h4 class="overview-values"><?php echo $row['qfc_description']; ?></h4>
                    </div>
                </div>
            </div>
            <div id="overview">
                <h2 id="overview-header">URL</h2>
                <div id="overview-main">
                    <div class="overview-section">
                        <a href="<?php echo $row['qfc_url']; ?>"><h4 class="overview-values"><?php echo $row['qfc_url']; ?></h4></a>
                    </div>
                </div>
            </div>
            <div id="overview">
                <h2 id="overview-header">Feedback</h2>
                <div id="overview-main">
                    <div class="overview-section">
                        <h4 class="overview-values">
                            <?php 
                            if (empty($row['qfc_feedback'])) {
                                echo "No feedback yet";
                            } else {
                                echo $row['qfc_feedback'];
                            }
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
    <?php   } else {
            // No row found
            echo "No row found for qfc_id = $QfcID";
        }
    }
    mysqli_stmt_close($stmt);
    ?>
    </main>
    <footer>

    </footer>

    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
</body>
</html>
