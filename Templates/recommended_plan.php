<!DOCTYPE html>

<?php
session_start(); // Starting the session

include 'db_conn.php';

// Retrieve the member ID from the session
$member_id = $_SESSION['id'];

// Fetch member's measurements and goal from the database
$query = "SELECT age, weight, height, bmi, goal FROM measurements WHERE member_id = $member_id";
$result = mysqli_query($conn, $query);
$member = mysqli_fetch_assoc($result);

// Assign member's data to variables
$age = $member['age'];
$weight = $member['weight'];
$height = $member['height'];
$bmi = $member['bmi'];
$goal = $member['goal'];

// Calculate BMR using Mifflin-St Jeor Equation
$bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;

// Calculate TDEE (assuming moderate activity level for simplicity)
$tdee = $bmr * 1.55;

// Adjust calories based on fitness goal
if ($goal == "Weight Loss") {
    $calories = $tdee - 500; // Reduce 500 calories for weight loss
    $carb_percent = 50;
    $protein_percent = 30;
    $fat_percent = 20;
} elseif ($goal == "Muscle Gain (Hypertrophy)") {
    $calories = $tdee + 500; // Add 500 calories for muscle gain
    $carb_percent = 40;
    $protein_percent = 30;
    $fat_percent = 30;
} elseif ($goal == "Strength Gain") {
    $calories = $tdee + 300; // Add 300 calories for strength gain
    $carb_percent = 40;
    $protein_percent = 30;
    $fat_percent = 30;
} elseif ($goal == "Endurance") {
    $calories = $tdee;
    $carb_percent = 60;
    $protein_percent = 20;
    $fat_percent = 20;
} elseif ($goal == "Flexibility") {
    $calories = $tdee;
    $carb_percent = 50;
    $protein_percent = 25;
    $fat_percent = 25;
} elseif ($goal == "Functional Fitness") {
    $calories = $tdee;
    $carb_percent = 50;
    $protein_percent = 25;
    $fat_percent = 25;
} elseif ($goal == "Sport-Specific Training") {
    $calories = $tdee + 200; // Add 200 calories for sport-specific training
    $carb_percent = 55;
    $protein_percent = 25;
    $fat_percent = 20;
} else { // General Health and Wellness
    $calories = $tdee;
    $carb_percent = 50;
    $protein_percent = 25;
    $fat_percent = 25;
}

// Prepare data to display
$calories = round($calories);
$carb_percent = round($carb_percent);
$protein_percent = round($protein_percent);
$fat_percent = round($fat_percent);

// Workout Plan Algorithm
function generate_workout_plan($weight, $height, $bmi, $age, $fitness_goal) {
    // Determine workout frequency based on fitness goal and BMI
    if ($fitness_goal == "Weight Loss") {
        $workout_days_per_week = ($bmi >= 25) ? 4 : 5;
    } elseif ($fitness_goal == "Muscle Gain (Hypertrophy)") {
        $workout_days_per_week = 5;
    } elseif ($fitness_goal == "Strength Gain") {
        $workout_days_per_week = 4;
    } elseif ($fitness_goal == "Endurance") {
        $workout_days_per_week = 3;
    } elseif ($fitness_goal == "Flexibility") {
        $workout_days_per_week = 3;
    } elseif ($fitness_goal == "Functional Fitness") {
        $workout_days_per_week = 4;
    } elseif ($fitness_goal == "Sport-Specific Training") {
        $workout_days_per_week = 5;
    } else { // General Health and Wellness
        $workout_days_per_week = 3;
    }

    // Determine rest day frequency
    $rest_day_frequency = 7 - $workout_days_per_week;

    // Determine cardio minutes per day based on fitness goal
    if ($fitness_goal == "Weight Loss") {
        $cardio_minutes_per_day = 30;
    } elseif ($fitness_goal == "Endurance") {
        $cardio_minutes_per_day = 45;
    } elseif ($fitness_goal == "Flexibility") {
        $cardio_minutes_per_day = 20;
    } else {
        $cardio_minutes_per_day = 0; // No cardio for other goals
    }

    // Determine cardio calories burnt per session based on weight
    $cardio_calories_burnt_per_session = ($cardio_minutes_per_day > 0) ? $weight * 5 : 0;

    // Determine workout type based on fitness goal
    if ($fitness_goal == "Weight Loss") {
        $workout_type = "Full-body workouts with emphasis on compound exercises";
    } elseif ($fitness_goal == "Muscle Gain (Hypertrophy)") {
        $workout_type = "Split routine targeting specific muscle groups";
    } elseif ($fitness_goal == "Strength Gain") {
        $workout_type = "Strength-focused workouts with heavy compound lifts";
    } elseif ($fitness_goal == "Endurance") {
        $workout_type = "Cardiovascular exercises and high-repetition resistance training";
    } elseif ($fitness_goal == "Flexibility") {
        $workout_type = "Yoga, stretching, and mobility exercises";
    } elseif ($fitness_goal == "Functional Fitness") {
        $workout_type = "Functional movement patterns and exercises";
    } elseif ($fitness_goal == "Sport-Specific Training") {
        $workout_type = "Training tailored to specific sport or activity";
    } else { // General Health and Wellness
        $workout_type = "Balanced workouts focusing on overall fitness";
    }

    // Construct the workout plan
    $workout_plan = [
        "Workout Frequency" => $workout_days_per_week,
        "Rest Day Frequency" => $rest_day_frequency,
        "Cardio Minutes per Day" => $cardio_minutes_per_day,
        "Cardio Calories Burnt per Session" => $cardio_calories_burnt_per_session,
        "Workout Type" => $workout_type
    ];

    return $workout_plan;
}

// Generate workout plan
$workout_plan = generate_workout_plan($weight, $height, $bmi, $age, $goal);

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

    <title>Recommended Plan</title>
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
                <li><a href="recommended_plan.php">Recommended Plan</a></li>
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
        <h1>Recommended Plan</h1>
         <div id="overview">
            <h2 id="overview-header">Nutrition Plan</h2>
            <div id="overview-main">
                <div class="overview-section">
                    <h3>Total Calories</h3>
                    <h4 class="overview-values"><?php echo $calories; ?></h4>
                </div>
            </div>
            <div id="overview-main">
                <div class="overview-section">
                    <h3>Carb %</h3>
                    <h4 class="overview-values"><?php echo $carb_percent; ?></h4>
                </div>
            </div>
            <div id="overview-main">
                <div class="overview-section">
                    <h3>Protein %</h3>
                    <h4 class="overview-values"><?php echo $protein_percent; ?></h4>
                </div>
            </div>
            <div id="overview-main">
                <div class="overview-section">
                    <h3>Fat %</h3>
                    <h4 class="overview-values"><?php echo $fat_percent; ?></h4>
                </div>
            </div>
        </div>
        <div id="overview">
        <h2 id="overview-header">Workout Plan</h2>
        <div id="overview-main">
            <div class="overview-section">
                <h3>Workout Frequency</h3>
                <h4 class="overview-values"><?php echo $workout_plan['Workout Frequency']; ?> days/week</h4>
            </div>
        </div>
        <div id="overview-main">
            <div class="overview-section">
                <h3>Rest Day Frequency</h3>
                <h4 class="overview-values"><?php echo $workout_plan['Rest Day Frequency']; ?> days/week</h4>
            </div>
        </div>
        <div id="overview-main">
            <div class="overview-section">
                <h3>Cardio Minutes per Day</h3>
                <h4 class="overview-values"><?php echo $workout_plan['Cardio Minutes per Day']; ?> minutes</h4>
            </div>
        </div>
        <div id="overview-main">
            <div class="overview-section">
                <h3>Cardio Calories Burnt per Session</h3>
                <h4 class="overview-values"><?php echo $workout_plan['Cardio Calories Burnt per Session']; ?> kcal</h4>
            </div>
        </div>
        <div id="overview-main">
            <div class="overview-section">
                <h3>Workout Type</h3>
                <h4 class="overview-values"><?php echo $workout_plan['Workout Type']; ?></h4>
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
