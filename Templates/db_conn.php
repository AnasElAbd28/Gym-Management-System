<?php 

define('DB_HOST', 'localhost');
define('DB_USER', 'Anas');
define('DB_PASS', '');
define('DB_NAME', 'gym');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($conn->connect_error){
    die('connection failed') . $conn->connect_error;
}



?>
