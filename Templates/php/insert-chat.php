<?php
session_start();

if (isset($_SESSION['id'])) {
    include_once "../db_conn.php";
    
    $outgoing_id = $_SESSION['id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    if (!empty($message)) {
        $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')";

        // Attempt to execute the SQL query
        if (mysqli_query($conn, $sql)) {
            echo "Message sent successfully!";
        } else {
            // Error handling for query execution
            header("location: ../member_dashboard.php");
    exit();
        }
    } else {
        // Handle case where message is empty
        echo header("location: ../member_dashboard.php");
        exit();
    }
} else {
    // Redirect if session id is not set
    header("location: ../member_dashboard.php");
    exit();
}
?>
