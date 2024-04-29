<?php
session_start();
include 'db_conn.php'; // Include database connection file



// Check if post ID is provided and sanitize it
$get_id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Get the post ID from the GET parameter and convert it to an integer

// Check if a valid post ID is provided
if ($get_id > 0) {
    // Use prepared statement to delete post from the database
    $stmt = $conn->prepare("DELETE FROM post WHERE post_id = ?");
    $stmt->bind_param("i", $get_id); // Bind the post ID to the prepared statement
    if ($stmt->execute()) { // If the deletion is successful
        // Redirect back to the home page after deleting the post
        header("Location: forum_feed.php");
        exit(); // Terminate the script execution
    } else {
        // If an error occurs during deletion, terminate with an error message
        die("Error deleting post!");
    }
} else {
    // If an invalid or missing post ID is provided, terminate with an error message
    die("Invalid post ID!");
}
?>