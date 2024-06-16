<?php
// Include session and database files
session_start();
include 'db_conn.php'; // Include database connection file

// Function to display timestamp
function time_stamp($session_time) 
{ 
    $time_difference = time() - $session_time; 
    $seconds = $time_difference; 
    $minutes = round($time_difference / 60);
    $hours = round($time_difference / 3600); 
    $days = round($time_difference / 86400); 
    $weeks = round($time_difference / 604800); 
    $months = round($time_difference / 2419200); 
    $years = round($time_difference / 29030400); 

    if ($seconds <= 60) {
        return "$seconds seconds ago"; 
    } elseif ($minutes <= 60) {
        return ($minutes == 1) ? "one minute ago" : "$minutes minutes ago"; 
    } elseif ($hours <= 24) {
        return ($hours == 1) ? "one hour ago" : "$hours hours ago";
    } elseif ($days <= 7) {
        return ($days == 1) ? "one day ago" : "$days days ago";
    } elseif ($weeks <= 4) {
        return ($weeks == 1) ? "one week ago" : "$weeks weeks ago";
    } elseif ($months <= 12) {
        return ($months == 1) ? "one month ago" : "$months months ago";
    } else {
        return ($years == 1) ? "one year ago" : "$years years ago";
    }
} 

// Check for any error messages passed through URL parameters
$error_message = isset($_GET['error']) ? $_GET['error'] : '';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Friendzone</title>
    <link rel="stylesheet" type="text/css" href="../Styles/layout2.css">
    <script>
        function confirmDeletePost(postId) {
            if (confirm("Are you sure you want to delete this post?")) {
                window.location.href = "delete_post.php?id=" + postId;
            }
        }

        function confirmDeleteComment(commentId) {
            if (confirm("Are you sure you want to delete this comment?")) {
                window.location.href = "delete_comment.php?id=" + commentId;
            }
        }
    </script>
</head>

<body>
<nav class="first-nav">
    <a href="tp_dashboard.php">
            <h2>Pygmalion</h2>
        </a>
        <div>
            <ul class="nav-links">
                <li><a href="forum_feed.php">Forum</a></li>
                <li><a href="quick_form_check.php">Quick Form Check</a></li>
                <li><a href="quizzes_page.php">Quiz</a></li>
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

    <div class="container">

    <h1>Hello <?php echo $_SESSION['username']; ?></h1>
        
                <form method="post" class="update-form" action="forum_post.php" enctype="multipart/form-data">
                <h3>Add Forum Post</h3>
                    <textarea placeholder="What's on your mind?" name="content" class="post-text" required></textarea>
                    <div class="buttons">
                    <input type="file" name="image" id="file-upload">
                    <button class="share-button" class="btn-share" name="Submit" value="Log out">Share</button>
                    </div>
                </form>
                <?php

           

            if (!isset($_FILES['image']['tmp_name'])) {
                echo "";
            } else {
                $file = $_FILES['image']['tmp_name'];
                $image = $_FILES["image"]["name"];
                $image_name = addslashes($_FILES['image']['name']);
                $size = $_FILES["image"]["size"];
                $error = $_FILES["image"]["error"];

                if ($error > 0) {
                    die("Error uploading file! Code $error.");
                } else {
                    if ($size > 10000000) //conditions for the file
                    {
                        die("Format is not allowed or file size is too big!");
                    } else {
                        move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"]);
                        $location = "upload/" . $_FILES["image"]["name"];
                        $user = $_SESSION['id'];
                        $content = $_POST['content'];
                        $time = time();

                        $update = mysqli_query($con, " INSERT INTO post (user_id,post_image,content,created)
                                                        VALUES ('$id','$location','$content','$time') ");
                    }
                    header('location:timeline.php');
                }
            }
            ?>
        <?php
        // Display error message if any
        if (!empty($error_message)) {
            echo '<div class="error-message">' . $error_message . '</div>';
        }

        // Fetch posts
        $query = mysqli_query($conn, "SELECT * FROM post LEFT JOIN user ON user.user_id = post.user_id ORDER BY post_id DESC");
        while ($row = mysqli_fetch_array($query)) {
            $posted_by = $row['username'];
            $location = $row['post_image'];
            $content = $row['content'];
            $post_id = $row['post_id'];
            $time = $row['created'];

            // Output post
            echo '<div class="post">';
            echo '<div class="post-header">';
            echo '<a href="user_profile.php?id=' . $row['user_id'] . '"><h4 class="user-name">' . $posted_by . '</h4></a>';
            echo '<p>' . time_stamp($time) . '</p>';
            if ($row['user_id'] == $_SESSION['id']) {
                echo '<div class="delete-post">';
                echo '<button class ="share-button" class="btn-delete" onclick="confirmDeletePost(\'' . $post_id . '\')">X</button>';
                echo '</div>';
            }
            echo '</div>'; // Close post-header
            echo '<p class="post-content">' . $content . '</p>';
            if (!empty($location)) {
                echo '<img src="' . $location . '" alt="Post Image" class="post-image">';
            }

            // Fetch comments for this post
            $comment_query = mysqli_query($conn, "SELECT * FROM comments LEFT JOIN user ON user.user_id = comments.user_id WHERE post_id='$post_id' ORDER BY comments.created DESC");
            while ($comment_row = mysqli_fetch_array($comment_query)) {
                echo '<div class="comment">';
                echo '<div class="comment-content-wrapper">';
                echo '<a href="user_profile.php?id=' . $comment_row['user_id'] . '" style="font-size: 17px;"><h4 class="user-name">' . $comment_row['username'] . '</a> <span>' . time_stamp($comment_row['created']) . '</span>';
                if ($comment_row['user_id'] == $_SESSION['id']) {
                    echo '<button class="share-button btn-delete" style="font-size: 10px; padding: 5px 10px;" onclick="confirmDeleteComment(\'' . $comment_row['comment_id'] . '\')">X</button>';
                }
                echo '</h4>';
                
                echo '<p class="comment-content">' . $comment_row['content_comment'] . '</p>';
                echo '</div>'; // Close comment-content-wrapper
                echo '</div>'; // Close comment
            }

            // Comment form
            echo '<form class="comment-form" method="POST" action="forum_comment.php">';
            echo '<input type="text" placeholder="Write your comment..." name="content_comment" class="comment-input">';
            echo '<input type="hidden" name="post_id" value="' . $post_id . '">';
            echo '<input type="hidden" name="user_id" value="' . $_SESSION['username'] . '">';
            echo '<button type="submit" name="post_comment" class="comment-button">Comment</button>';
            echo '</form>';

            echo '</div>'; // Close post
        }
        ?>
    </div> <!-- Close container -->

    <script src="../Javascript/app.js"></script>
</body>
</html>
