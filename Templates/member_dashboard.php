<!DOCTYPE html>

<?php
session_start(); // Starting the session

include 'db_conn.php';

// Retrieve the member ID from the session
$member_id = $_SESSION['id'];

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

// Query the database to fetch BMI data for the logged-in member
$sql_bmi = "SELECT measurement_date, bmi FROM measurements WHERE member_id = ?";
$stmt_bmi = $conn->prepare($sql_bmi);
$stmt_bmi->bind_param("i", $member_id);
$stmt_bmi->execute();
$stmt_bmi->bind_result($measurement_date, $bmi);

// Initialize arrays to store dates and BMI values
$dates = array();
$bmi_data = array();

// Fetch BMI data and dates
while ($stmt_bmi->fetch()) {
    $dates[] = $measurement_date;
    $bmi_data[] = $bmi;
}
$stmt_bmi->close();
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

    <title>Dashboard</title>
</head>
<body>
    <nav>
    <a href="tp_dashboard.php">
            <h2>Gym System</h2>
        </a>
        <div>
            <ul class="nav-links">
                <li><a href="forum_feed.php">Forum</a></li>
                <li><a href="quick_form_check.php">Quick Form Check</a></li>
                <li><a href="#">Quiz</a></li>
                <li><a href="#">Schedule</a></li>
                <li><a href="#">Virtual competiton</a></li>
                <li><a href="#">recommended plan</a></li>
                <li><a href="chat.php">Chat</a></li>
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
        <h1>Hello <?php echo $_SESSION['username']; ?></h1>
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
                <!-- Chart container -->
                <canvas id="bmiChart" width="400" height="200"></canvas>
            </div>
        </div>
        
    </main>
    <footer>

    </footer>

    <script>
        // Use PHP arrays to pass data to JavaScript
        const dates = <?php echo json_encode($dates); ?>;
        const bmiData = <?php echo json_encode($bmi_data); ?>;

        // Create a new Chart instance
        const ctx = document.getElementById('bmiChart').getContext('2d');
        const bmiChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates, // Use dates as labels
                datasets: [{
                    label: 'BMI',
                    data: bmiData, // Use BMI data
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'BMI'
                        }
                    }
                }
            }
        });
    </script>
     <script type="text/javascript">
    window.$crisp=[];window.CRISP_WEBSITE_ID="29a77fcc-c601-4802-a3fd-ce3a2e7008cb";
    (function(){
        d=document;
        s=d.createElement("script");
        s.src="https://client.crisp.chat/l.js";
        s.async=1;
        d.getElementsByTagName("head")[0].appendChild(s);
    })();

    // Fetch user information and set Crisp attributes
    fetch('config.php')
        .then(response => response.json())
        .then(user => {
            $crisp.push(["set", "user:email", [user.email]]);
            $crisp.push(["set", "user:nickname", [user.username]]);
        })
        .catch(error => console.error('Error fetching user data:', error));
    </script>
    <script src="../Javascript/app.js"></script>
    <script src="../Javascript/landing.js"></script>
</body>
</html>
