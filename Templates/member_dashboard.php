<!DOCTYPE html>
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
                <li><a href="tp_view_course_page.php">Forum</a></li>
                <li><a href="tp_logout.php">Quick Form Check</a></li>
                <li><a href="tp_logout.php">Quiz</a></li>
                <li><a href="tp_logout.php">Schedule</a></li>
                <li><a href="tp_logout.php">Virtual competiton</a></li>
                <li><a href="tp_logout.php">recommended plan</a></li>
                <li><a href="tp_logout.php">Chat</a></li>
                <li><a href="tp_logout.php">Profile</a></li>
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
    /*include 'db_conn.php';
    session_start();
    if(isset($_SESSION['TP_ID']) && isset($_SESSION['TP_Name'])){
        ?>
            <h1>Hello, <?php echo $_SESSION['TP_Name']; ?></h1>
    <?php }  ?>
        <div id="overview">
        <?php
        $current_TP_ID = $_SESSION['TP_ID']; 
        $sql = "SELECT COUNT(*) AS course_count FROM course WHERE TP_ID = $current_TP_ID";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $courseCount = $row['course_count'];
        */
        ?>
        <h1>Hello</h1>
         <div id="overview">
            <h2 id="overview-header">Membership Information</h2>
            <div id="overview-main">
            <div class="overview-section">
                <h3>Membership Length</h3>
                <h4 class="overview-values">1 month</h4>
            </div>
            <div class="overview-section">
                <h3>Expiry Date</h3>
                <h4 class="overview-values">19-9-2027</h4>
            </div>
            <div class="overview-section">
                <h3>Days Left</h3>
                <h4 class="overview-values">22</h4>
            </div>
            </div>
        </div>
        <div id="Course-Management">
            <h2 id="cm-header">Progress Tracking</h2>
            <div id="buttons-layout">
            <img src="https://idta.com.au/wp-content/uploads/2022/01/symmetrical-triangle-chart-patterns-example.webp" alt="" width="700">
</div>
        </div>
        
    </main>
    <footer>

    </footer>

    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
</body>
</html>
