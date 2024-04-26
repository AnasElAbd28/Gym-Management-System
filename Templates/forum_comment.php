<?php
// Include necessary files
include ('session.php'); // Include session management file
include 'db_conn.php'; // Include database connection file

// Check if the form for posting a comment has been submitted
if (isset($_POST['post_comment'])) {
    $user = $_SESSION['member_id']; // Get the ID of the current user from the session
    $content_comment = isset($_POST['content_comment']) ? $_POST['content_comment'] : ""; // Get the content of the comment from the form
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : ""; // Get the ID of the post to which the comment is being made
    $member_id = isset($_POST['member_id']) ? $_POST['member_id'] : ""; // Get the ID of the user who owns the post
    $time = time(); // Get the current timestamp

    // Check if the length of the comment exceeds the limit
    if (strlen($content_comment) > 280) {
        // If the comment exceeds the limit, set an error message and redirect back to the home page with the error message
        $error_message = "Comment must not exceed 280 characters.";
        header("Location: home.php?error=" . urlencode($error_message));
        exit(); // Terminate the script execution
    }

    // Insert comment data into the database
    mysqli_query($con, "INSERT INTO comments (post_id, user_id, name, content_comment, image, created)
        VALUES ('$post_id', '$id', '$user_id', '$content_comment', '$profile_picture', '$time') ");
    header('location:home.php'); // Redirect back to the home page after posting the comment
}
?>