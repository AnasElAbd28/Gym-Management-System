<?php
include "db_conn.php";
session_start();




// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the form data
    $qfc_title = $_POST["qfc_title"];
    $qfc_description = $_POST["qfc_description"];
    $qfc_url = $_POST["qfc_url"];
    $qfc_type = $_POST["qfc_type"];
    $member_id = $_SESSION['member_id'];
    $qfc_status = "Active";
  


    // Prepare and execute the SQL query to insert the data into the table
// Prepare and execute the SQL query to insert the data into the table
$sql = "INSERT INTO qfc (qfc_title, qfc_description, qfc_url, qfc_type, qfc_status, member_id) VALUES ('$qfc_title', '$qfc_description', '$qfc_url', '$qfc_type', '$qfc_status', '$member_id')";
if ($conn->query($sql) === TRUE) {
    // Redirect to the quick_form_check.php page on successful insertion
    header("Location: quick_form_check.php");
    exit;
} else {
    // Display an error message if the query failed
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
?>