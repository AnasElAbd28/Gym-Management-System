<?php
session_start(); // Starting the session

include 'db_conn.php';

// Retrieve the member ID from the session
$member_id = $_SESSION['id'];

// Get the quiz_id from the URL
$quiz_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Initialize variables to store quiz attempt data
$score = 0;
$attempt_timestamp = date("Y-m-d H:i:s");

// Loop through the submitted answers
foreach ($_POST as $key => $value) {
    if (strpos($key, 'q_') === 0) {
        $question_id = intval(substr($key, 2));
        $selected_option_id = intval($value);

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

// Redirect back to quiz_page.php or any other appropriate page
header("Location: quiz_page.php?id=$quiz_id");
exit();
?>