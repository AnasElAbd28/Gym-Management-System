<!DOCTYPE html>

<?php
session_start(); // Starting the session

include 'db_conn.php';
$QfcID = $_GET['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedback = $_POST['feedback'];
    $trainer_id = $_SESSION['id'];

    $update_sql = "UPDATE qfc SET qfc_feedback = ?, qfc_status = 'complete', trainer_replied = ? WHERE qfc_id = ?";
    $update_stmt = mysqli_prepare($conn, $update_sql);
    if ($update_stmt) {
        mysqli_stmt_bind_param($update_stmt, "sii", $feedback, $trainer_id, $QfcID);
        mysqli_stmt_execute($update_stmt);
        mysqli_stmt_close($update_stmt);
    }
}

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

    <title>Trainer QFC</title>
</head>
<body>
<nav class="first-nav">
    <a href="trainer_dashboard.php">
        <h2>Pygmalion</h2>
    </a>
    <div>
        <ul class="nav-links">
            <li><a href="trainer_quick_form_check.php">Quick Form Check</a></li>
            <li><a href="chat.php">Chat</a></li>
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
                        <form method="POST">
                            <textarea name="feedback" class="feedback-textarea" placeholder="Enter feedback here" rows="10" cols="50"><?php echo isset($row['qfc_feedback']) ? $row['qfc_feedback'] : ''; ?></textarea>
                    </div>
                    <div class="overview-section">
                            <button type="submit">Save</button>
        </div>
                        </form>
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
