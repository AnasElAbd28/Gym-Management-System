<?php
// Include necessary files
session_start();
include 'db_conn.php'; // Include database connection file
$current_id = $_SESSION['id'];

// Check if the form for posting a comment has been submitted
if (isset($_POST['post_comment'])) {
    $content_comment = isset($_POST['content_comment']) ? $_POST['content_comment'] : ""; // Get the content of the comment from the form
    $post_id = isset($_POST['post_id']) ? $_POST['post_id'] : ""; // Get the ID of the post to which the comment is being made
    $time = time(); // Get the current timestamp

    // Check if the length of the comment exceeds the limit
    if (strlen($content_comment) > 280) {
        // If the comment exceeds the limit, set an error message and redirect back to the home page with the error message
        $error_message = "Comment must not exceed 280 characters.";
        header("Location: home.php?error=" . urlencode($error_message));
        exit(); // Terminate the script execution
    }

    // Insert comment data into the database
    $insert_query = "INSERT INTO comments (post_id, user_id, content_comment, created) VALUES ('$post_id', '$current_id', '$content_comment', '$time')";
    mysqli_query($conn, $insert_query);

    header('location:forum_feed.php'); // Redirect back to the forum feed page after posting the comment
}
?>
