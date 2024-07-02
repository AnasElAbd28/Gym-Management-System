<?php
session_start();
include 'db_conn.php'; // Ensure this file contains your database connection logic

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id'];

// Fetch user details
$userQuery = "SELECT username, user_email, user_number, points FROM user WHERE user_id = $user_id";
$userResult = mysqli_query($conn, $userQuery);
if ($userResult) {
    $userDetails = mysqli_fetch_assoc($userResult);
    $username = $userDetails['username'] ?? 'N/A';
    $email = $userDetails['user_email'] ?? 'N/A';
    $phoneNumber = $userDetails['user_number'] ?? 'N/A';
    $points = $userDetails['points'] ?? 0;
} else {
    die("Query failed: " . mysqli_error($conn));
}

// Determine discount message
$discountMessage = '';
if ($points >= 0 && $points <= 19) {
    $discountMessage = 'No discount yet';
} elseif ($points >= 20 && $points <= 39) {
    $discountMessage = 'You get a 5% discount!';
} elseif ($points >= 40 && $points <= 59) {
    $discountMessage = 'You get a 10% discount!';
} elseif ($points >= 60) {
    $discountMessage = 'You get a 15% discount!';
}

// Fetch latest measurement
$measurementQuery = "SELECT age, height, bmi, weight, goal FROM measurements WHERE member_id = $user_id ORDER BY measurement_date DESC LIMIT 1";
$measurementResult = mysqli_query($conn, $measurementQuery);
if ($measurementResult) {
    $latestMeasurement = mysqli_fetch_assoc($measurementResult);
    $age = $latestMeasurement['age'] ?? '';
    $height = $latestMeasurement['height'] ?? '';
    $bmi = $latestMeasurement['bmi'] ?? '';
    $weight = $latestMeasurement['weight'] ?? '';
    $goal = $latestMeasurement['goal'] ?? '';
} else {
    die("Query failed: " . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newAge = $_POST['age'];
    $newHeight = $_POST['height'];
    $newWeight = $_POST['weight'];
    $newGoal = $_POST['goal'];
    $currentDate = date('Y-m-d'); // Correct way to format date

    // Calculate BMI
    $newBmi = $newWeight / (($newHeight / 100) ** 2);

    // Insert new measurement record
    $insertQuery = "INSERT INTO measurements (age, height, bmi, weight, goal, member_id, measurement_date) VALUES ($newAge, $newHeight, $newBmi, $newWeight, '$newGoal', $user_id, '$currentDate')";
    if (mysqli_query($conn, $insertQuery)) {
        $_SESSION['success_message'] = "Profile updated successfully!";
    } else {
        die("Query failed: " . mysqli_error($conn));
    }

    // Refresh the page to show updated data
    header("Location: member_profile.php");
    exit();
}

// Get success message from session
$successMessage = '';
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
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
    <link rel="stylesheet" href="../Styles/profile.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://kit.fontawesome.com/3704673904.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.css" />
    <script src="https://unpkg.com/simplebar@5.3.0/dist/simplebar.min.js"></script>
    <title>Profile Page</title>
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
        <h1 id="headline">Profile Information</h1>
        <?php if ($successMessage): ?>
            <div style="color: green; text-align: center; margin-bottom: 20px;"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>
        <div class="profile-container">
            <form method="POST" action="member_profile.php">
                <div class="profile-field">
                    <label for="name">Username:</label>
                    <div class="profile-data"><?php echo htmlspecialchars($username); ?></div>
                </div>
                <div class="profile-field">
                    <label for="email">Email:</label>
                    <div class="profile-data"><?php echo htmlspecialchars($email); ?></div>
                </div>
                <div class="profile-field">
                    <label for="phone">Phone Number:</label>
                    <div class="profile-data"><?php echo htmlspecialchars($phoneNumber); ?></div>
                </div>
                <div class="profile-field">
                    <label for="phone">Points:</label>
                    <div class="profile-data"><?php echo htmlspecialchars($points); ?></div>
                    <div><h3 style="color: white;"><?php echo htmlspecialchars($discountMessage); ?><h3></div>
                </div>
                <div class="profile-field">
                    <label for="age">Age:</label>
                    <input class="profile-data" type="number" name="age" value="<?php echo htmlspecialchars($age); ?>" required>
                </div>
                <div class="profile-field">
                    <label for="height">Height (cm):</label>
                    <input class="profile-data" type="number" name="height" value="<?php echo htmlspecialchars($height); ?>" required>
                </div>
                <div class="profile-field">
                    <label for="bmi">BMI:</label>
                    <input class="profile-data" type="number" name="bmi" value="<?php echo htmlspecialchars($bmi); ?>" step="0.1" readonly>
                </div>
                <div class="profile-field">
                    <label for="weight">Weight (kg):</label>
                    <input class="profile-data" type="number" name="weight" value="<?php echo htmlspecialchars($weight); ?>" required>
                </div>
                <div class="profile-field">
                    <label for="goal">Goal:</label>
                    <select class="profile-data" name="goal" required>
                        <option value="Weight Loss" <?php echo $goal == 'Weight Loss' ? 'selected' : ''; ?>>Weight Loss</option>
                        <option value="Muscle Gain (Hypertrophy)" <?php echo $goal == 'Muscle Gain (Hypertrophy)' ? 'selected' : ''; ?>>Muscle Gain (Hypertrophy)</option>
                        <option value="Strength Gain" <?php echo $goal == 'Strength Gain' ? 'selected' : ''; ?>>Strength Gain</option>
                        <option value="Endurance" <?php echo $goal == 'Endurance' ? 'selected' : ''; ?>>Endurance</option>
                        <option value="Flexibility" <?php echo $goal == 'Flexibility' ? 'selected' : ''; ?>>Flexibility</option>
                        <option value="Functional Fitness" <?php echo $goal == 'Functional Fitness' ? 'selected' : ''; ?>>Functional Fitness</option>
                        <option value="Sport-Specific Training" <?php echo $goal == 'Sport-Specific Training' ? 'selected' : ''; ?>>Sport-Specific Training</option>
                        <option value="another" <?php echo $goal == 'another' ? 'selected' : ''; ?>>another</option>
                    </select>
                </div>
                <button class="profile-button" type="submit">Save</button>
            </form>
        </div>
    </main>
</div>
<footer></footer>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const heightInput = document.querySelector('input[name="height"]');
        const weightInput = document.querySelector('input[name="weight"]');
        const bmiInput = document.querySelector('input[name="bmi"]');

        function calculateBMI() {
            const height = parseFloat(heightInput.value);
            const weight = parseFloat(weightInput.value);
            if (height > 0 && weight > 0) {
                const bmi = weight / ((height / 100) ** 2);
                bmiInput.value = bmi.toFixed(1);
            } else {
                bmiInput.value = '';
            }
        }

        heightInput.addEventListener('input', calculateBMI);
        weightInput.addEventListener('input', calculateBMI);

        calculateBMI(); // Calculate BMI on page load
    });
</script>
<script src="../Javascript/app.js"></script>
<script src="../Javascript/landing.js"></script>
</body>
</html>
