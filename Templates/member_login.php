<?php 
session_start();
include "db_conn.php";

if(isset($_POST['Email']) && isset($_POST['Password'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;

    }
}

$email = validate($_POST['Email']);
$password = validate($_POST['Password']);

if(empty($email)){
    header ("Location: login_page.php?error=Email is required");
    exit();
}elseif(empty($password)){
    header ("Location: login_page.php?error=Password is required");
    exit();
}

$sql = "SELECT * FROM member WHERE member_email ='$email' AND member_password = '$password'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if($row['member_email'] === $email && $row['member_password'] === $password){
        echo "logged in";
        $_SESSION['member_email'] = $row['member_email'];
        $_SESSION['member_username'] = $row['member_username'];
        $_SESSION['member_id'] = $row['member_id'];
        $_SESSION['member_address'] = $row['member_address'];
        $_SESSION['reg_code'] = $row['reg_code'];
        $_SESSION['member_number'] = $row['member_number'];
        $_SESSION['points'] = $row['points'];
        header("Location: landing.php");
        exit();
    }else {
        header("Location: login_page.php?error=Incorrect Email or Password" );
    }
}else {
    header("Location: login_page.php?error=Incorrect Email or Password" );
    exit();
}