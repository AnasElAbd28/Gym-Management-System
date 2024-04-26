<?php
include('includes/database.php'); // Include database connection file
include 'db_conn.php'; // Include session management file

// Check if an image is uploaded and handle it
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK && !empty($_FILES['image']['tmp_name'])) {
    $file = $_FILES['image']['tmp_name'];
    $image_name = addslashes($_FILES['image']['name']);
    $size = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];

    if ($error > 0) {
        die("Error uploading file! Code $error.");
    } else {
        if ($size > 10000000) {
            die("Format is not allowed or file size is too big!");
        } else {
            move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
            $location = "upload/" . $_FILES["image"]["name"];
        }
    }
} else {
    // No image uploaded, set location to an empty string
    $location = "";
}

// Get post content
$content = isset($_POST['content']) ? mysqli_real_escape_string($con, $_POST['content']) : "";

// Check if content exceeds 280 characters
if (strlen($content) > 280) {
    $error_message = "Post must not exceed 280 characters.";
    header("Location: home.php?error=" . urlencode($error_message));
    exit();
}

// Insert post data into the database
$user = $_SESSION['id'];
$time = time();

// Use prepared statement to insert post data into the database
$stmt = $con->prepare("INSERT INTO post (user_id, post_image, content, created) VALUES (?, ?, ?, ?)");
$stmt->bind_param("issi", $user, $location, $content, $time);
if ($stmt->execute()) {
    // Post inserted successfully
    header('location:home.php');
    exit();
} else {
    // Error inserting post data into the database
    die("Error inserting post!");
}
?>
