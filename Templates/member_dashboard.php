<!DOCTYPE html>

<?php
session_start(); // Starting the session

include 'db_conn.php';

// Retrieve the member ID from the session
$member_id = $_SESSION['member_id'];

// Query the database to get the membership start and end dates
$sql = "SELECT membership_start, membership_end FROM membership WHERE member_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $member_id);
$stmt->execute();
$stmt->bind_result($membership_start, $membership_end);

// Fetch the result
$stmt->fetch();
$stmt->close();

// Format the dates if needed
$formatted_membership_start = date("d-m-Y", strtotime($membership_start));
$formatted_membership_end = date("d-m-Y", strtotime($membership_end));
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
<script src="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.js"></script>

    <title>Dashboard</title>
</head>
<body>
    <nav>
    <a href="tp_dashboard.php">
            <h2>Gym System</h2>
        </a>
        <div>
            <ul class="nav-links">
                <li><a href="#">Forum</a></li>
                <li><a href="#">Quick Form Check</a></li>
                <li><a href="#">Quiz</a></li>
                <li><a href="#">Schedule</a></li>
                <li><a href="#">Virtual competiton</a></li>
                <li><a href="#">recommended plan</a></li>
                <li><a href="#">Chat</a></li>
                <li><a href="#">Profile</a></li>
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
        <h1>Hello <?php echo $_SESSION['member_username']; ?></h1>
         <div id="overview">
            <h2 id="overview-header">Membership Information</h2>
            <div id="overview-main">
            <div class="overview-section">
                    <h3>Membership start date</h3>
                    <h4 class="overview-values"><?php echo $formatted_membership_start; ?></h4>
                </div>
                <div class="overview-section">
                    <h3>Membership end date</h3>
                    <h4 class="overview-values"><?php echo $formatted_membership_end; ?></h4>
                </div>
            </div>
        </div>
        <div id="Course-Management">
            <h2 id="cm-header">Progress Tracking</h2>
            <div id="buttons-layout">
            <img src="https://idta.com.au/wp-content/uploads/2022/01/symmetrical-triangle-chart-patterns-example.webp" alt="" width="700" height="auto">
            <img src="https://idta.com.au/wp-content/uploads/2022/01/symmetrical-triangle-chart-patterns-example.webp" alt="" width="700" height="auto">
            <img src="https://idta.com.au/wp-content/uploads/2022/01/symmetrical-triangle-chart-patterns-example.webp" alt="" width="700" height="auto">
</div>
        </div>
        
    </main>
    <footer>

    </footer>

    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
</body>
</html>
