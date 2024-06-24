<?php
session_start();

include 'db_conn.php';

if (!isset($_SESSION['id']) || !isset($_GET['schedule_pk'])) {
    header("Location: member_dashboard.php");
    exit();
}

$schedule_pk = $_GET['schedule_pk'];
$user_id = $_SESSION['id'];

// Query to get the day_of_week for the given schedule_pk
$query = "SELECT day_of_week FROM schedule WHERE schedule_pk = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $schedule_pk, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $dayOfWeek = $row['day_of_week'];

    // Delete query to remove the workout
    $deleteQuery = "DELETE FROM schedule WHERE schedule_pk = ? AND user_id = ?";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bind_param("ii", $schedule_pk, $user_id);

    if ($deleteStmt->execute()) {
        // Redirect based on the day of the week
        if ($dayOfWeek == 'Monday') {
            header("Location: schedule_plan.php");
        } elseif ($dayOfWeek == 'Tuesday') {
            header("Location: tuesday.php");
        } elseif ($dayOfWeek == 'Wednesday') {
            header("Location: wednesday.php");
        } elseif ($dayOfWeek == 'Thursday') {
            header("Location: thursday.php");
        } elseif ($dayOfWeek == 'Friday') {
            header("Location: friday.php");
        } elseif ($dayOfWeek == 'Saturday') {
            header("Location: saturday.php");
        } elseif ($dayOfWeek == 'Sunday') {
            header("Location: sunday.php");
        }
        exit();
    } else {
        echo "Error deleting workout: " . $deleteStmt->error;
    }

    $deleteStmt->close();
} else {
    echo "No schedule found for the provided schedule_pk.";
}

$stmt->close();
$conn->close();
?>
