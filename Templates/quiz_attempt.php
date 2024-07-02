<?php
session_start(); // Starting the session

include 'db_conn.php';

// Retrieve the member ID from the session
$member_id = $_SESSION['id'];

// Get the quiz_id from the URL
$quiz_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Initialize variables to store quiz attempt data
$score = 0;
$total_questions = 0;
$attempt_timestamp = date("Y-m-d H:i:s");

// Loop through the submitted answers
foreach ($_POST as $key => $value) {
    if (strpos($key, 'q_') === 0) {
        $question_id = intval(substr($key, 2));
        $selected_option_id = intval($value);
        $total_questions++;

        // Fetch correct option for the question
        $correct_option_query = "SELECT is_correct FROM options WHERE question_id = ? AND option_id = ?";
        $correct_option_stmt = $conn->prepare($correct_option_query);
        $correct_option_stmt->bind_param("ii", $question_id, $selected_option_id);
        $correct_option_stmt->execute();
        $correct_option_result = $correct_option_stmt->get_result();
        $correct_option = $correct_option_result->fetch_assoc();

        if ($correct_option['is_correct'] == 1) {
            $score++; // Increment score if the selected option is correct
        }
    }
}

// Store the attempt in the database
$insert_attempt_query = "INSERT INTO attempts (user_id, quiz_id, score, attempt_timestamp) VALUES (?, ?, ?, ?)";
$insert_attempt_stmt = $conn->prepare($insert_attempt_query);
$insert_attempt_stmt->bind_param("iiis", $member_id, $quiz_id, $score, $attempt_timestamp);
$insert_attempt_stmt->execute();

// Calculate the score percentage
$score_percentage = ($total_questions > 0) ? ($score / $total_questions) * 100 : 0;

// Determine points to add based on the score percentage
$points_to_add = 0;
if ($score_percentage >= 50 && $score_percentage <= 75) {
    $points_to_add = 5;
} elseif ($score_percentage > 75 && $score_percentage <= 100) {
    $points_to_add = 10;
}

// Update the user's points in the database if they scored in the range
if ($points_to_add > 0) {
    $update_points_query = "UPDATE user SET points = points + ? WHERE user_id = ?";
    $update_points_stmt = $conn->prepare($update_points_query);
    $update_points_stmt->bind_param("ii", $points_to_add, $member_id);
    $update_points_stmt->execute();
}

// Redirect back to quizzes_page.php with score and total questions
header("Location: quizzes_page.php?score=$score&total=$total_questions");
exit();
?>
