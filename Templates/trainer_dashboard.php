<!DOCTYPE html>

<?php
session_start(); // Starting the session

include 'db_conn.php';

// Retrieve the member ID from the session
$member_id = $_SESSION['id'];


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

    <title>Trainer Dashboard</title>
</head>
<body>
<nav class="first-nav">
    <a href="member_dashboard.php">
            <h2>Pygmalion</h2>
        </a>
        <div>
            <ul class="nav-links">
            <li><a href="trainer_quick_form_check.php">Quick Form Check</a></li>
                <li><a href="chat.php">Chat</a></li>
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
        <h1>Hello <?php echo $_SESSION['username']; ?></h1>
         <div id="overview">
            <h2 id="overview-header">Trainer Information</h2>
            <div id="overview-main">
            <div class="overview-section">
                    <h3>Name</h3>
                    <h4 class="overview-values"><?php echo $_SESSION['username'] ?></h4>
                </div>
                <div class="overview-section">
                    <h3>Email</h3>
                    <h4 class="overview-values"><?php echo $_SESSION['email']; ?></h4>
                </div>
            </div>
        </div>
        
    </main>
    <footer>

    </footer>

    
    
    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
</body>
</html>
