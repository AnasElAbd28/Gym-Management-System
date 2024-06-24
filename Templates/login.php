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

    $email = validate($_POST['Email']);
    $password = validate($_POST['Password']);

    if(empty($email)){
        header ("Location: member_login_page.php?error=Email is required");
        exit();
    } elseif(empty($password)){
        header ("Location: member)_login_page.php?error=Password is required");
        exit();
    }

    $sql = "SELECT * FROM user WHERE user_email ='$email' AND user_password = '$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if($row['user_email'] === $email && $row['user_password'] === $password){
            echo "logged in";
            $_SESSION['email'] = $row['user_email'];
            $_SESSION['password'] = $row['user_password'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['number'] = $row['member_number'];
            $_SESSION['type'] = $row['type']; // Assuming 'type' is a column in your user table

            if($row['type'] === 'member'){
                header("Location: member_dashboard.php");
            } elseif($row['type'] === 'trainer'){
                header("Location: trainer_dashboard.php");
            } else {
                header("Location: login_page.php?error=Unknown user type");
            }
            exit();
        } else {
            header("Location: login_page.php?error=Incorrect Email or Password");
            exit();
        }
    } else {
        header("Location: login_page.php?error=Incorrect Email or Password");
        exit();
    }
}
?>